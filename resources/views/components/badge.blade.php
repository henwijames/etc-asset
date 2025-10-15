@props(['status'])

@php
    $statusClasses = [
        'available' => 'badge-primary',
        'borrowed' => 'badge-secondary',
        'damaged' => 'badge-accent',
        'lost' => 'badge-error',
        'returned' => 'badge-success',
    ];
@endphp

<div class="badge {{ $statusClasses[$status] ?? 'badge-ghost' }} text-white capitalize">
    {{ $status }}
</div>
