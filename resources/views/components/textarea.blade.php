@props([
    'label' => '',
    'name' => '',
    'placeholder' => '',
    'cols' => '',
    'rows' => '',
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label text-capitalize">
            {{ $label }}
        </label>
    @endif

    <textarea id="{{ $name }}" placeholder="{{ $placeholder }}" style="min-height: 150px; max-height: 300px;"
        {{ $attributes->class(["form-control", 'is-invalid' => $errors->has($name)]) }}></textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
