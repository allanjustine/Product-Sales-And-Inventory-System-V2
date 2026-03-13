@props(['value'])

@php
    $result = 0;

    if ($value >= 1000000000) {
        $result = number_format($value / 1000000000, 1) . 'B';
    } elseif ($value >= 1000000) {
        $result = number_format($value / 1000000, 1) . 'M';
    } elseif ($value >= 1000) {
        $result = number_format($value / 1000, 1) . 'k';
    } else {
        $result = $value;
    }
@endphp

<span>
    {{ $result ?: 0 }} units
</span>
