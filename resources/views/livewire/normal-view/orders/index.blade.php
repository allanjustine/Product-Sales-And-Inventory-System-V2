<div>
    <div id="ordersPageContainer">
        @include('livewire.normal-view.orders.cancel-order')
        @include('livewire.normal-view.orders.order-received')

        <div class="container" id="ordersMainContainer">
            <div class="accordion shadow-sm rounded-4 overflow-hidden mb-4" id="deliveryAddressAccordion">
                <div class="card border-0" id="deliveryAddressCard">
                    <div class="card-header bg-gradient-primary text-white border-0" id="deliveryAddressHeader">
                        <h2 class="mb-0">
                            <button
                                class="btn btn-white btn-lg w-100 text-left text-white fw-bold d-flex align-items-center justify-content-between"
                                type="button" data-bs-toggle="collapse" data-bs-target="#deliveryAddressCollapse"
                                aria-expanded="true" aria-controls="deliveryAddressCollapse"
                                id="deliveryAddressToggleBtn">
                                <span class="d-flex align-items-center">
                                    <div class="icon-wrapper bg-white bg-opacity-20 rounded-circle p-2 me-3"
                                        id="deliveryAddressIcon">
                                        <i
                                            class="fas {{ auth()->user()->user_location ? 'fa-check' : 'fa-circle-exclamation' }}"></i>
                                    </div>
                                    <span id="deliveryAddressTitle">Delivery Address Information</span>
                                </span>
                                <i class="fas fa-chevron-down" id="deliveryAddressArrow"></i>
                            </button>
                        </h2>
                    </div>

                    <div id="deliveryAddressCollapse" class="collapse" aria-labelledby="deliveryAddressHeader"
                        data-bs-parent="#deliveryAddressAccordion">
                        <div class="card-body p-4" id="deliveryAddressBody">
                            <div class="row justify-content-center">
                                <div class="col-lg-10" id="deliveryAddressAlertContainer">
                                    <div class="alert alert-primary border-0 rounded-4 shadow-sm" role="alert"
                                        id="deliveryAddressAlert">
                                        <div class="d-flex align-items-center">
                                            <div class="alert-icon me-3 d-none d-md-block"
                                                id="deliveryAddressAlertIcon">
                                                <img src="images/mylogo.jpg" alt="Info Logo" class="rounded-3"
                                                    style="width: 80px;" id="deliveryAddressLogo">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h4 class="alert-heading fw-bold mb-0 text-black"
                                                        id="deliveryAddressAlertTitle">
                                                        <i class="fas fa-map-marker-alt me-2"></i>Your Delivery Address
                                                    </h4>
                                                    <a wire:navigate href="/profile"
                                                        class="btn btn-link btn-sm rounded-pill text-primary d-none d-md-block"
                                                        id="editAddressBtn">
                                                        <i class="fas fa-pen me-1"></i>Edit
                                                    </a>
                                                </div>
                                                <hr class="my-2" id="deliveryAddressDivider">
                                                <div class="address-content" id="deliveryAddressContent">
                                                    @if (auth()->user()->user_location)
                                                        <div class="d-flex align-items-center flex-column mb-3"
                                                            id="addressVerified">
                                                            <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 me-2"
                                                                id="addressVerifiedBadge">
                                                                <i class="fas fa-check-circle me-1"></i>Verified
                                                            </div>
                                                            <p class="mb-0 fw-semibold text-primary" id="addressText">
                                                                <i
                                                                    class="fas fa-location-dot me-2"></i>{{ auth()->user()->user_location }}
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="d-flex align-items-center mb-3" id="addressNotSet">
                                                            <div class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 me-2"
                                                                id="addressWarningBadge">
                                                                <i class="fas fa-exclamation-triangle me-1"></i>Required
                                                            </div>
                                                            <p class="mb-0 fw-semibold text-danger"
                                                                id="addressWarningText">
                                                                <i class="fas fa-circle-exclamation me-2"></i>Set up
                                                                your delivery address to ensure successful delivery
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <div class="contact-info mt-3 text-black pt-3 border-top"
                                                        id="deliveryContactInfo">
                                                        <h6 class="fw-bold mb-2" id="contactInfoTitle">
                                                            <i class="fas fa-phone me-2"></i>Contact Information
                                                        </h6>
                                                        <div class="d-flex align-items-center" id="phoneInfo">
                                                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-2 me-3"
                                                                id="phoneIcon">
                                                                <i class="fas fa-phone-alt text-white"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-black d-block" id="phoneLabel">Phone
                                                                    Number</small>
                                                                <span class="fw-semibold"
                                                                    id="phoneNumber">{{ auth()->user()->phone_number ?? 'Not provided' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block d-md-none mt-3">
                                            <a wire:navigate href="/profile"
                                                class="btn btn-primary w-100 text-white btn-sm rounded-pill text-primary">
                                                <i class="fas fa-pen me-1"></i>Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-header mb-4" id="ordersSectionHeader">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapperrounded-circle p-3 me-3" id="ordersSectionIcon">
                        <i class="fas fa-shopping-bag text-primary fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1" id="ordersTitle">My Orders</h3>
                        <p class="text-muted mb-0" id="ordersSubtitle">Track and manage your purchases</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-0" id="ordersContainer">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden" id="ordersMainCard">
                    <div class="card-header bg-white p-0 border-bottom-0" id="ordersCardHeader">
                        <ul class="nav nav-tabs nav-tabs-custom px-3" role="tablist" id="ordersTabNav">
                            <li class="nav-item" role="presentation" id="pendingTabItem">
                                <a class="nav-link active rounded-top-3" id="pendingTab" data-bs-toggle="pill"
                                    href="#pendingTabContent" role="tab" aria-controls="pendingTabContent"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center" id="pendingTabContentInner">
                                        <i class="fas fa-clock me-2"></i>
                                        <span id="pendingTabText">Pending Orders</span>
                                        @if ($pendings->count() > 0)
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill ms-2"
                                                id="pendingCountBadge">
                                                {{ $pendings->count() }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" id="recentTabItem">
                                <a class="nav-link rounded-top-3" id="recentTab" data-bs-toggle="pill"
                                    href="#recentTabContent" role="tab" aria-controls="recentTabContent"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center" id="recentTabContentInner">
                                        <i class="fas fa-history me-2"></i>
                                        <span id="recentTabText">Recent Orders</span>
                                        @if ($recents->count() > 0)
                                            <span
                                                class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill ms-2"
                                                id="recentCountBadge">
                                                {{ $recents->count() }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" id="cancelledTabItem">
                                <a class="nav-link rounded-top-3" id="cancelledTab" data-bs-toggle="pill"
                                    href="#cancelledTabContent" role="tab" aria-controls="cancelledTabContent"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center" id="cancelledTabContentInner">
                                        <i class="fas fa-ban me-2"></i>
                                        <span id="cancelledTabText">Cancelled Orders</span>
                                        @if ($cancels->count() > 0)
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill ms-2"
                                                id="cancelledCountBadge">
                                                {{ $cancels->count() }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-0" id="ordersCardBody">
                        <div class="tab-content" id="ordersTabContent">
                            <!-- Pending Orders Tab -->
                            <div class="tab-pane fade show active p-4" id="pendingTabContent" role="tabpanel"
                                aria-labelledby="pendingTab">
                                @if ($pendings->count() > 0)
                                    <div class="orders-list" id="pendingOrdersList">
                                        @foreach ($pendings as $order)
                                            <div class="order-card border rounded-4 p-3 mb-3 shadow-sm"
                                                id="pendingOrderCard{{ $order->id }}">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-md-2" id="pendingOrderImage{{ $order->id }}">
                                                        <div class="product-image-wrapper rounded-3 overflow-hidden"
                                                            id="pendingImageWrapper{{ $order->id }}">
                                                            @if (Storage::disk('public')->exists($order->product->productImages()?->first()?->path))
                                                                <img src="{{ Storage::url($order->product->productImages()?->first()?->path) }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="pendingProductImage{{ $order->id }}">
                                                            @else
                                                                <img src="{{ $order->product->productImages()?->first()?->path }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="pendingProductImage{{ $order->id }}">
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7"
                                                        id="pendingOrderDetails{{ $order->id }}">
                                                        <div class="order-info"
                                                            id="pendingOrderInfo{{ $order->id }}">
                                                            <h6 class="fw-bold text-capitalize mb-2"
                                                                id="pendingProductName{{ $order->id }}">
                                                                {{ $order->product->product_name }}
                                                            </h6>

                                                            <div class="price-info mb-2"
                                                                id="pendingPriceInfo{{ $order->id }}">
                                                                <span class="fw-semibold text-primary"
                                                                    id="pendingCurrentPrice{{ $order->id }}">
                                                                    &#8369;{{ number_format($order->product->product_price, 2) }}
                                                                </span>
                                                                @if (
                                                                    $order->product->product_old_price !== null &&
                                                                        $order->product->product_old_price !== $order->product->product_price)
                                                                    <span
                                                                        class="text-muted text-decoration-line-through ms-2"
                                                                        id="pendingOldPrice{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->product->product_old_price, 2) }}
                                                                    </span>
                                                                    <span
                                                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 ms-2"
                                                                        id="pendingDiscount{{ $order->id }}">
                                                                        {{ $order->product->discount }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            @if ($order->hasVariation())
                                                                <div class="d-flex flex-column mb-2">
                                                                    @if ($order->productSize)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Size:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productSize->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->productColor)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Color:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productColor->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            <div class="order-meta"
                                                                id="pendingOrderMeta{{ $order->id }}">
                                                                <div class="d-flex flex-wrap gap-3 mb-2">
                                                                    <span
                                                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25"
                                                                        id="pendingQuantity{{ $order->id }}">
                                                                        <i
                                                                            class="fas fa-box me-1"></i>x{{ number_format($order->order_quantity) }}
                                                                        PC(s)
                                                                    </span>
                                                                    <span class="badge bg-light text-dark border"
                                                                        id="pendingDate{{ $order->id }}">
                                                                        <i
                                                                            class="far fa-calendar me-1"></i>{{ date_format($order->created_at, 'M d, Y') }}
                                                                    </span>
                                                                </div>

                                                                <div class="order-total mb-2"
                                                                    id="pendingOrderTotal{{ $order->id }}">
                                                                    <span class="fw-bold"
                                                                        id="pendingTotalLabel{{ $order->id }}">Total:</span>
                                                                    <span class="fw-bold text-primary ms-2"
                                                                        id="pendingTotalAmount{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->order_total_amount, 2) }}
                                                                    </span>
                                                                    @if (
                                                                        $order->product->product_old_price !== null &&
                                                                            $order->product->product_old_price !== $order->product->product_price)
                                                                        <span class="text-success small ms-2"
                                                                            id="pendingSavings{{ $order->id }}">
                                                                            <i class="fas fa-save me-1"></i>Save:
                                                                            &#8369;{{ number_format($order->order_quantity * $order->product->product_old_price - $order->order_quantity * $order->product->product_price, 2) }}
                                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="order-status"
                                                                    id="pendingOrderStatus{{ $order->id }}">
                                                                    @if ($order->order_status === 'Pending')
                                                                        <span
                                                                            class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25"
                                                                            id="pendingStatusBadge{{ $order->id }}">
                                                                            <i class="fas fa-clock me-1"></i>PENDING
                                                                        </span>
                                                                    @elseif ($order->order_status === 'Processing Order')
                                                                        <span
                                                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"
                                                                            id="processingStatusBadge{{ $order->id }}">
                                                                            <i
                                                                                class="fas fa-hourglass-half me-1"></i>PREPARING
                                                                        </span>
                                                                    @elseif ($order->order_status === 'To Deliver')
                                                                        <span
                                                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25"
                                                                            id="deliverStatusBadge{{ $order->id }}">
                                                                            <i class="fas fa-truck me-1"></i>OUT FOR
                                                                            DELIVERY
                                                                        </span>
                                                                    @elseif ($order->order_status === 'Delivered')
                                                                        <span
                                                                            class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25"
                                                                            id="deliveredStatusBadge{{ $order->id }}">
                                                                            <i
                                                                                class="fas fa-box-open me-1"></i>DELIVERED
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 text-end"
                                                        id="pendingOrderActions{{ $order->id }}">
                                                        <div class="d-grid gap-2"
                                                            id="pendingActions{{ $order->id }}">
                                                            @if ($order->order_status === 'Pending')
                                                                <button
                                                                    class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                                                    data-bs-toggle="modal" data-bs-target="#cancel"
                                                                    wire:click="toCancel({{ $order->id }})"
                                                                    id="cancelOrderBtn{{ $order->id }}">
                                                                    <i class="fas fa-xmark me-1"
                                                                        id="cancelIcon{{ $order->id }}"></i>Cancel
                                                                    Order
                                                                </button>
                                                            @elseif ($order->order_status === 'Processing Order')
                                                                <button class="btn btn-success btn-sm rounded-pill"
                                                                    id="preparingBtn{{ $order->id }}">
                                                                    <i class="fas fa-cart-circle-arrow-up me-1"
                                                                        id="preparingIcon{{ $order->id }}"></i>Preparing
                                                                </button>
                                                            @elseif ($order->order_status === 'To Deliver')
                                                                <button class="btn btn-primary btn-sm rounded-pill"
                                                                    id="deliveryBtn{{ $order->id }}">
                                                                    <i class="fas fa-car-side me-1"
                                                                        id="deliveryIcon{{ $order->id }}"></i>Out
                                                                    for Delivery
                                                                </button>
                                                            @elseif ($order->order_status === 'Delivered')
                                                                <button
                                                                    class="btn btn-warning btn-sm rounded-pill shadow-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#order-received"
                                                                    wire:click="toReceived({{ $order->id }})"
                                                                    id="receivedBtn{{ $order->id }}">
                                                                    <i class="fas fa-hand-holding-heart me-1"
                                                                        id="receivedIcon{{ $order->id }}"></i>Order
                                                                    Received
                                                                </button>
                                                            @endif

                                                            <div class="transaction-code mt-2"
                                                                id="pendingTransaction{{ $order->id }}">
                                                                <small class="text-muted d-block"
                                                                    id="transactionLabel{{ $order->id }}">Transaction
                                                                    Code</small>
                                                                <code class="fw-bold"
                                                                    id="transactionCode{{ $order->id }}">{{ $order->transaction_code }}</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="grand-total-card bg-light border-0 rounded-4 p-4 mt-4 shadow-sm"
                                        id="pendingGrandTotalCard">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap"
                                            id="pendingGrandTotalContent">
                                            <div id="pendingTotalLeft">
                                                <h5 class="fw-bold mb-1" id="pendingTotalTitle">
                                                    <i class="fas fa-receipt me-2 text-primary"></i>Pending Orders
                                                    Total
                                                </h5>
                                                <p class="text-muted small mb-0" id="pendingTotalSubtitle">
                                                    {{ $pendings->count() }} order(s) pending</p>
                                            </div>
                                            <div id="pendingTotalRight">
                                                <h3 class="fw-bold text-primary mb-0" id="pendingTotalAmount">
                                                    &#8369;{{ number_format($grandTotalPending, 2) }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-state text-center py-5" id="pendingEmptyState">
                                        <div class="empty-icon mb-4" id="pendingEmptyIcon">
                                            <i class="fas fa-clock fa-4x text-muted opacity-25"></i>
                                        </div>
                                        <h5 class="text-muted mb-3" id="pendingEmptyTitle">No Pending Orders</h5>
                                        <p class="text-muted mb-4" id="pendingEmptyMessage">You don't have any pending
                                            orders at the moment.</p>
                                        <a wire:navigate href="/products"
                                            class="btn btn-primary btn-lg rounded-pill px-4" id="pendingShopBtn">
                                            <i class="fas fa-shopping-cart me-2" id="pendingShopIcon"></i>Start
                                            Shopping
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Recent Orders Tab -->
                            <div class="tab-pane fade p-4" id="recentTabContent" role="tabpanel"
                                aria-labelledby="recentTab">
                                @if ($recents->count() > 0)
                                    <div class="orders-list" id="recentOrdersList">
                                        @foreach ($recents as $order)
                                            <div class="order-card border rounded-4 p-3 mb-3 shadow-sm"
                                                id="recentOrderCard{{ $order->id }}">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-md-2" id="recentOrderImage{{ $order->id }}">
                                                        <div class="product-image-wrapper rounded-3 overflow-hidden"
                                                            id="recentImageWrapper{{ $order->id }}">
                                                            @if (Storage::disk('public')->exists($order->product->productImages()?->first()?->path))
                                                                <img src="{{ Storage::url($order->product->productImages()?->first()?->path) }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="recentProductImage{{ $order->id }}">
                                                            @else
                                                                <img src="{{ $order->product->productImages()?->first()?->path }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="recentProductImage{{ $order->id }}">
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7" id="recentOrderDetails{{ $order->id }}">
                                                        <div class="order-info"
                                                            id="recentOrderInfo{{ $order->id }}">
                                                            <h6 class="fw-bold text-capitalize mb-2"
                                                                id="recentProductName{{ $order->id }}">
                                                                {{ $order->product->product_name }}
                                                            </h6>

                                                            <div class="price-info mb-2"
                                                                id="recentPriceInfo{{ $order->id }}">
                                                                <span class="fw-semibold text-primary"
                                                                    id="recentCurrentPrice{{ $order->id }}">
                                                                    &#8369;{{ number_format($order->product->product_price, 2) }}
                                                                </span>
                                                                @if (
                                                                    $order->product->product_old_price !== null &&
                                                                        $order->product->product_old_price !== $order->product->product_price)
                                                                    <span
                                                                        class="text-muted text-decoration-line-through ms-2"
                                                                        id="recentOldPrice{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->product->product_old_price, 2) }}
                                                                    </span>
                                                                    <span
                                                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 ms-2"
                                                                        id="recentDiscount{{ $order->id }}">
                                                                        {{ $order->product->discount }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            @if ($order->hasVariation())
                                                                <div class="d-flex flex-column mb-2">
                                                                    @if ($order->productSize)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Size:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productSize->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->productColor)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Color:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productColor->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <div class="order-meta"
                                                                id="recentOrderMeta{{ $order->id }}">
                                                                <div class="d-flex flex-wrap gap-3 mb-2">
                                                                    <span
                                                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25"
                                                                        id="recentQuantity{{ $order->id }}">
                                                                        <i
                                                                            class="fas fa-box me-1"></i>x{{ number_format($order->order_quantity) }}
                                                                        PC(s)
                                                                    </span>
                                                                    <span class="badge bg-light text-dark border"
                                                                        id="recentDate{{ $order->id }}">
                                                                        <i
                                                                            class="far fa-calendar me-1"></i>{{ date_format($order->created_at, 'M d, Y') }}
                                                                    </span>
                                                                </div>

                                                                <div class="order-total mb-2"
                                                                    id="recentOrderTotal{{ $order->id }}">
                                                                    <span class="fw-bold"
                                                                        id="recentTotalLabel{{ $order->id }}">Total:</span>
                                                                    <span class="fw-bold text-primary ms-2"
                                                                        id="recentTotalAmount{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->order_total_amount, 2) }}
                                                                    </span>
                                                                    @if (
                                                                        $order->product->product_old_price !== null &&
                                                                            $order->product->product_old_price !== $order->product->product_price)
                                                                        <span class="text-success small ms-2"
                                                                            id="recentSavings{{ $order->id }}">
                                                                            <i class="fas fa-save me-1"></i>Save:
                                                                            &#8369;{{ number_format($order->order_quantity * $order->product->product_old_price - $order->order_quantity * $order->product->product_price, 2) }}
                                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="order-status"
                                                                    id="recentOrderStatus{{ $order->id }}">
                                                                    @if ($order->order_status === 'Paid')
                                                                        <span
                                                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"
                                                                            id="paidStatusBadge{{ $order->id }}">
                                                                            <i class="fas fa-check me-1"></i>PAID
                                                                        </span>
                                                                    @elseif ($order->order_status === 'Processing Order')
                                                                        <span
                                                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"
                                                                            id="processingRecentBadge{{ $order->id }}">
                                                                            <i
                                                                                class="fas fa-hourglass-half me-1"></i>PREPARING
                                                                        </span>
                                                                    @elseif ($order->order_status === 'To Deliver')
                                                                        <span
                                                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25"
                                                                            id="deliverRecentBadge{{ $order->id }}">
                                                                            <i class="fas fa-truck me-1"></i>OUT FOR
                                                                            DELIVERY
                                                                        </span>
                                                                    @elseif ($order->order_status === 'Delivered')
                                                                        <span
                                                                            class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25"
                                                                            id="deliveredRecentBadge{{ $order->id }}">
                                                                            <i
                                                                                class="fas fa-box-open me-1"></i>DELIVERED
                                                                        </span>
                                                                    @elseif ($order->order_status === 'Complete')
                                                                        <span
                                                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25"
                                                                            id="completeStatusBadge{{ $order->id }}">
                                                                            <i
                                                                                class="fas fa-check-circle me-1"></i>COMPLETE
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="mt-2">
                                                                    @for ($i = 1; $i <= $order->orderRating->rating; $i++)
                                                                        <i class="fa-solid fa-star"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 text-end"
                                                        id="recentOrderActions{{ $order->id }}">
                                                        <div class="d-grid gap-2"
                                                            id="recentActions{{ $order->id }}">
                                                            @if ($order->order_status === 'Pending')
                                                                <button
                                                                    class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                                                    data-bs-toggle="modal" data-bs-target="#cancel"
                                                                    wire:click="toCancel({{ $order->id }})"
                                                                    id="cancelRecentBtn{{ $order->id }}">
                                                                    <i class="fas fa-xmark me-1"
                                                                        id="cancelRecentIcon{{ $order->id }}"></i>Cancel
                                                                    Order
                                                                </button>
                                                            @elseif ($order->order_status === 'Complete')
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm rounded-pill"
                                                                    id="settlementBtn{{ $order->id }}">
                                                                    <i class="fa-solid fa-sack-dollar me-1"
                                                                        id="settlementIcon{{ $order->id }}"></i>Payment
                                                                    Settlement
                                                                </button>
                                                            @else
                                                                <button
                                                                    class="btn btn-outline-success btn-sm rounded-pill"
                                                                    id="paidBtn{{ $order->id }}">
                                                                    <i class="fas fa-check me-1"
                                                                        id="paidIcon{{ $order->id }}"></i>Paid
                                                                </button>
                                                            @endif

                                                            <div class="transaction-code mt-2"
                                                                id="recentTransaction{{ $order->id }}">
                                                                <small class="text-muted d-block"
                                                                    id="recentTransactionLabel{{ $order->id }}">Transaction
                                                                    Code</small>
                                                                <code class="fw-bold"
                                                                    id="recentTransactionCode{{ $order->id }}">{{ $order->transaction_code }}</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="grand-total-card bg-light border-0 rounded-4 p-4 mt-4 shadow-sm"
                                        id="recentGrandTotalCard">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap"
                                            id="recentGrandTotalContent">
                                            <div id="recentTotalLeft">
                                                <h5 class="fw-bold mb-1" id="recentTotalTitle">
                                                    <i class="fas fa-history me-2 text-info"></i>Recent Orders Total
                                                </h5>
                                                <p class="text-muted small mb-0" id="recentTotalSubtitle">
                                                    {{ $recents->count() }} order(s) completed</p>
                                            </div>
                                            <div id="recentTotalRight">
                                                <h3 class="fw-bold text-info mb-0" id="recentTotalAmount">
                                                    &#8369;{{ number_format($grandTotalRecent, 2) }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-state text-center py-5" id="recentEmptyState">
                                        <div class="empty-icon mb-4" id="recentEmptyIcon">
                                            <i class="fas fa-history fa-4x text-muted opacity-25"></i>
                                        </div>
                                        <h5 class="text-muted mb-3" id="recentEmptyTitle">No Recent Orders</h5>
                                        <p class="text-muted mb-4" id="recentEmptyMessage">Your recent orders will
                                            appear here.</p>
                                        <a wire:navigate href="/products"
                                            class="btn btn-primary btn-lg rounded-pill px-4" id="recentShopBtn">
                                            <i class="fas fa-shopping-cart me-2" id="recentShopIcon"></i>Browse
                                            Products
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Cancelled Orders Tab -->
                            <div class="tab-pane fade p-4" id="cancelledTabContent" role="tabpanel"
                                aria-labelledby="cancelledTab">
                                @if ($cancels->count() > 0)
                                    <div class="orders-list" id="cancelledOrdersList">
                                        @foreach ($cancels as $order)
                                            <div class="order-card border rounded-4 p-3 mb-3 shadow-sm bg-light"
                                                id="cancelledOrderCard{{ $order->id }}">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-md-2"
                                                        id="cancelledOrderImage{{ $order->id }}">
                                                        <div class="product-image-wrapper rounded-3 overflow-hidden opacity-75"
                                                            id="cancelledImageWrapper{{ $order->id }}">
                                                            @if (Storage::disk('public')->exists($order->product->productImages()?->first()?->path))
                                                                <img src="{{ Storage::url($order->product->productImages()?->first()?->path) }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="cancelledProductImage{{ $order->id }}">
                                                            @else
                                                                <img src="{{ $order->product->productImages()?->first()?->path }}"
                                                                    alt="{{ $order->product->product_name }}"
                                                                    class="img-fluid rounded-3"
                                                                    id="cancelledProductImage{{ $order->id }}">
                                                            @endif
                                                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-danger"
                                                                style="opacity: 0.2;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7"
                                                        id="cancelledOrderDetails{{ $order->id }}">
                                                        <div class="order-info"
                                                            id="cancelledOrderInfo{{ $order->id }}">
                                                            <h6 class="fw-bold text-capitalize mb-2 text-muted"
                                                                id="cancelledProductName{{ $order->id }}">
                                                                {{ $order->product->product_name }}
                                                            </h6>

                                                            <div class="price-info mb-2"
                                                                id="cancelledPriceInfo{{ $order->id }}">
                                                                <span class="fw-semibold text-muted"
                                                                    id="cancelledCurrentPrice{{ $order->id }}">
                                                                    &#8369;{{ number_format($order->product->product_price, 2) }}
                                                                </span>
                                                                @if (
                                                                    $order->product->product_old_price !== null &&
                                                                        $order->product->product_old_price !== $order->product->product_price)
                                                                    <span
                                                                        class="text-muted text-decoration-line-through ms-2"
                                                                        id="cancelledOldPrice{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->product->product_old_price, 2) }}
                                                                    </span>
                                                                    <span
                                                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 ms-2"
                                                                        id="cancelledDiscount{{ $order->id }}">
                                                                        {{ $order->product->discount }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            @if ($order->hasVariation())
                                                                <div class="d-flex flex-column mb-2">
                                                                    @if ($order->productSize)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Size:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productSize->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->productColor)
                                                                        <div>
                                                                            <span class="text-sm fw-bold">Color:</span>
                                                                            <span class="badge border text-muted">
                                                                                {{ $order->productColor->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <div class="order-meta"
                                                                id="cancelledOrderMeta{{ $order->id }}">
                                                                <div class="d-flex flex-wrap gap-3 mb-2">
                                                                    <span
                                                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25"
                                                                        id="cancelledQuantity{{ $order->id }}">
                                                                        <i
                                                                            class="fas fa-box me-1"></i>x{{ number_format($order->order_quantity) }}
                                                                        PC(s)
                                                                    </span>
                                                                    <span class="badge bg-light text-dark border"
                                                                        id="cancelledDate{{ $order->id }}">
                                                                        <i
                                                                            class="far fa-calendar me-1"></i>{{ date_format($order->created_at, 'M d, Y') }}
                                                                    </span>
                                                                </div>

                                                                <div class="order-total mb-2"
                                                                    id="cancelledOrderTotal{{ $order->id }}">
                                                                    <span class="fw-bold text-muted"
                                                                        id="cancelledTotalLabel{{ $order->id }}">Total:</span>
                                                                    <span class="fw-bold text-muted ms-2"
                                                                        id="cancelledTotalAmount{{ $order->id }}">
                                                                        &#8369;{{ number_format($order->order_total_amount, 2) }}
                                                                    </span>
                                                                </div>

                                                                <div class="order-status"
                                                                    id="cancelledOrderStatus{{ $order->id }}">
                                                                    <span
                                                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25"
                                                                        id="cancelledStatusBadge{{ $order->id }}">
                                                                        <i class="fas fa-ban me-1"></i>CANCELLED
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 text-end"
                                                        id="cancelledOrderActions{{ $order->id }}">
                                                        <div class="d-grid gap-2"
                                                            id="cancelledActions{{ $order->id }}">
                                                            <button onclick="rePurchase({{ $order->id }})"
                                                                class="btn btn-primary btn-sm rounded-pill shadow-sm"
                                                                id="repurchaseBtn{{ $order->id }}">
                                                                <i class="fas fa-rotate-right me-1"
                                                                    id="repurchaseIcon{{ $order->id }}"></i>Re-purchase
                                                            </button>

                                                            <div class="transaction-code mt-2"
                                                                id="cancelledTransaction{{ $order->id }}">
                                                                <small class="text-muted d-block"
                                                                    id="cancelledTransactionLabel{{ $order->id }}">Transaction
                                                                    Code</small>
                                                                <code class="fw-bold text-muted"
                                                                    id="cancelledTransactionCode{{ $order->id }}">{{ $order->transaction_code }}</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="grand-total-card bg-light border-0 rounded-4 p-4 mt-4 shadow-sm"
                                        id="cancelledGrandTotalCard">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap"
                                            id="cancelledGrandTotalContent">
                                            <div id="cancelledTotalLeft">
                                                <h5 class="fw-bold mb-1 text-muted" id="cancelledTotalTitle">
                                                    <i class="fas fa-ban me-2 text-danger"></i>Cancelled Orders Total
                                                </h5>
                                                <p class="text-muted small mb-0" id="cancelledTotalSubtitle">
                                                    {{ $cancels->count() }} order(s) cancelled</p>
                                            </div>
                                            <div id="cancelledTotalRight">
                                                <h3 class="fw-bold text-danger mb-0" id="cancelledTotalAmount">
                                                    &#8369;{{ number_format($grandTotalCancelled, 2) }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-state text-center py-5" id="cancelledEmptyState">
                                        <div class="empty-icon mb-4" id="cancelledEmptyIcon">
                                            <i class="fas fa-ban fa-4x text-muted opacity-25"></i>
                                        </div>
                                        <h5 class="text-muted mb-3" id="cancelledEmptyTitle">No Cancelled Orders</h5>
                                        <p class="text-muted mb-4" id="cancelledEmptyMessage">You haven't cancelled
                                            any orders yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #ordersPageContainer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 1rem 0;
        }

        #deliveryAddressAccordion .card {
            border: none;
        }

        #deliveryAddressHeader {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        #deliveryAddressToggleBtn {
            transition: all 0.3s ease;
            padding: 1.25rem 1.5rem;
        }

        #deliveryAddressToggleBtn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        #deliveryAddressToggleBtn:not(.collapsed) #deliveryAddressArrow {
            transform: rotate(180deg);
        }

        #deliveryAddressArrow {
            transition: transform 0.3s ease;
        }

        #deliveryAddressIcon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #deliveryAddressAlert {
            border-left: 4px solid #0d6efd;
            background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
        }

        #deliveryAddressLogo {
            transition: transform 0.3s ease;
        }

        #deliveryAddressLogo:hover {
            transform: scale(1.05);
        }

        #editAddressBtn {
            transition: all 0.3s ease;
        }

        #editAddressBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }

        #addressVerifiedBadge,
        #addressWarningBadge {
            transition: all 0.3s ease;
        }

        #addressVerifiedBadge:hover,
        #addressWarningBadge:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        #phoneIcon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #ordersSectionIcon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #ordersTitle {
            color: #2c3e50;
            font-size: 1.75rem;
        }

        #ordersSubtitle {
            font-size: 0.95rem;
        }

        #ordersMainCard {
            background: white;
            border: none;
        }

        #ordersTabNav .nav-link {
            border: none;
            padding: 1rem 1.5rem;
            color: #6c757d;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        #ordersTabNav .nav-link.active {
            background: white;
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
        }

        #ordersTabNav .nav-link:not(.active):hover {
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.05);
        }

        #pendingTab.active #pendingTabContentInner,
        #recentTab.active #recentTabContentInner,
        #cancelledTab.active #cancelledTabContentInner {
            transform: translateY(-1px);
        }

        #pendingCountBadge,
        #recentCountBadge,
        #cancelledCountBadge {
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }

        .order-card {
            background: white;
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border-color: #0d6efd;
        }

        #pendingOrderCard:hover,
        #recentOrderCard:hover,
        #cancelledOrderCard:hover {
            transform: translateY(-2px);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .product-image-wrapper img {
            transition: transform 0.3s ease;
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .product-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .badge {
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        #cancelOrderBtn:hover {
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        #receivedBtn:hover {
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
        }

        #repurchaseBtn:hover {
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }

        .grand-total-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .grand-total-card:hover {
            border-color: #0d6efd;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.1);
        }

        .empty-state {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .empty-icon i {
            animation: emptyPulse 2s infinite;
        }

        @keyframes emptyPulse {

            0%,
            100% {
                opacity: 0.25;
            }

            50% {
                opacity: 0.5;
            }
        }

        #pendingShopBtn,
        #recentShopBtn {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
            transition: all 0.3s ease;
        }

        #pendingShopBtn:hover,
        #recentShopBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        }

        #cancelledOrderCard {
            opacity: 0.9;
            background: linear-gradient(135deg, #f8f9fa 0%, #fff5f5 100%);
        }

        #cancelledProductImage {
            filter: grayscale(30%);
        }

        @media (max-width: 768px) {
            #ordersPageContainer {
                padding: 0.5rem;
            }

            #deliveryAddressToggleBtn {
                padding: 1rem;
                font-size: 0.9rem;
            }

            #ordersTitle {
                font-size: 1.5rem;
            }

            .order-card .row {
                flex-direction: column;
            }

            .order-card .col-md-2,
            .order-card .col-md-7,
            .order-card .col-md-3 {
                width: 100%;
                margin-bottom: 1rem;
            }

            #pendingOrderActions,
            #recentOrderActions,
            #cancelledOrderActions {
                text-align: left !important;
            }

            .grand-total-card {
                padding: 1.5rem !important;
            }

            #pendingTotalTitle,
            #recentTotalTitle,
            #cancelledTotalTitle {
                font-size: 1.1rem;
            }

            #pendingTotalAmount,
            #recentTotalAmount,
            #cancelledTotalAmount {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            #ordersTabNav .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            #ordersSectionIcon {
                width: 44px;
                height: 44px;
                padding: 0.75rem !important;
            }

            .empty-state {
                padding: 2rem 1rem !important;
            }

            .empty-icon i {
                font-size: 3rem;
            }

            #pendingShopBtn,
            #recentShopBtn {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
            }

            #deliveryAddressAlert {
                flex-direction: column;
                text-align: center;
            }

            #deliveryAddressAlertIcon {
                margin-bottom: 1rem;
                margin-right: 0 !important;
            }

            #editAddressBtn {
                position: static;
                margin-top: 1rem;
            }
        }

        @media (max-width: 375px) {
            #ordersTitle {
                font-size: 1.25rem;
            }

            #ordersTabNav .nav-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }

            #pendingCountBadge,
            #recentCountBadge,
            #cancelledCountBadge {
                font-size: 0.7rem;
                padding: 0.15rem 0.5rem;
            }

            .order-card {
                padding: 1rem !important;
            }

            .product-image-wrapper img {
                height: 100px;
            }

            .badge {
                font-size: 0.75rem;
            }

            .btn-sm {
                padding: 0.25rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.9);
        }

        .loading-message {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
        }

        .spinner-border {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .order-status-animation {
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        #pendingStatusBadge.order-status-animation,
        #processingStatusBadge.order-status-animation,
        #deliverStatusBadge.order-status-animation {
            animation: statusPulse 2s infinite;
        }

        .order-card.new-order {
            animation: newOrderHighlight 3s ease;
            border: 2px solid #0d6efd;
        }

        @keyframes newOrderHighlight {
            0% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const deliveryToggle = document.getElementById('deliveryAddressToggleBtn');
            const deliveryArrow = document.getElementById('deliveryAddressArrow');

            if (deliveryToggle) {
                deliveryToggle.addEventListener('click', function() {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    setTimeout(() => {
                        if (deliveryArrow) {
                            deliveryArrow.style.transform = isExpanded ? 'rotate(0deg)' :
                                'rotate(180deg)';
                        }
                    }, 300);
                });
            }

            const tabs = document.querySelectorAll('#ordersTabNav .nav-link');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            const orderCards = document.querySelectorAll('.order-card');
            orderCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
                    this.style.borderColor = '#0d6efd';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '';
                    this.style.borderColor = '#dee2e6';
                });
            });

            const repurchaseButtons = document.querySelectorAll('[id^="repurchaseBtn"]');
            repurchaseButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.add('clicked');
                    setTimeout(() => {
                        this.classList.remove('clicked');
                    }, 300);
                });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                    const activeTab = document.querySelector('#ordersTabNav .nav-link.active');
                    if (activeTab) {
                        const tabs = Array.from(document.querySelectorAll('#ordersTabNav .nav-link'));
                        const currentIndex = tabs.indexOf(activeTab);
                        let nextIndex;

                        if (e.key === 'ArrowLeft' && currentIndex > 0) {
                            nextIndex = currentIndex - 1;
                        } else if (e.key === 'ArrowRight' && currentIndex < tabs.length - 1) {
                            nextIndex = currentIndex + 1;
                        }

                        if (nextIndex !== undefined) {
                            e.preventDefault();
                            const nextTab = tabs[nextIndex];
                            const tabInstance = new bootstrap.Tab(nextTab);
                            tabInstance.show();
                        }
                    }
                }
            });

            window.addEventListener('resize', function() {
                const orderCards = document.querySelectorAll('.order-card');
                orderCards.forEach(card => {
                    if (window.innerWidth < 768) {
                        card.classList.add('mobile-view');
                    } else {
                        card.classList.remove('mobile-view');
                    }
                });
            });

            window.dispatchEvent(new Event('resize'));
        });

        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;
                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    confirmButtonText: 'Close',
                    confirmButtonColor: 'gray',
                    customClass: {
                        popup: 'animated fadeIn'
                    }
                });
            });

            Livewire.on('closeModal', function() {
                $('#cancel').modal('hide');
                $('#order-received').modal('hide');
            });

            Livewire.on('new-order-added', function(orderId) {
                const orderCard = document.getElementById(`pendingOrderCard${orderId}`);
                if (orderCard) {
                    orderCard.classList.add('new-order', 'fade-in');
                    setTimeout(() => {
                        orderCard.classList.remove('new-order');
                    }, 3000);

                    orderCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });

            Livewire.on('order-status-updated', function(data) {
                const {
                    orderId,
                    status
                } = data;
                const statusBadge = document.getElementById(`pendingStatusBadge${orderId}`) ||
                    document.getElementById(`processingStatusBadge${orderId}`) ||
                    document.getElementById(`deliverStatusBadge${orderId}`) ||
                    document.getElementById(`deliveredStatusBadge${orderId}`);

                if (statusBadge) {
                    statusBadge.classList.add('order-status-animation');
                    setTimeout(() => {
                        statusBadge.classList.remove('order-status-animation');
                    }, 2000);
                }
            });
        });

        function rePurchase(orderId) {
            Swal.fire({
                title: 'Re-purchase Order',
                html: 'Are you sure you want to re-purchase this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-rotate-right me-2"></i>Yes, re-purchase',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'animated fadeIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const repurchaseBtn = document.getElementById(`repurchaseBtn${orderId}`);
                    if (repurchaseBtn) {
                        repurchaseBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                        repurchaseBtn.disabled = true;
                    }

                    Livewire.dispatch('handleClick', {
                        orderId
                    });

                    setTimeout(() => {
                        if (repurchaseBtn) {
                            repurchaseBtn.innerHTML = '<i class="fas fa-rotate-right me-1"></i>Re-purchase';
                            repurchaseBtn.disabled = false;
                        }
                    }, 2000);
                }
            });
        }

        document.addEventListener("livewire:navigated", function() {
            window.Echo.private(`order-user-{{ auth()->id() }}`)
                .listen('.process-order-event', (e) => {
                    Livewire.dispatch('isRefresh');
                    const {
                        message,
                        status,
                        order
                    } = e;
                    toastrData(message, status, order);

                    if (order && order.id) {
                        Livewire.dispatch('new-order-added', {
                            orderId: order.id
                        });
                    }
                });
        });

        function toastrData(message, status, order) {
            toastr.success(`${message} - ${order?.product?.product_name}`, status, {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 5000,
                extendedTimeOut: 2000,
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: false,
                onclick: function() {
                    if (order && order.id) {
                        const orderCard = document.getElementById(`pendingOrderCard${order.id}`);
                        if (orderCard) {
                            orderCard.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            orderCard.classList.add('highlight');
                            setTimeout(() => {
                                orderCard.classList.remove('highlight');
                            }, 2000);
                        }
                    }
                }
            });
        }
    </script>
</div>
