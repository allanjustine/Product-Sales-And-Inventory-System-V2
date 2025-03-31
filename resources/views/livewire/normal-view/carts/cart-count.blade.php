<div class="position-relative d-block d-md-none">
    @if ($cartCounts > 0)
        <span class="badge badge-pill badge-danger position-absolute top-0 start-100 translate-middle">{{ $cartCounts }}</span>
    @endif
    <a href="/carts" wire:navigate class="btn btn-link text-white"><i class="fa-solid fa-cart-shopping"></i></a>
</div>
