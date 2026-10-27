<div>
    <div class="card rounded-4">
        <div class="card-header bg-primary rounded-4">
            <div class="p-2 d-flex gap-3 align-items-center">
                <i class="fas fa-globe text-xl"></i>
                <div>
                    <h3 class="card-title fw-bold mb-0">Setup Website Details</h3>
                    <p class="text-sm mb-0">Manage your website</p>
                </div>
            </div>
        </div>
        <form wire:submit="handleSubmit">
            <div class="card-body">
                <div class="d-flex">
                    <div class="col-6">
                        <x-input label="Shop icon (must an image and 2mb or less)" type="file" name="uploaded_icon"
                            wire:model="uploaded_icon" accept="image/*" />
                        <span class="placeholder-glow" wire:loading wire:target="handleSubmit,icon,uploaded_icon">
                            <span class="placeholder" style="width: 100px; height: 100px;"></span>
                        </span>
                        @if ($this->uploaded_icon)
                            <img class="img-thumbnail" style="height: 100px; width: 100px; object-fit: cover;"
                                src="{{ $this->uploaded_icon?->temporaryUrl() }}" alt="Icon image" wire:loading.remove
                                wire:target="handleSubmit,icon,uploaded_icon">
                        @endif
                        @if ($this->icon && !$this->uploaded_icon)
                            <img class="img-thumbnail" style="height: 100px; width: 100px; object-fit: cover;"
                                src="{{ Storage::url($this->icon) }}" alt="Icon image" wire:loading.remove
                                wire:target="handleSubmit,icon,uploaded_icon">
                        @endif
                    </div>
                    <div class="col-6">
                        <x-input label="Shop name" type="text" name="name" placeholder="Enter your shop name"
                            wire:model="name" />
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6">
                        <x-input label="Shop address" type="text" name="address"
                            placeholder="Enter your shop address" wire:model="address" />
                    </div>
                    <div class="col-6">
                        <x-input label="Shop email" type="email" name="email" placeholder="Enter your shop email"
                            wire:model="email" />
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6">
                        <x-input label="Shop phone" type="text" name="phone" placeholder="Enter your shop phone"
                            wire:model="phone" />
                    </div>
                    <div class="col-6">
                        <x-input label="Shop location link (google map iframe link)" type="text" name="location_link"
                            placeholder="Enter your shop location link" wire:model="location_link" />
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6">
                        <x-input label="Shop opening start" type="time" name="opening_start"
                            placeholder="Enter your shop opening start" wire:model="opening_start" />
                    </div>
                    <div class="col-6">

                        <x-input label="Shop opening end" type="time" name="opening_end"
                            placeholder="Enter your shop opening end" wire:model="opening_end" />
                    </div>
                </div>
                <div class="col-12">
                    <x-textarea label="Shop description" name="description" placeholder="Enter your shop description"
                        resize="none" wire:model="description" />
                </div>
                <div class="col-12">
                    <h5 class="fw-bold">Social Links</h5>
                    <div class="d-flex">
                        @foreach ($this->social_links as $link)
                            <div class="col-3"><x-input label="{{ $link }} (https://{{ $link }}.com)"
                                    type="url" name="links.{{ $link }}"
                                    placeholder="Enter your {{ $link }} link"
                                    wire:model="links.{{ $link }}" />
                            </div>
                        @endforeach
                    </div>
                    @error('links')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary px-4 py-2" wire:loading.attr="disabled"
                    wire:target="handleSubmit,icon,uploaded_icon">Save</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    icon: type,
                    title: title,
                    html: message,
                    showConfirmButton: true,
                    confirmButtonText: "OK"
                });
            });
        });
    </script>
</div>
