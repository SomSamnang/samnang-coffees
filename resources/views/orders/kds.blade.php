@extends('layouts.app')

@section('title', 'Kitchen Display Screen')

@section('styles')
<style>
    body { background-color: #212529; color: #fff; }
    .kds-header { padding: 1rem 1.5rem; background: #343a40; border-bottom: 1px solid #495057; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .order-card { background: #fff; color: #000; border-radius: 8px; overflow: hidden; height: 600px; width: 900px; display: flex; flex-direction: row; box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
    .order-header { padding: 1rem; font-weight: bold; display: flex; justify-content: space-between; align-items: center; color: #000; }
    .order-header .order-number { font-size: 2.5rem; font-weight: 800; line-height: 1; }
    .bg-pending { background-color: #ffc107; }
    .bg-processing { background-color: #0d6efd; color: white; }
    .order-body { padding: 0; flex: 1; overflow-y: auto; background: #fff; }
    .kds-table { width: 100%; border-collapse: collapse; }
    .kds-table th { background: #f8f9fa; padding: 0.75rem 0.5rem; font-size: 0.85rem; text-transform: uppercase; color: #6c757d; border-bottom: 1px solid #dee2e6; position: sticky; top: 0; z-index: 10; font-weight: 700; }
    .kds-table td { padding: 0.75rem 0.5rem; border-bottom: 1px solid #dee2e6; vertical-align: middle; }
    .item-img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; background: #f1f3f5; }
    .item-qty-badge { background: #e9ecef; color: #212529; font-weight: 800; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 1.2rem; display: inline-block; min-width: 35px; text-align: center; }
    .item-name { font-weight: 600; font-size: 1.1rem; display: block; line-height: 1.2; color: #212529; }
    .item-note { color: #dc3545; font-size: 0.9rem; font-style: italic; margin-top: 4px; display: block; }
    .order-footer { padding: 0.75rem; background: #f8f9fa; border-top: 1px solid #dee2e6; }
    .kds-summary { padding: 1rem; background-color: #fff; border-top: 1px solid #dee2e6; }
    .kds-summary-row { display: flex; justify-content: space-between; font-size: 1rem; margin-bottom: 0.25rem; color: #6c757d; }
    .kds-summary-row.total { font-weight: 800; font-size: 1.2rem; color: #212529; margin-top: 0.5rem; border-top: 1px dashed #dee2e6; padding-top: 0.5rem; }
    .timer { font-family: monospace; font-size: 1.5rem; font-weight: bold; }
    .qr-section {
        width: 100%;
        padding: 1rem;
        background: #f8f9fa;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        
   
    }
    .kds-details-wrapper {
        flex: 1; display: flex; flex-direction: column; min-width: 0;
    }
    .qr-section-wrapper {
        width: 500px; border-left: 1px solid #dee2e6; display: flex;
    }
    .navbar, .footer { display: none !important; } /* Hide default layout elements if possible */
    .container-fluid { padding: 0; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @php
        $qrPath = 'settings/bank_qr.png';
        $qrExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($qrPath);
        $qrUrl = $qrExists ? asset('storage/' . $qrPath) . '?v=' . \Illuminate\Support\Facades\Storage::disk('public')->lastModified($qrPath) : null;
    @endphp
    <div class="kds-header mb-3">
        <h2 class="m-0 text-white"><i class="bi bi-display"><a href="{{ route('dashboard') }}" class="text-white text-decoration-none"> Kitchen Display System</a></i></h2>
        <div class="text-end">
              <h4 class="m-0" style="flex-basis: 100%; ">Date: {{ \Carbon\Carbon::now()->timezone('Asia/Phnom_Penh')->format('M d, Y h:i A') }}</h4>
        </div>
    </div>

    <div class="p-3">
        <div class="row g-3">
            @forelse($orders as $order)
                <div class="col-md-6 col-lg-4">
                    <div class="order-card">
                        <div class="kds-details-wrapper">
                            <div class="order-header {{ $order->status == 'pending' ? 'bg-pending' : 'bg-processing' }}">
                                <span class="order-number">#{{ $order->waiting_number ?? $order->id }}</span>
                                <span class="timer" data-time="{{ $order->created_at->timestamp }}">00:00</span>
                            </div>
                            <div class="order-body">
                                <table class="kds-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 70px;">Image</th>
                                           
                                            <th>Item Details</th>
                                             <th class="text-center" style="width: 60px;">Qty</th>
                                            <th class="text-end" style="width: 80px;">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="text-center">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="item-img" alt="Img">
                                                @else
                                                    <div class="item-img d-flex align-items-center justify-content-center text-muted mx-auto"><i class="bi bi-cup-hot"></i></div>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <span class="item-name">{{ $item->product->name }}</span>
                                                @if($item->notes) <span class="item-note">{{ $item->notes }}</span> @endif
                                            </td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end fw-bold">${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="kds-summary">
                                    <div class="kds-summary-row">
                                        <span>Subtotal</span>
                                        <span>${{ number_format($order->subtotal > 0 ? $order->subtotal : $order->total + $order->discount - $order->tax, 2) }}</span>
                                    </div>
                                    @if($order->discount > 0)
                                    <div class="kds-summary-row text-danger">
                                        <span>Discount</span>
                                        <span>-${{ number_format($order->discount, 2) }}</span>
                                    </div>
                                    @endif
                                    <div class="kds-summary-row">
                                        <span>Tax</span>
                                        <span>${{ number_format($order->tax, 2) }}</span>
                                    </div>
                                    <div class="kds-summary-row total">
                                        <span>Total</span>
                                        <span>${{ number_format($order->total, 2) }}</span>
                                    </div>
                                </div>
                                @if($order->notes)
                                    <div class="alert alert-warning m-2 p-2 small">
                                        <strong>Note:</strong> {{ $order->notes }}
                                    </div>
                                @endif
                            </div>
                            <div class="order-footer d-grid gap-2">
                                @if($order->status == 'pending')
                                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" class="btn btn-primary w-100">Start Preparing</button>
                                    </form>
                                @else
                                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="btn btn-success w-100">Mark Ready</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="qr-section-wrapper">
                            <div class="qr-section">
                                @if($qrExists)
                                    <img src="{{ $qrUrl }}" alt="Bank QR" class="img-fluid border rounded mb-2" style="max-width: 350px;">
                                @else
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=SamnangCoffeeBankTransfer|Order:{{ $order->waiting_number ?? $order->id }}|Amount:{{ number_format($order->total, 2) }}" alt="Bank QR" class="img-fluid border rounded mb-2">
                                @endif
                                <div class="fw-bold text-success mt-1 h5">Please Scan to Pay: $ {{ number_format($order->total, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted mt-5">
                    <i class="bi bi-cup-hot display-1 text-secondary"></i>
                    <h3 class="mt-3 text-white">No active orders</h3>
                    <p class="text-secondary">Waiting for new orders...</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Notification Sound -->
<audio id="kds-alert-sound" src="https://codeskulptor-demos.commondatastorage.googleapis.com/galaxy/note.mp3" preload="auto"></audio>

<!-- Bank QR Modal -->
<div class="modal fade" id="bankQrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-bank"></i> Bank QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 id="qr-order-info" class="mb-3 text-primary"></h4>
                @php
                    $qrPath = 'settings/bank_qr.png';
                    $qrExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($qrPath);
                @endphp
                @if($qrExists)
                    <img id="bank-qr-image" src="{{ asset('storage/' . $qrPath) }}?v={{ \Illuminate\Support\Facades\Storage::disk('public')->lastModified($qrPath) }}" alt="Bank QR" class="img-fluid border rounded p-2" style="max-height: 400px;">
                @else
                    <img id="bank-qr-image" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=SamnangCoffeeBankTransfer" alt="Bank QR" class="img-fluid border rounded p-2" style="max-height: 400px;">
                    <p class="text-muted mt-2 small">Default QR Code. Please upload one in settings.</p>
                @endif
                <h4 class="mt-3 text-primary">Please Scan to Pay total: <span id="qr-amount" class="fw-bold text-success"></span></h4>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateTimers() {
        const now = Math.floor(Date.now() / 1000);
        document.querySelectorAll('.timer').forEach(el => {
            const created = parseInt(el.dataset.time);
            const diff = now - created;
            const m = Math.floor(diff / 60).toString().padStart(2, '0');
            const s = (diff % 60).toString().padStart(2, '0');
            el.textContent = `${m}:${s}`;
            
            // Visual alert for long wait times (e.g., 10 mins)
            if (diff > 600) {
                el.parentElement.classList.remove('bg-pending', 'bg-processing');
                el.parentElement.classList.add('bg-danger', 'text-white');
            }
        });
        
        const d = new Date();
        document.getElementById('clock').textContent = d.toLocaleTimeString();
    }
    
    setInterval(updateTimers, 1000);
    updateTimers();

    // Auto refresh every 30 seconds to get new orders
    setTimeout(() => window.location.reload(), 30000);

    // Sound Notification Logic
    const currentOrderIds = @json($orders->pluck('id'));
    const storedOrderIds = JSON.parse(localStorage.getItem('kds_order_ids') || '[]');
    const sound = document.getElementById('kds-alert-sound');

    // Check if there are any new orders compared to what's stored
    const hasNewOrders = currentOrderIds.some(id => !storedOrderIds.includes(id));

    if (hasNewOrders && storedOrderIds.length > 0) {
        sound.play().catch(e => console.log('Audio play failed (interaction required):', e));
    }

    // Update storage with current orders
    localStorage.setItem('kds_order_ids', JSON.stringify(currentOrderIds));

    // Handle Bank QR Modal Data
    const bankQrModal = document.getElementById('bankQrModal');
    if (bankQrModal) {
        bankQrModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const orderId = button.getAttribute('data-order-id');
            const total = button.getAttribute('data-total');
            
            const orderInfo = bankQrModal.querySelector('#qr-order-info');
            const amountSpan = bankQrModal.querySelector('#qr-amount');
            const qrImage = bankQrModal.querySelector('#bank-qr-image');
            
            if (orderId && total) {
                orderInfo.textContent = `Order #${orderId}`;
                amountSpan.textContent = `$${total}`;
                if (qrImage && qrImage.src.includes('api.qrserver.com')) {
                    qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=SamnangCoffeeBankTransfer|Order:${orderId}|Amount:${total}`;
                }
            } else {
                orderInfo.textContent = '';
                amountSpan.textContent = '';
                if (qrImage && qrImage.src.includes('api.qrserver.com')) {
                    qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=SamnangCoffeeBankTransfer`;
                }
            }
        });
    }
</script>
@endsection