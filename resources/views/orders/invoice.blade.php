@extends('layouts.app')

@section('title', 'Invoice #' . $order->id)

@section('styles')
<style>
    body {
        background-color: #f0f2f5;
    }
    .invoice-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    .invoice-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 100%;
        max-width: 420px;
        position: relative;
        border: 1px solid #e9ecef;
    }
    /* Receipt jagged edge effect */
    .invoice-card::after {
        content: "";
        background: linear-gradient(135deg, #f0f2f5 10px, transparent 0) 0 10px,
                    linear-gradient(225deg, #f0f2f5 10px, transparent 0) 0 10px;
        background-size: 20px 20px;
        background-repeat: repeat-x;
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        transform: rotate(180deg);
    }
    
    .invoice-header {
        background: linear-gradient(135deg, #6f4e37 0%, #8a624a 100%);
        color: white;
        padding: 2.5rem 2rem 2rem;
        text-align: center;
    }
    .invoice-title {
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .invoice-date {
        font-size: 0.9rem;
        opacity: 0.7;
        margin-top: -0.75rem;
        margin-bottom: 1.5rem;
    }
    .brand-icon {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .brand-name {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    .invoice-id {
        opacity: 0.8;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
    }
    .waiting-number {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .waiting-number .number {
        font-size: 4.5rem;
        font-weight: 800;
        color: #6f4e37;
        line-height: 1;
        display: block;
    }
    .waiting-number .label {
        text-transform: uppercase;
        font-size: 0.9rem;
        color: #6c757d;
        letter-spacing: 1px;
    }

    .invoice-body {
        padding: 2rem;
    }
    .order-meta {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px dashed #eee;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }
    .invoice-table th, .invoice-table td {
        border: 1px solid #dee2e6;
        padding: 8px;
        font-size: 0.9rem;
        vertical-align: top;
    }

    .invoice-summary {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 2px solid #f8f9fa;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        color: #6c757d;
        font-size: 0.95rem;
    }
    .summary-row.total {
        color: #6f4e37;
        font-weight: 800;
        font-size: 1.4rem;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px dashed #eee;
    }

    .invoice-footer {
        text-align: center;
        margin-top: 2rem;
    }
    .thank-you {
        font-family: cursive;
        color: #d4a574;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }
    
    @media print {
        body * { visibility: hidden; }
        .invoice-card, .invoice-card * { visibility: visible; }
        .invoice-card { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; max-width: none; }
        .no-print { display: none !important; }
    }
</style>
@endsection

@section('content')
<div class="invoice-container">
    <div class="invoice-card">
        <div class="invoice-header">
            
            <div class="brand-icon"><i class="bi bi-cup-hot-fill"></i></div>
            <div class="brand-name">Samnang Coffee</div>
            <div class="invoice-title">Invoice</div>

           
           
            
        </div>

        <div class="invoice-body">
            <div class="waiting-number">
                <span class="label">Queue Number</span>
                <span class="number">{{ $order->waiting_number ?? $order->id }}</span>
            </div>
            <div class="order-meta">
                <div>Server: {{ Auth::user()->name ?? 'Staff' }}</div>
                <div>Receipt #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div style="flex-basis: 100%; margin-top: 0.5rem;">Date: {{ $order->created_at->format('M d, Y h:i A') }}</div>
            </div>
            
            <table class="invoice-table">
                <thead>
                    <tr style="background-color: #f8f9fa; text-transform: uppercase; font-size: 0.75rem;">
                        <th class="text-center" style="width: 40px;">No</th>
                        <th>Item</th>
                        <th class="text-center" style="width: 50px;">Qty</th>
                        <th class="text-end" style="width: 80px;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #2c3e50;">{{ $item->product->name }}</div>
                            @if($item->notes) <div style="font-size: 0.8rem; color: #999;">{{ $item->notes }}</div> @endif
                        </td>
                        <td class="text-center" style="font-weight: 600;">{{ $item->quantity }}</td>
                        <td class="text-end" style="font-weight: 700;">${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="invoice-summary">
                <div class="summary-row"><span>Subtotal</span><span>${{ number_format($order->subtotal > 0 ? $order->subtotal : $order->total + $order->discount - $order->tax, 2) }}</span></div>
                @if($order->discount > 0)
                <div class="summary-row" style="color: #dc3545;"><span>Discount</span><span>-${{ number_format($order->discount, 2) }}</span></div>
                @endif
                <div class="summary-row"><span>Tax</span><span>${{ number_format($order->tax, 2) }}</span></div>
                <div class="summary-row total"><span>Total</span><span>${{ number_format($order->total, 2) }}</span></div>
            </div>

            <div class="invoice-footer">
                <div class="thank-you">Thank you for your order!</div>
                
                <div class="d-grid gap-2 no-print">
                    <button onclick="window.print()" class="btn btn-primary btn-lg"><i class="bi bi-printer"></i> Print Receipt</button>
                    <a href="{{ route('orders.pos') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> New Order</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-dark"><i class="bi bi-list-ul"></i> Order History</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.onload = function() {
        window.print();
    }
</script>
@endsection