<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with(['customer', 'items.product.category'])->latest();

        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            // This assumes an 'items' relationship on the Order model,
            // which in turn has a 'product' relationship, which has a 'category'.
            $query->whereHas('items.product.category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->get();

        return view('orders.index', compact('orders', 'categories'));
    }

    public function pos(): View
    {
        $categories = Category::orderBy('is_active', 'desc')->orderBy('name')->get();
        $products = Product::with('category')->where('is_active', true)->orderBy('name')->get();

        return view('orders.pos', compact('categories', 'products'));
    }

    public function invoice(Order $order): View
    {
        $order->load(['customer', 'items.product']);
        return view('orders.invoice', compact('order'));
    }

    public function kds(): View
    {
        $orders = Order::with(['items.product'])
            ->whereIn('status', ['pending', 'processing'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('orders.kds', compact('orders'));
    }

    public function storePos(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            
            'order_notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.notes' => ['nullable', 'string', 'max:255'],
            'discount_type' => ['nullable', 'in:fixed,percentage'],
            'discount_value' => ['nullable', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $orderItemsData = [];

            foreach ($validated['items'] as $itemData) {
                $product = Product::find($itemData['id']);
                
                $price = $product->price;
                if (isset($itemData['notes']) && strpos($itemData['notes'], 'Size: L') !== false) {
                    $price += 0.50;
                }

                $total += $price * $itemData['quantity'];

                // Prepare order item data for creation
                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $price, // Use calculated price
                    'notes' => $itemData['notes'] ?? null,
                ];

                // Decrement stock if stock management is enabled for the product
                if ($product->stock !== null) {
                    if ($product->stock < $itemData['quantity']) {
                        throw new \Exception("Not enough stock for product: {$product->name}. Only {$product->stock} left.");
                    }
                    $product->decrement('stock', $itemData['quantity']);
                }
            }

            // Create a default walk-in customer if one doesn't exist
            $walkInCustomer = Customer::firstOrCreate(
                ['email' => 'walkin@samnang.coffee'],
                ['name' => 'Walk-in Customer', 'phone' => 'N/A', 'address' => 'In Store']
            );

        $subtotal = $total;
        $discountAmount = 0;
        $taxAmount = 0; // Assuming 0 tax for now

        if (isset($validated['discount_type']) && isset($validated['discount_value'])) {
            if ($validated['discount_type'] === 'fixed') {
                $discountAmount = $validated['discount_value'];
            } elseif ($validated['discount_type'] === 'percentage') {
                $discountAmount = ($subtotal * $validated['discount_value']) / 100;
            }
        }
        $discountAmount = min($subtotal, $discountAmount);
        $finalTotal = $subtotal - $discountAmount + $taxAmount;

        // Generate Waiting Number (Resets daily)
        $today = Carbon::today();
        $lastOrder = Order::whereDate('created_at', $today)
            ->orderBy('waiting_number', 'desc')
            ->first();
        $waitingNumber = ($lastOrder && $lastOrder->waiting_number) ? $lastOrder->waiting_number + 1 : 1;

            // Create the Order
            $order = Order::create([
                'customer_id' => $walkInCustomer->id,
                'total' => $finalTotal,
                'subtotal' => $subtotal,
                'discount' => $discountAmount,
                'tax' => $taxAmount,
                'status' => 'pending',
                'notes' => $validated['order_notes'] ?? null,
                'waiting_number' => $waitingNumber,
            ]);

            // Create Order Items
            $order->items()->createMany($orderItemsData);

            DB::commit();

            return redirect()->route('orders.invoice', $order)->with('success', "Order #{$order->id} created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('POS Order creation failed: ' . $e->getMessage());

            return back()->with('error', 'Failed to create order: ' . $e->getMessage())->withInput();
        }
    }

    public function create(): View
    {
        return view('orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $walkInCustomer = Customer::firstOrCreate(
            ['email' => 'walkin@samnang.coffee'],
            ['name' => 'Walk-in Customer', 'phone' => 'N/A', 'address' => 'In Store']
        );
        $validated['customer_id'] = $walkInCustomer->id;

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function show(Order $order): View
    {
        $order->load('customer', 'items.product');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Status updated']);
        }

        return back()->with('success', 'Order status updated');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
