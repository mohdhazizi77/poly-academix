<div class="{{ $col ?? '' }}">
    <button
        id="{{ $id ?? 'button-register' }}"
        type="{{ $type ?? 'button' }}"
        class="btn btn-pill btn-outline-success btn-air-success {{ $class ?? '' }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
</div>
