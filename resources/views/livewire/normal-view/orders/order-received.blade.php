<div>
    <div>
        <div wire:ignore.self class="modal fade" id="order-received" tabindex="-1" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg" id="ratingModalContent">
                    <div class="modal-header bg-gradient-warning text-white p-4 border-0" id="ratingModalHeader">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3" id="ratingModalIcon">
                                <i class="fas fa-star fa-lg text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1" id="ratingModalTitle">Rate Your Product</h4>
                                <p class="mb-0 opacity-75" id="ratingModalSubtitle">Share your experience</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close" id="closeRatingModalBtn"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" id="ratingModalBody"
                        style="max-height: calc(100vh - 300px); overflow-y: auto;">
                        <div class="rating-container" id="ratingContainer">
                            <div class="rating-intro p-4 border-bottom" id="ratingIntroSection">
                                <div class="text-center" id="ratingIntroContent">
                                    <div class="rating-icon mb-3" id="ratingMainIcon">
                                        <i class="fas fa-box-open fa-4x text-warning opacity-75"></i>
                                    </div>
                                    <h3 class="fw-bold mb-3" id="ratingQuestion">How would you rate this product?</h3>
                                    <p class="text-muted mb-4" id="ratingDescription">Your feedback helps us improve our
                                        products and services</p>
                                </div>
                            </div>

                            <div class="rating-form-section p-4" id="ratingFormSection">
                                <form class="rating-form" id="ratingForm">
                                    @csrf
                                    <div class="star-rating-wrapper text-center mb-4" id="starRatingWrapper">
                                        <div class="stars-container" id="starsContainer">
                                            <fieldset class="rating-fieldset" id="ratingFieldset">
                                                <input type="radio" id="ratingStar5" name="rating" value="5"
                                                    wire:model.live.debounce.200ms="product_rating" class="rating-input"
                                                    id="ratingInput5">
                                                <label for="ratingStar5" title="Excellent - 5 stars" class="star-label"
                                                    id="starLabel5">
                                                    <i class="fas fa-star fa-3x" id="starIcon5"></i>
                                                </label>

                                                <input type="radio" id="ratingStar4" name="rating" value="4"
                                                    wire:model.live.debounce.200ms="product_rating" class="rating-input"
                                                    id="ratingInput4">
                                                <label for="ratingStar4" title="Good - 4 stars" class="star-label"
                                                    id="starLabel4">
                                                    <i class="fas fa-star fa-3x" id="starIcon4"></i>
                                                </label>

                                                <input type="radio" id="ratingStar3" name="rating" value="3"
                                                    wire:model.live.debounce.200ms="product_rating" class="rating-input"
                                                    id="ratingInput3">
                                                <label for="ratingStar3" title="Average - 3 stars" class="star-label"
                                                    id="starLabel3">
                                                    <i class="fas fa-star fa-3x" id="starIcon3"></i>
                                                </label>

                                                <input type="radio" id="ratingStar2" name="rating" value="2"
                                                    wire:model.live.debounce.200ms="product_rating" class="rating-input"
                                                    id="ratingInput2">
                                                <label for="ratingStar2" title="Fair - 2 stars" class="star-label"
                                                    id="starLabel2">
                                                    <i class="fas fa-star fa-3x" id="starIcon2"></i>
                                                </label>

                                                <input type="radio" id="ratingStar1" name="rating" value="1"
                                                    wire:model.live.debounce.200ms="product_rating"
                                                    class="rating-input" id="ratingInput1">
                                                <label for="ratingStar1" title="Poor - 1 star" class="star-label"
                                                    id="starLabel1">
                                                    <i class="fas fa-star fa-3x" id="starIcon1"></i>
                                                </label>
                                            </fieldset>
                                        </div>

                                        <div class="rating-labels mt-4" id="ratingLabels">
                                            <div class="d-flex justify-content-between px-3" id="ratingScale">
                                                <small class="text-muted" id="ratingPoor">Poor</small>
                                                <small class="text-muted" id="ratingFair">Fair</small>
                                                <small class="text-muted" id="ratingAverage">Average</small>
                                                <small class="text-muted" id="ratingGood">Good</small>
                                                <small class="text-muted" id="ratingExcellent">Excellent</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="selected-rating-display text-center mt-4" id="selectedRatingDisplay">
                                        <div class="selected-rating-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-4 py-2 d-inline-flex align-items-center"
                                            id="selectedRatingBadge"
                                            style="{{ $product_rating ? '' : 'display: none;' }}">
                                            <i class="fas fa-star me-2" id="selectedRatingIcon"></i>
                                            <span class="fw-bold" id="selectedRatingText">
                                                {{ $product_rating ?? 0 }} out of 5 stars
                                            </span>
                                        </div>
                                    </div>

                                    <div class="rating-feedback mt-4" id="ratingFeedback">
                                        <div class="feedback-messages" id="feedbackMessages">
                                            <div class="feedback-item text-center" id="feedback5"
                                                style="{{ $product_rating == 5 ? '' : 'display: none;' }}">
                                                <h6 class="text-success mb-2" id="feedbackTitle5">
                                                    <i class="fas fa-heart me-2"></i>Excellent!
                                                </h6>
                                                <p class="text-muted small mb-0" id="feedbackText5">
                                                    Thank you! We're thrilled you love our product!
                                                </p>
                                            </div>
                                            <div class="feedback-item text-center" id="feedback4"
                                                style="{{ $product_rating == 4 ? '' : 'display: none;' }}">
                                                <h6 class="text-primary mb-2" id="feedbackTitle4">
                                                    <i class="fas fa-thumbs-up me-2"></i>Great!
                                                </h6>
                                                <p class="text-muted small mb-0" id="feedbackText4">
                                                    We're glad you had a positive experience!
                                                </p>
                                            </div>
                                            <div class="feedback-item text-center" id="feedback3"
                                                style="{{ $product_rating == 3 ? '' : 'display: none;' }}">
                                                <h6 class="text-info mb-2" id="feedbackTitle3">
                                                    <i class="fas fa-meh me-2"></i>Average
                                                </h6>
                                                <p class="text-muted small mb-0" id="feedbackText3">
                                                    Thanks for your feedback. We'll strive to improve!
                                                </p>
                                            </div>
                                            <div class="feedback-item text-center" id="feedback2"
                                                style="{{ $product_rating == 2 ? '' : 'display: none;' }}">
                                                <h6 class="text-warning mb-2" id="feedbackTitle2">
                                                    <i class="fas fa-frown me-2"></i>Fair
                                                </h6>
                                                <p class="text-muted small mb-0" id="feedbackText2">
                                                    We appreciate your honesty. We'll work to do better!
                                                </p>
                                            </div>
                                            <div class="feedback-item text-center" id="feedback1"
                                                style="{{ $product_rating == 1 ? '' : 'display: none;' }}">
                                                <h6 class="text-danger mb-2" id="feedbackTitle1">
                                                    <i class="fas fa-sad-tear me-2"></i>Poor
                                                </h6>
                                                <p class="text-muted small mb-0" id="feedbackText1">
                                                    We apologize for the experience. We'll address this.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @error('product_rating')
                                        <div class="rating-error alert alert-danger alert-dismissible fade show mt-4"
                                            role="alert" id="ratingErrorAlert">
                                            <div class="d-flex align-items-center" id="ratingErrorContent">
                                                <i class="fas fa-exclamation-circle me-2" id="ratingErrorIcon"></i>
                                                <div>
                                                    <span class="fw-semibold" id="ratingErrorMessage">Rating
                                                        Required</span>
                                                    <p class="mb-0 small" id="ratingErrorDetail">{{ $message }}</p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close" id="closeRatingErrorBtn"></button>
                                        </div>
                                    @enderror

                                    <div class="px-3">
                                        <div class="d-flex ga-1">
                                            <input type="checkbox" wire:model.live="is_anonymous"
                                                class="form-check-input" id="anonymousCheckbox">
                                            <label class="form-check-label" for="anonymousCheckbox"><i
                                                    class="fa-solid fa-user-secret"></i> Review as anonymous</label>
                                        </div>
                                        <span class="text-muted text-sm">Your name will not be shown publicly.</span>
                                    </div>

                                    <!-- Review Textarea Section -->
                                    <div class="review-section mt-5" id="reviewSection">
                                        <div class="review-header mb-3" id="reviewHeader">
                                            <h5 class="fw-bold text-dark mb-2" id="reviewTitle">
                                                <i class="fas fa-comment-alt me-2 text-warning"></i>
                                                Write Your Review
                                            </h5>
                                            <p class="text-muted small mb-0" id="reviewDescription">
                                                Share your detailed experience with this product
                                            </p>
                                        </div>

                                        <div class="review-textarea-wrapper" id="reviewTextareaWrapper">
                                            <textarea wire:model.live.debounce.500ms="review" class="form-control review-textarea" id="reviewTextarea"
                                                rows="4" maxlength="1000"
                                                placeholder="Tell us more about your experience with this product... What did you like? What could be improved?"
                                                style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;"></textarea>
                                            <div class="d-flex justify-content-end align-items-center mt-2">
                                                <small class="text-muted" id="reviewOptional">
                                                    Optional
                                                </small>
                                            </div>
                                        </div>

                                        @error('review')
                                            <div class="alert alert-danger alert-dismissible fade show mt-2"
                                                role="alert" id="reviewErrorAlert">
                                                <div class="d-flex align-items-center" id="reviewErrorContent">
                                                    <i class="fas fa-exclamation-circle me-2" id="reviewErrorIcon"></i>
                                                    <span class="fw-semibold"
                                                        id="reviewErrorMessage">{{ $message }}</span>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Image Upload Section -->
                                    <div class="image-upload-section mt-5" id="imageUploadSection">
                                        <div class="upload-header mb-3" id="uploadHeader">
                                            <h5 class="fw-bold text-dark mb-2" id="uploadTitle">
                                                <i class="fas fa-images me-2 text-warning"></i>
                                                Upload Product Photos
                                            </h5>
                                            <p class="text-muted small mb-0" id="uploadDescription">
                                                Share photos of your product (JPG, JPEG, PNG only)
                                            </p>
                                        </div>

                                        <div class="upload-area-wrapper" id="uploadAreaWrapper">
                                            <div class="upload-area border rounded-3 p-4 text-center position-relative"
                                                wire:loading.attr='disabled' wire:target='images' id="uploadArea"
                                                style="border-style: dashed !important; border-color: #dee2e6; background: #f8f9fa; cursor: pointer; transition: all 0.3s ease;"
                                                onclick="document.getElementById('imageUpload').click()">
                                                <input type="file" wire:model.live="images" id="imageUpload"
                                                    class="d-none" multiple accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG">

                                                <div class="upload-icon mb-3" id="uploadIcon">
                                                    <i
                                                        class="fas fa-cloud-upload-alt fa-3x text-warning opacity-75"></i>
                                                </div>

                                                <h6 class="fw-bold mb-2" id="uploadAreaTitle" wire:loading.remove
                                                    wire:target='images'>
                                                    Drop images here or click to upload
                                                </h6>

                                                <p class="text-muted small mb-3" id="uploadAreaDescription"
                                                    wire:loading.remove wire:target='images'>
                                                    Maximum 5 images • JPG, JPEG, PNG only • 5MB max per image
                                                </p>

                                                <h6 class="fw-bold mb-2" id="uploadAreaTitle" wire:loading
                                                    wire:target='images'>
                                                    Uploading...
                                                </h6>

                                                <button wire:loading.remove wire:loading.attr='disabled'
                                                    wire:target='images' type="button"
                                                    class="btn btn-warning rounded-pill px-4" id="uploadButton">
                                                    <i class="fas fa-plus me-2"></i>Choose Files
                                                </button>
                                            </div>

                                            <!-- Uploaded Images Preview -->
                                            <div class="uploaded-images-preview mt-3" id="uploadedImagesPreview"
                                                wire:loading.attr='disabled' wire:target='images'>
                                                @if ($this->old_images && count($this->old_images) > 0)
                                                    <div class="row g-2" id="imagesPreviewRow">
                                                        @foreach ($this->old_images as $index => $image)
                                                            <div class="col-4 col-md-3"
                                                                id="imagePreview{{ $index }}">
                                                                <div class="image-preview-container position-relative rounded border overflow-hidden"
                                                                    style="aspect-ratio: 1/1;">
                                                                    <img src="{{ $image->temporaryUrl() }}"
                                                                        alt="Preview {{ $index + 1 }}"
                                                                        class="img-fluid w-100 h-100 object-fit-cover">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-1"
                                                                        style="width: 24px; height: 24px; border-radius: 50%;"
                                                                        wire:click="removeImage({{ $index }})">
                                                                        <i class="fas fa-times fa-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="upload-info mt-2" id="uploadInfo">
                                                        <small class="text-success">
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            {{ count($this->old_images) }} image(s) selected
                                                        </small>
                                                    </div>
                                                @else
                                                    <div class="no-images text-center py-3" id="noImages"
                                                        wire:loading.remove wire:target='images'>
                                                        <i class="fas fa-images fa-2x text-muted opacity-50 mb-2"></i>
                                                        <p class="text-muted small mb-0">No images selected yet</p>
                                                    </div>
                                                @endif
                                            </div>

                                            @error('images.*')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2"
                                                    role="alert" id="imageErrorAlert">
                                                    <div class="d-flex align-items-center" id="imageErrorContent">
                                                        <i class="fas fa-exclamation-circle me-2" id="imageErrorIcon"></i>
                                                        <span class="fw-semibold"
                                                            id="imageErrorMessage">{{ $message }}</span>
                                                    </div>
                                                </div>
                                            @enderror

                                            <!-- File Type Validation Error -->
                                            @error('images')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2"
                                                    role="alert" id="fileTypeErrorAlert">
                                                    <div class="d-flex align-items-center" id="fileTypeErrorContent">
                                                        <i class="fas fa-exclamation-circle me-2"
                                                            id="fileTypeErrorIcon"></i>
                                                        <span class="fw-semibold"
                                                            id="fileTypeErrorMessage">{{ $message }}</span>
                                                    </div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top p-4" id="ratingModalFooter">
                        <div class="d-grid gap-2 w-100" id="ratingActionButtons">
                            <button class="btn btn-warning btn-lg rounded-pill shadow-sm" type="button"
                                wire:click="submitRating" wire:loading.attr='disabled'
                                wire:target='submitRating,product_rating,review,images,is_anonymous'
                                id="submitRatingBtn">
                                <div class="d-flex align-items-center justify-content-center"
                                    id="submitRatingContent">
                                    <span wire:target='submitRating' wire:loading.remove id="submitRatingText">
                                        <i class="fas fa-thumbs-up me-2" id="submitRatingIcon"></i>Submit Review
                                    </span>
                                    <span wire:target='submitRating' wire:loading id="submittingRatingText">
                                        <span class="spinner-border spinner-border-sm me-2"
                                            id="submittingSpinner"></span>
                                        Submitting...
                                    </span>
                                </div>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill"
                                data-bs-dismiss="modal" id="closeRatingBtn">
                                <i class="fas fa-times me-2" id="closeRatingIcon"></i>Skip for Now
                            </button>
                        </div>

                        <div class="additional-info mt-3 text-center w-100" id="ratingAdditionalInfo">
                            <small class="text-muted" id="ratingPrivacyInfo">
                                <i class="fas fa-lock me-1"></i>
                                Your rating helps improve our products for everyone
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #ratingModalContent {
            border: none;
            max-width: 550px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        #ratingModalHeader {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        }

        #ratingModalIcon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: ratingIconSpin 3s linear infinite;
        }

        @keyframes ratingIconSpin {
            0% {
                transform: rotate(0deg) scale(1);
            }

            25% {
                transform: rotate(90deg) scale(1.1);
            }

            50% {
                transform: rotate(180deg) scale(1);
            }

            75% {
                transform: rotate(270deg) scale(1.1);
            }

            100% {
                transform: rotate(360deg) scale(1);
            }
        }

        #ratingModalTitle {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        #ratingModalSubtitle {
            font-size: 0.875rem;
        }

        #ratingMainIcon {
            animation: ratingFloat 3s ease-in-out infinite;
        }

        @keyframes ratingFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        #ratingQuestion {
            color: #2c3e50;
            font-size: 1.75rem;
        }

        #ratingDescription {
            font-size: 1rem;
            max-width: 300px;
            margin: 0 auto;
        }

        #ratingFieldset {
            border: none;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .rating-input {
            display: none;
        }

        .star-label {
            cursor: pointer;
            transition: all 0.3s ease;
            color: #dee2e6;
            margin: 0 5px;
            position: relative;
        }

        .star-label:hover,
        .star-label:hover~.star-label {
            color: #ffc107;
            transform: scale(1.2);
        }

        #starIcon5,
        #starIcon4,
        #starIcon3,
        #starIcon2,
        #starIcon1 {
            transition: all 0.3s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .rating-input:checked~.star-label {
            color: #ffc107;
        }

        #ratingInput5:checked~#starLabel5 #starIcon5,
        #ratingInput4:checked~#starLabel4 #starIcon4,
        #ratingInput3:checked~#starLabel3 #starIcon3,
        #ratingInput2:checked~#starLabel2 #starIcon2,
        #ratingInput1:checked~#starLabel1 #starIcon1 {
            animation: starSelect 0.5s ease;
            text-shadow: 0 0 15px rgba(255, 193, 7, 0.5);
        }

        @keyframes starSelect {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

        #ratingInput5:checked~#starLabel5,
        #ratingInput5:checked~#starLabel5~.star-label {
            color: #ffc107;
        }

        #ratingInput4:checked~#starLabel4,
        #ratingInput4:checked~#starLabel4~.star-label {
            color: #ffc107;
        }

        #ratingInput3:checked~#starLabel3,
        #ratingInput3:checked~#starLabel3~.star-label {
            color: #ffc107;
        }

        #ratingInput2:checked~#starLabel2,
        #ratingInput2:checked~#starLabel2~.star-label {
            color: #ffc107;
        }

        #ratingInput1:checked~#starLabel1,
        #ratingInput1:checked~#starLabel1~.star-label {
            color: #ffc107;
        }

        #ratingScale {
            max-width: 400px;
            margin: 0 auto;
        }

        #selectedRatingBadge {
            transition: all 0.3s ease;
            animation: ratingBadgePulse 2s infinite;
        }

        @keyframes ratingBadgePulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 4px 8px rgba(255, 193, 7, 0.1);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 12px rgba(255, 193, 7, 0.2);
            }
        }

        #selectedRatingIcon {
            animation: ratingStarTwinkle 1.5s infinite;
        }

        @keyframes ratingStarTwinkle {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .feedback-item {
            animation: feedbackFadeIn 0.5s ease;
            padding: 1rem;
            border-radius: 0.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 1px solid #dee2e6;
        }

        @keyframes feedbackFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Review Textarea Styles */
        .review-textarea {
            resize: none;
            padding: 15px;
            font-size: 14px;
            line-height: 1.5;
            transition: all 0.3s ease;
        }

        .review-textarea:focus {
            border-color: #ffc107 !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
            outline: none;
        }

        .review-textarea:hover {
            border-color: #ced4da;
        }

        #reviewCounter {
            font-size: 12px;
        }

        /* Image Upload Styles */
        #uploadArea:hover {
            border-color: #ffc107 !important;
            background: #fff9e6 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #uploadArea.drag-over {
            border-color: #28a745 !important;
            background: #e6ffed !important;
        }

        #uploadIcon {
            animation: uploadFloat 2s ease-in-out infinite;
        }

        @keyframes uploadFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        #uploadButton:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
        }

        .image-preview-container {
            transition: all 0.3s ease;
        }

        .image-preview-container:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .image-preview-container .btn-danger {
            opacity: 0.8;
            transition: all 0.2s ease;
        }

        .image-preview-container:hover .btn-danger {
            opacity: 1;
        }

        #imageErrorAlert,
        #fileTypeErrorAlert,
        #reviewErrorAlert {
            animation: errorSlideIn 0.3s ease-out;
        }

        @keyframes errorSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #ratingErrorAlert {
            border-left: 4px solid #dc3545;
            background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
            animation: ratingErrorSlideIn 0.3s ease-out;
        }

        @keyframes ratingErrorSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #ratingErrorIcon {
            animation: ratingErrorPulse 1s infinite;
        }

        @keyframes ratingErrorPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        #submitRatingBtn {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #submitRatingBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.3);
            background: linear-gradient(135deg, #ff9800 0%, #fb8c00 100%);
        }

        #submitRatingBtn:active:not(:disabled) {
            transform: translateY(0);
        }

        #submitRatingBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #submitRatingIcon {
            transition: transform 0.3s ease;
        }

        #submitRatingBtn:hover #submitRatingIcon {
            transform: scale(1.2) rotate(-5deg);
        }

        #submittingSpinner {
            animation: ratingSpin 1s linear infinite;
        }

        @keyframes ratingSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #closeRatingBtn {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        #closeRatingBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
            background: rgba(108, 117, 125, 0.05);
        }

        #closeRatingIcon {
            transition: transform 0.3s ease;
        }

        #closeRatingBtn:hover #closeRatingIcon {
            transform: rotate(90deg);
        }

        #closeRatingBtn:hover {
            color: gray;
        }

        #ratingPrivacyInfo {
            transition: opacity 0.3s ease;
        }

        #ratingModalContent:focus-within {
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
        }

        .star-label::after {
            content: attr(title);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .star-label:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: -25px;
        }

        @media (max-width: 576px) {
            #ratingModalContent {
                margin: 0.5rem;
                max-width: 95%;
            }

            #ratingModalHeader {
                padding: 1.5rem !important;
            }

            #ratingIntroSection,
            #ratingFormSection {
                padding: 1.5rem !important;
            }

            #ratingModalFooter {
                padding: 1.5rem !important;
            }

            #ratingQuestion {
                font-size: 1.5rem;
            }

            #ratingDescription {
                font-size: 0.9rem;
            }

            #starIcon5,
            #starIcon4,
            #starIcon3,
            #starIcon2,
            #starIcon1 {
                font-size: 2.5rem !important;
            }

            #submitRatingBtn,
            #closeRatingBtn {
                padding: 0.75rem !important;
                font-size: 1rem;
            }

            #ratingModalTitle {
                font-size: 1.25rem;
            }

            #ratingMainIcon i {
                font-size: 3rem;
            }

            .review-textarea {
                font-size: 13px;
                padding: 12px;
            }

            .upload-area {
                padding: 2rem !important;
            }

            #uploadIcon i {
                font-size: 2.5rem;
            }

            .star-label::after {
                display: none;
            }
        }

        @media (max-width: 375px) {
            #ratingModalTitle {
                font-size: 1.1rem;
            }

            #ratingQuestion {
                font-size: 1.25rem;
            }

            #starIcon5,
            #starIcon4,
            #starIcon3,
            #starIcon2,
            #starIcon1 {
                font-size: 2rem !important;
                margin: 0 2px;
            }

            #ratingScale {
                font-size: 0.8rem;
            }

            .feedback-item {
                padding: 0.75rem;
            }

            #selectedRatingBadge {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .upload-area {
                padding: 1.5rem !important;
            }

            #uploadAreaTitle {
                font-size: 0.9rem;
            }

            #uploadAreaDescription {
                font-size: 0.8rem;
            }
        }

        #submitRatingBtn:focus,
        #closeRatingBtn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
        }

        #submitRatingBtn.clicked {
            animation: ratingClickEffect 0.3s ease;
        }

        @keyframes ratingClickEffect {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
            }
        }

        .star-label.selected {
            animation: selectedStarGlow 2s infinite;
        }

        @keyframes selectedStarGlow {

            0%,
            100% {
                text-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
            }

            50% {
                text-shadow: 0 0 20px rgba(255, 193, 7, 0.8), 0 0 30px rgba(255, 193, 7, 0.4);
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('order-received');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    Livewire.dispatch('resetInputs');
                });
                // Image upload drag and drop
                const uploadArea = document.getElementById('uploadArea');
                const fileInput = document.getElementById('imageUpload');

                if (uploadArea && fileInput) {
                    // Prevent default drag behaviors
                    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                        uploadArea.addEventListener(eventName, preventDefaults, false);
                    });

                    function preventDefaults(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    // Highlight drop area when item is dragged over it
                    ['dragenter', 'dragover'].forEach(eventName => {
                        uploadArea.addEventListener(eventName, highlight, false);
                    });

                    ['dragleave', 'drop'].forEach(eventName => {
                        uploadArea.addEventListener(eventName, unhighlight, false);
                    });

                    function highlight(e) {
                        uploadArea.classList.add('drag-over');
                    }

                    function unhighlight(e) {
                        uploadArea.classList.remove('drag-over');
                    }

                    // Handle dropped files
                    uploadArea.addEventListener('drop', handleDrop, false);

                    function handleDrop(e) {
                        const dt = e.dataTransfer;
                        const files = dt.files;

                        if (files.length > 0) {
                            // Validate file types
                            const validFiles = Array.from(files).filter(file => {
                                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                                return validTypes.includes(file.type);
                            });

                            if (validFiles.length > 0) {
                                // Create a new DataTransfer object
                                const dataTransfer = new DataTransfer();

                                // Add existing files if any
                                if (fileInput.files) {
                                    Array.from(fileInput.files).forEach(file => {
                                        dataTransfer.items.add(file);
                                    });
                                }

                                // Add new files (limit to 5 total)
                                let fileCount = dataTransfer.items.length;
                                for (let file of validFiles) {
                                    if (fileCount < 5) {
                                        dataTransfer.items.add(file);
                                        fileCount++;
                                    }
                                }

                                // Assign files to input
                                fileInput.files = dataTransfer.files;

                                // Trigger change event
                                fileInput.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                            } else {
                                alert('Only JPG, JPEG, and PNG files are allowed.');
                            }
                        }
                    }
                }

                // Rating functionality
                const ratingInputs = document.querySelectorAll('.rating-input');
                const starLabels = document.querySelectorAll('.star-label');
                const selectedRatingBadge = document.getElementById('selectedRatingBadge');
                const selectedRatingText = document.getElementById('selectedRatingText');
                const feedbackItems = document.querySelectorAll('.feedback-item');

                ratingInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const rating = this.value;

                        starLabels.forEach(label => {
                            label.classList.remove('selected');
                        });

                        for (let i = 1; i <= rating; i++) {
                            const starLabel = document.getElementById(`starLabel${i}`);
                            if (starLabel) {
                                starLabel.classList.add('selected');
                            }
                        }

                        if (selectedRatingBadge && selectedRatingText) {
                            selectedRatingBadge.style.display = 'flex';
                            selectedRatingText.textContent = `${rating} out of 5 stars`;
                            selectedRatingBadge.classList.add('updated');

                            setTimeout(() => {
                                selectedRatingBadge.classList.remove('updated');
                            }, 500);
                        }

                        feedbackItems.forEach(item => {
                            item.style.display = 'none';
                        });

                        const feedbackItem = document.getElementById(`feedback${rating}`);
                        if (feedbackItem) {
                            feedbackItem.style.display = 'block';
                        }
                    });
                });

                starLabels.forEach(label => {
                    label.addEventListener('mouseenter', function() {
                        const starId = this.getAttribute('for').replace('ratingStar', '');
                        const rating = parseInt(starId);

                        starLabels.forEach(l => {
                            l.style.color = '#dee2e6';
                        });

                        for (let i = 5; i >= rating; i--) {
                            const starLabel = document.getElementById(`starLabel${i}`);
                            if (starLabel) {
                                starLabel.style.color = '#ffc107';
                                starLabel.style.transform = 'scale(1.1)';
                            }
                        }
                    });

                    label.addEventListener('mouseleave', function() {
                        starLabels.forEach(l => {
                            l.style.color = '#dee2e6';
                            l.style.transform = 'scale(1)';
                        });

                        const checkedInput = document.querySelector('.rating-input:checked');
                        if (checkedInput) {
                            const rating = checkedInput.value;
                            for (let i = 5; i >= rating; i--) {
                                const starLabel = document.getElementById(`starLabel${i}`);
                                if (starLabel) {
                                    starLabel.style.color = '#ffc107';
                                }
                            }
                        }
                    });
                });

                const submitBtn = document.getElementById('submitRatingBtn');
                if (submitBtn) {
                    submitBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.classList.add('clicked');
                            setTimeout(() => {
                                this.classList.remove('clicked');
                            }, 300);
                        }
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (modal.classList.contains('show')) {
                        if (e.key === 'Enter') {
                            const submitBtn = document.getElementById('submitRatingBtn');
                            if (submitBtn && !submitBtn.disabled) {
                                e.preventDefault();
                                submitBtn.click();
                            }
                        }

                        if (e.key === 'Escape') {
                            bootstrap.Modal.getInstance(modal).hide();
                        }

                        if (e.key >= '1' && e.key <= '5') {
                            const rating = parseInt(e.key);
                            const ratingInput = document.getElementById(`ratingStar${rating}`);
                            if (ratingInput) {
                                ratingInput.checked = true;
                                ratingInput.dispatchEvent(new Event('change'));
                            }
                        }

                        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                            e.preventDefault();
                            const checkedInput = document.querySelector('.rating-input:checked');
                            let nextRating;

                            if (checkedInput) {
                                const currentRating = parseInt(checkedInput.value);
                                if (e.key === 'ArrowLeft' && currentRating > 1) {
                                    nextRating = currentRating - 1;
                                } else if (e.key === 'ArrowRight' && currentRating < 5) {
                                    nextRating = currentRating + 1;
                                }
                            } else {
                                nextRating = e.key === 'ArrowRight' ? 1 : 5;
                            }

                            if (nextRating) {
                                const ratingInput = document.getElementById(`ratingStar${nextRating}`);
                                if (ratingInput) {
                                    ratingInput.checked = true;
                                    ratingInput.dispatchEvent(new Event('change'));
                                }
                            }
                        }
                    }
                });
            }

            document.addEventListener('livewire:navigated', function() {
                const modal = document.getElementById('order-received');
                if (modal) {
                    $('#order-received').on('hidden.bs.modal', function() {
                        Livewire.dispatch('resetInputs');
                    });
                }
            });

            Livewire.on('rating-submitted', function(data) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('order-received'));
                if (modal) {
                    setTimeout(() => {
                        modal.hide();
                    }, 1500);
                }

                const successStars = document.querySelectorAll('.star-label');
                successStars.forEach((star, index) => {
                    setTimeout(() => {
                        star.style.animation = 'ratingSuccess 0.5s ease';
                        setTimeout(() => {
                            star.style.animation = '';
                        }, 500);
                    }, index * 100);
                });
            });
        });

        document.addEventListener('livewire:initialized', function() {
            Livewire.on('open-rating-modal', function() {
                const modal = new bootstrap.Modal(document.getElementById('order-received'));
                modal.show();

                setTimeout(() => {
                    const firstStar = document.getElementById('ratingStar5');
                    if (firstStar) {
                        firstStar.focus();
                    }
                }, 300);
            });
        });
    </script>
</div>
