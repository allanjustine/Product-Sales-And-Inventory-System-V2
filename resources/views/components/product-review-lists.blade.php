@props(['reviews' => null])

<div class="p-3 p-md-4 p-lg-5">
    <h5 class="fw-bold mb-3 mb-md-4">
        <i class="fa-solid fa-star me-2 text-warning"></i>Customer Reviews
        @if ($reviews->count() > 0)
            <span class="badge bg-primary bg-opacity-10 text-primary ms-2">{{ $reviews->count() }}
                reviews</span>
        @endif
    </h5>
    <div class="reviews-container">
        <div class="review-item border-bottom pb-3 pb-md-4 mb-3 mb-md-4">
            @forelse ($reviews as $review)
                <div class="d-flex align-items-start mb-2 mb-md-3" wire:key='{{ $review->id }}'>
                    <div class="me-2 me-md-3">
                        <div class="user-avatar rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            @if ($review?->user?->profile_image && Storage::disk('public')->exists($review?->user?->profile_image))
                                <img src="{{ Storage::url($review?->user?->profile_image) }}" alt="">
                            @else
                                <i class="fa-solid fa-user text-white fa-sm"></i>
                            @endif
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div class="mb-1">
                                <h6 class="fw-bold mb-0" style="font-size: 14px;">
                                    {{ $review?->user?->name ?: 'Anonymous' }}</h6>
                                <div class="stars mb-0" style="font-size: 11px;">
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                            <small class="text-muted mr-5"
                                style="font-size: 11px;">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1 mb-md-2"
                            style="font-size: 13px; line-height: 1.4; word-break: break-all; white-space: pre-wrap;">
                            {{ $review->review }}</p>

                        <div class="review-images row g-1 g-md-2 mt-1 mt-md-2">
                            @foreach ($review->ratingImages as $image)
                                <div class="col-6 col-md-auto">
                                    <img src="{{ Storage::url($image->path) }}" class="rounded border img-fluid"
                                        style="height: 60px; width: 100%; object-fit: cover; cursor: pointer;"
                                        onclick="openImageModal(this.src)" wire:key='{{ $image->id }}'>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-star text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="text-muted mb-3">This product has no reviews yet.</h3>
                </div>
            @endforelse
        </div>
    </div>
</div>
