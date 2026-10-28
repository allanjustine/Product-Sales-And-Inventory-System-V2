<div>
    <footer class="bg-dark text-light py-5 position-relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
            <div class="pattern-dots pattern-dots-sm"></div>
        </div>

        <div class="container position-relative">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="company-icon bg-primary rounded-circle p-2 me-3">
                                <i class="fa-solid fa-building fa-lg"></i>
                            </div>
                            <h4 class="fw-bold mb-0">{{ $this->setting->name ?? 'AJM Company' }}</h4>
                        </div>
                        <p class="text-white mb-4">
                            {{ $this->setting->description ?? 'No description added' }}
                        </p>

                        <!-- Company Tagline -->
                        <div
                            class="company-tagline bg-primary bg-opacity-10 border-start border-primary border-4 ps-3 py-2 rounded-end">
                            <small class="text-white fw-semibold">
                                <i class="fa-solid fa-star fa-xs me-1"></i> Excellence in Every Detail
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2 d-inline-block">
                            <i class="fa-solid fa-headset me-2"></i>Contact Us
                        </h5>

                        <div class="contact-list">
                            <div class="contact-item d-flex mb-3">
                                <div
                                    class="contact-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 flex-shrink-0">
                                    <i class="fa-solid fa-location-dot text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Address</h6>
                                    <p class="mb-0 text-white small">
                                        {{ $this->setting->address ?? 'Tinangnan, Tubigon, Bohol - Purok 2' }}</p>
                                </div>
                            </div>

                            <div class="contact-item d-flex mb-3">
                                <div
                                    class="contact-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 flex-shrink-0">
                                    <i class="fa-solid fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Phone</h6>
                                    <p class="mb-0 text-white small">{{ $this->setting->phone ?? '+63 951 207 2888' }}
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item d-flex">
                                <div
                                    class="contact-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 flex-shrink-0">
                                    <i class="fa-solid fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Email</h6>
                                    <p class="mb-0 text-white small">{{ $this->setting->email ?? 'labya31@gmail.com' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-5">
                        <h5 class="fw-bold mb-4 border-bottom border-secondary pb-2 d-inline-block">
                            <i class="fa-solid fa-share-alt me-2"></i>Follow Us
                        </h5>

                        <div class="social-links d-flex justify-content-lg-start justify-content-center">
                            @forelse ($this->setting->links ?? [] as $title => $link)
                                <a wire:key="{{ $title }}" href="{{ $link }}" target="_blank"
                                    class="social-icon {{ $title }} me-3" data-bs-toggle="tooltip"
                                    title="Follow on {{ $title }}">
                                    <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                        <i class="fab fa-{{ $title }} fa-lg"></i>
                                    </div>
                                </a>
                            @empty
                                <div class="social-links d-flex justify-content-lg-start justify-content-center">
                                    <a href="https://facebook.com/1down" target="_blank"
                                        class="social-icon facebook me-3" data-bs-toggle="tooltip"
                                        title="Follow on Facebook">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                            <i class="fab fa-facebook-f fa-lg"></i>
                                        </div>
                                    </a>

                                    <a href="https://twitter.com" target="_blank" class="social-icon twitter me-3"
                                        data-bs-toggle="tooltip" title="Follow on Twitter">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </div>
                                    </a>

                                    <a href="https://instagram.com" target="_blank" class="social-icon instagram me-3"
                                        data-bs-toggle="tooltip" title="Follow on Instagram">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                            <i class="fab fa-instagram fa-lg"></i>
                                        </div>
                                    </a>

                                    <a href="https://tiktok.com" target="_blank" class="social-icon tiktok"
                                        data-bs-toggle="tooltip" title="Follow on TikTok">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                            <i class="fab fa-tiktok fa-lg"></i>
                                        </div>
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="time-card bg-dark bg-gradient border border-secondary rounded-3 p-3 text-center">
                        <div class="time-header mb-2">
                            <i class="fa-solid fa-clock me-2 text-primary"></i>
                            <small class="text-uppercase text-primary fw-semibold">Live Time</small>
                        </div>
                        <div class="time-display">
                            <div class="date-text mb-1">
                                <span id="date" class="fw-semibold"></span>
                            </div>
                            <div class="time-text">
                                <span id="time" class="h5 fw-bold text-primary"></span>
                            </div>
                            <div class="timezone small text-white mt-1">
                                <i class="fa-solid fa-globe-asia me-1"></i> Philippine Standard Time
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-4 border-top border-secondary">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <p class="mb-0">
                                &copy; {{ now()->year }} <strong class="text-primary">{{ $this->setting->name ?? 'AJM Company' }}</strong>. All
                                rights
                                reserved.
                            </p>
                        </div>

                        <div class="footer-links">
                            <a href="#" class="text-white text-decoration-none me-3 small">Privacy
                                Policy</a>
                            <a href="#" class="text-white text-decoration-none me-3 small">Terms of
                                Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
