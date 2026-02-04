@extends('layouts.app')

@section('title', 'New Order - Samnang Coffee')

@section('styles')
<style>
    :root {
        --brand-brown: #6f4e37;
        --brand-accent: #d4a574;
        --brand-light-bg: #f9f6f3;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
        --border-color: #e9ecef;
    }

    body {
        overflow: hidden; /* Prevent body scroll */
        background-color: #f0f2f5;
    }

    .pos-container {
        display: grid;
        grid-template-columns: 7fr 5fr;
        gap: 2rem;
        height: 100%`;
    

        padding: 1rem 0;
    }

    .products-section, .cart-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(10px);
    }

    /* === Products Section === */
    .products-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .btn-category {
        border-radius: 50px;
        font-weight: 500;
        border: 1px solid transparent;
        background-color: #fff;
        color: var(--text-light);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .btn-category:hover {
        border-color: var(--brand-accent);
        color: var(--brand-brown);
    }
    .btn-category.active {
        background: var(--brand-brown);
        background: linear-gradient(135deg, var(--brand-brown) 0%, #8a624a 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.3);
    }

    #product-search {
        border-radius: 8px;
        border: 2px solid var(--border-color);
    }
    #product-search:focus {
        border-color: var(--brand-accent);
        box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.2);
    }

    .products-grid {
        overflow-y: auto;
        padding: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 0.75rem;
        flex: 1;
    }

    .product-card {
        border: none;
        border-radius: 12px;
        text-align: center;
        padding: 0.75rem;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .product-image {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    
    .product-image-placeholder {
        width: 100%;
        height: 80px;
        background-color: var(--brand-light-bg);
        border-radius: 8px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-accent);
        font-size: 1.5rem;
    }

    .product-card .product-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 0.8rem;
        color: var(--text-dark);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.4em;
        line-height: 1.2;
    }

    .product-card .product-price {
        font-weight: 800;
        color: var(--brand-brown);
        font-size: 0.95rem;
    }

    .product-card .product-stock {
        font-size: 0.7rem;
        color: var(--text-light);
        margin-top: 0.1rem;
    }

    /* === Cart Section === */
    .cart-section {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
    }
    .cart-section h5 {
        font-weight: 700;
        color: var(--text-dark);
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .cart-items {
        overflow-y: auto;
        flex: 1;
        margin: 0 -1.5rem;
        padding: 0 1.5rem;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-details { flex: 1; }
    .cart-item-name { font-weight: 600; color: var(--text-dark); }
    .cart-item-notes { font-size: 0.8rem; color: var(--text-light); }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .quantity-controls button {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .cart-item .text-end .fw-bold {
        font-size: 1.1rem;
        color: var(--brand-brown);
    }

    .cart-summary {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px dashed var(--border-color);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 1rem;
        margin-bottom: 0.75rem;
        color: var(--text-light);
    }
    .summary-row span:last-child {
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-row.total {
        font-weight: 700;
        font-size: 1.6rem;
        color: var(--brand-brown);
        border-top: 1px solid var(--border-color);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    .summary-row.total span:last-child {
        color: var(--brand-brown);
    }

    .summary-row.discount span:last-child {
        color: #dc3545; /* Bootstrap danger color */
    }

    .cart-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    .cart-actions .btn {
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 8px;
    }
    .cart-actions .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--text-light);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .empty-cart i {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        color: #ccc;
    }

    /* === Modal === */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        
    }
    .modal-header {
        background: var(--brand-brown);
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        border-bottom: 2px solid var(--brand-accent);
        justify-items: center;
        align-items: center;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    #itemOptionsModal .btn-primary {
        background-color: var(--brand-brown);
        border-color: var(--brand-brown);
    }
    #itemOptionsModal .btn-primary:hover {
        background-color: #5a3d2a;
        border-color: #5a3d2a;
    }
    #size-options .btn.active, #sugar-options .btn.active {
        background-color: var(--brand-brown);
        color: white;
        border-color: var(--brand-brown);
    }

    /* Hide products that don't match filter */
    .product-card.hidden {
        display: none;
    }

    /* Clear Cart Modal specific styles */
    #clearCartModal .modal-header {
        background-color: #dc3545; /* Bootstrap danger color */
    }
</style>
@endsection

@section('content')
<form id="order-form" action="{{ route('orders.storePos') }}" method="POST">
    @csrf
    <div class="pos-container">
        <!-- Products Section -->
        <div class="products-section">
            <div class="products-header">
                <div class="category-filters">
                    <button type="button" class="btn btn-outline-primary btn-category active" data-category="all">All</button>
                    @foreach($categories as $category)
                        <button type="button" class="btn btn-outline-primary btn-category" data-category="{{ $category->slug }}" @if(!$category->is_active) title="This category is inactive" disabled @endif>{{ $category->name }}</button>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-secondary" id="category-subtitle">All Products</h6>
                    
                    <input type="text" id="product-search" class="form-control w-50" placeholder="Search products...">
                </div>
            </div>
            <div class="products-grid" id="products-grid">
                @foreach($products as $product)
                    <div class="product-card" 
                         data-id="{{ $product->id }}" 
                         data-name="{{ $product->name }}" 
                         data-price="{{ $product->price }}" 
                         data-category="{{ optional($product->category)->slug }}"
                         data-stock="{{ $product->stock }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                        @else
                            <div class="product-image-placeholder">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                        @endif
                        <div class="product-name">{{ $product->name }}</div>
                        <div>
                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            <div class="product-stock">
                                @if($product->stock !== null)
                                    {{ $product->stock }} in stock
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Section -->
        <div class="cart-section">
            <h5><i class="bi bi-cart-check-fill"></i> Current Order</h5>
            <div class="mb-3 text-muted">
                <i class="bi bi-person"></i> Walk-in Customer
            </div>

            <div class="cart-items" id="cart-items">
                <div class="empty-cart">
                    <i class="bi bi-cart3"></i>
                    <p>Your cart is empty</p>
                </div>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Tax (0%)</span>
                    <span id="tax">$0.00</span>
                </div>
                <div class="summary-row discount">
                    <span>Discount</span>
                    <span id="discount">-$0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">$0.00</span>
                </div>
            </div>

            <div class="mt-3">
                <textarea name="order_notes" class="form-control" rows="2" placeholder="Order notes..."></textarea>
            </div>

            <div class="cart-actions">
                <button type="button" class="btn btn-danger" id="clear-cart-btn">
                    <i class="bi bi-x-circle"></i> Clear
                </button>
                <button type="button" class="btn btn-warning text-white" id="add-discount-btn">
                    <i class="bi bi-percent"></i> Discount
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Place Order
                </button>
            </div>

            <div id="hidden-items-container"></div>
        </div>
    </div>
</form>

<!-- Item Options Modal -->
<div class="modal fade" id="itemOptionsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemOptionsModalLabel">Options for Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Size</label>
                    <div class="d-flex flex-wrap gap-2" id="size-options">
                        <button type="button" class="btn btn-outline-secondary" data-value="S">S</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="M">M</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="L">L</button>
                    </div>
                    <input type="hidden" id="selected-size">
                </div>
                <div class="mb-3">
                    <label class="form-label">Sugar Level</label>
                    <div class="d-flex flex-wrap gap-2" id="sugar-options">
                        <button type="button" class="btn btn-outline-secondary" data-value="Normal">Normal</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="100%">100%</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="50%">50%</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="20%">20%</button>
                        <button type="button" class="btn btn-outline-secondary" data-value="10%">10%</button>
                    </div>
                    <input type="hidden" id="selected-sugar">
                </div>
                <div class="mb-3">
                    <label for="item-notes" class="form-label">Additional Notes</label>
                    <textarea id="item-notes" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="add-item-to-cart-btn">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Discount Modal -->
<div class="modal fade" id="discountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="discount-value" class="form-label">Discount Amount ($)</label>
                    <input type="number" class="form-control" id="discount-value" placeholder="e.g., 5.00" min="0" step="0.01">
                </div>
                <div class="mb-3">
                    <label for="discount-percentage" class="form-label">Discount Percentage (%)</label>
                    <input type="number" class="form-control" id="discount-percentage" placeholder="e.g., 10" min="0" max="100">
                </div>
                <div class="form-text">Enter either a fixed amount or a percentage. Percentage is calculated on the subtotal.</div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-danger" id="remove-discount-btn">Remove Discount</button>
                <button type="button" class="btn btn-primary" id="apply-discount-btn">Apply</button>
            </div>
        </div>
    </div>
</div>

<!-- Clear Cart Confirmation Modal -->
<div class="modal fade" id="clearCartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Clear Cart?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove all items from the cart? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-clear-cart-btn">Yes, Clear Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Sound Effect -->
<audio id="cart-add-sound" src="https://codeskulptor-demos.commondatastorage.googleapis.com/pang/pop.mp3" preload="auto"></audio>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let cart = [];
    let discount = { type: 'fixed', value: 0 };
    let currentProduct = null;
    const itemOptionsModal = new bootstrap.Modal(document.getElementById('itemOptionsModal'));
    const clearCartModal = new bootstrap.Modal(document.getElementById('clearCartModal'));
    const discountModal = new bootstrap.Modal(document.getElementById('discountModal'));

    const productsGrid = document.getElementById('products-grid');
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalEl = document.getElementById('subtotal');
    const taxEl = document.getElementById('tax');
    const discountEl = document.getElementById('discount');
    const totalEl = document.getElementById('total');
    const hiddenItemsContainer = document.getElementById('hidden-items-container');

    // --- Product Filtering ---
    const categoryFilters = document.querySelector('.category-filters');
    const productSearch = document.getElementById('product-search');
    const allProductCards = Array.from(document.querySelectorAll('.product-card'));
    const categorySubtitle = document.getElementById('category-subtitle');

    function filterProducts() {
        const activeCategory = document.querySelector('.btn-category.active').dataset.category;
        const searchTerm = productSearch.value.toLowerCase();

        allProductCards.forEach(card => {
            const isCategoryMatch = activeCategory === 'all' || card.dataset.category === activeCategory;
            const isSearchMatch = card.dataset.name.toLowerCase().includes(searchTerm);
            
            if (isCategoryMatch && isSearchMatch) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }

    if (categoryFilters) {
        categoryFilters.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-category');
            if (button) {
                categoryFilters.querySelectorAll('.btn-category').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                categorySubtitle.textContent = button.textContent === 'All' ? 'All Products' : button.textContent;
                filterProducts();
            }
        });
    }

    productSearch.addEventListener('input', filterProducts);

    // --- Cart Logic ---
    productsGrid.addEventListener('click', function (e) {
        const card = e.target.closest('.product-card');
        if (!card) return;

        currentProduct = {
            id: card.dataset.id,
            name: card.dataset.name,
            price: parseFloat(card.dataset.price),
        };

        document.getElementById('itemOptionsModalLabel').textContent = `Options for ${currentProduct.name}`;
        document.getElementById('item-notes').value = '';
        document.getElementById('selected-sugar').value = 'Normal';
        document.querySelectorAll('#sugar-options button').forEach(btn => btn.classList.remove('active'));
        document.querySelector('#sugar-options button[data-value="Normal"]').classList.add('active');

        document.getElementById('selected-size').value = 'M';
        document.querySelectorAll('#size-options button').forEach(btn => btn.classList.remove('active'));
        document.querySelector('#size-options button[data-value="M"]').classList.add('active');

        itemOptionsModal.show();
    });

    document.getElementById('sugar-options').addEventListener('click', function(e) {
        if (e.target.tagName === 'BUTTON') {
            document.querySelectorAll('#sugar-options button').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            document.getElementById('selected-sugar').value = e.target.dataset.value;
        }
    });

    document.getElementById('size-options').addEventListener('click', function(e) {
        if (e.target.tagName === 'BUTTON') {
            document.querySelectorAll('#size-options button').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            document.getElementById('selected-size').value = e.target.dataset.value;
        }
    });

    document.getElementById('add-item-to-cart-btn').addEventListener('click', function() {
        const sugar = document.getElementById('selected-sugar').value;
        const size = document.getElementById('selected-size').value;
        const additionalNotes = document.getElementById('item-notes').value.trim();
        
        let notes = [];
        if (size) notes.push(`Size: ${size}`);
        if (sugar !== 'Normal') notes.push(`Sugar: ${sugar}`);
        if (additionalNotes) notes.push(additionalNotes);

        let price = currentProduct.price;
        if (size === 'L') {
            price += 0.50;
        }

        const existingItem = cart.find(item => item.id === currentProduct.id && item.notes === notes.join(', '));

        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                ...currentProduct,
                price: price,
                quantity: 1,
                notes: notes.join(', '),
            });
        }

        // Play sound effect
        const sound = document.getElementById('cart-add-sound');
        if (sound) {
            sound.currentTime = 0;
            sound.play().catch(e => console.log('Audio play failed:', e));
        }

        renderCart();
        itemOptionsModal.hide();
    });

    // --- Discount Logic ---
    document.getElementById('add-discount-btn').addEventListener('click', function() {
        const discountValueInput = document.getElementById('discount-value');
        const discountPercentageInput = document.getElementById('discount-percentage');

        if (discount.type === 'fixed') {
            discountValueInput.value = discount.value > 0 ? discount.value.toFixed(2) : '';
            discountPercentageInput.value = '';
        } else { // percentage
            discountValueInput.value = '';
            discountPercentageInput.value = discount.value > 0 ? discount.value : '';
        }
        discountModal.show();
    });

    document.getElementById('discount-value').addEventListener('input', () => document.getElementById('discount-percentage').value = '');
    document.getElementById('discount-percentage').addEventListener('input', () => document.getElementById('discount-value').value = '');

    document.getElementById('apply-discount-btn').addEventListener('click', function() {
        const fixedValue = parseFloat(document.getElementById('discount-value').value) || 0;
        const percentageValue = parseFloat(document.getElementById('discount-percentage').value) || 0;

        if (percentageValue > 0) {
            discount = { type: 'percentage', value: percentageValue };
        } else {
            discount = { type: 'fixed', value: fixedValue };
        }
        renderCart();
        discountModal.hide();
    });

    document.getElementById('remove-discount-btn').addEventListener('click', function() {
        discount = { type: 'fixed', value: 0 };
        renderCart();
        discountModal.hide();
    });

    function renderCart() {
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty-cart">
                    <i class="bi bi-cart3"></i>
                    <p>Your cart is empty</p>
                </div>`;
        } else {
            cartItemsContainer.innerHTML = cart.map((item, index) => `
                <div class="cart-item">
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        ${item.notes ? `<div class="cart-item-notes">${item.notes}</div>` : ''}
                    </div>
                    <div class="quantity-controls">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="${index}" data-action="decrease">-</button>
                        <span class="mx-2">${item.quantity}</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="${index}" data-action="increase">+</button>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold">${(item.price * item.quantity).toFixed(2)}</div>
                        <button type="button" class="btn btn-sm btn-link text-danger" data-index="${index}" data-action="remove">Remove</button>
                    </div>
                </div>
            `).join('');
        }
        updateSummary();
        updateHiddenInputs();
    }

    cartItemsContainer.addEventListener('click', function(e) {
        const target = e.target;
        const action = target.dataset.action;
        const index = parseInt(target.dataset.index);

        if (!action) return;

        switch(action) {
            case 'increase':
                cart[index].quantity++;
                break;
            case 'decrease':
                cart[index].quantity--;
                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1);
                }
                break;
            case 'remove':
                cart.splice(index, 1);
                break;
        }
        renderCart();
    });

    document.getElementById('clear-cart-btn').addEventListener('click', function() {
        clearCartModal.show();
    });

    document.getElementById('confirm-clear-cart-btn').addEventListener('click', function() {
        cart = [];
        renderCart();
        clearCartModal.hide();
    });

    function updateSummary() {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = 0; // Assuming 0 tax for now

        let discountAmount = 0;
        if (discount.type === 'fixed') {
            discountAmount = discount.value;
        } else if (discount.type === 'percentage') {
            discountAmount = (subtotal * discount.value) / 100;
        }

        // Ensure discount is not more than subtotal
        discountAmount = Math.min(subtotal, discountAmount);

        const total = subtotal - discountAmount + tax;

        subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
        taxEl.textContent = `$${tax.toFixed(2)}`;
        discountEl.textContent = `-$${discountAmount.toFixed(2)}`;
        totalEl.textContent = `$${total.toFixed(2)}`;
    }

    function updateHiddenInputs() {
        let inputs = cart.map((item, index) => `
            <input type="hidden" name="items[${index}][id]" value="${item.id}">
            <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
            <input type="hidden" name="items[${index}][notes]" value="${item.notes}">
        `).join('');

        if (discount.value > 0) {
            inputs += `
                <input type="hidden" name="discount_type" value="${discount.type}">
                <input type="hidden" name="discount_value" value="${discount.value}">
            `;
        }
        hiddenItemsContainer.innerHTML = inputs;
    }

    document.getElementById('order-form').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Cannot place an empty order. Please add items to the cart.');
        }
    });

    renderCart();

});
</script>
@endsection