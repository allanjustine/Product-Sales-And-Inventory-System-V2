@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'placeholder' => '',
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ ucfirst($label) }}
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
