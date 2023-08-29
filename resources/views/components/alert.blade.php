<div @class(['alert', 'alert-'.$type, 'alert-dismissible fade show' => $dismissible, 'd-flex align-items-center' => $icon]) role="alert">
    @if($heading)
    <h4 class="alert-heading">{{ $heading }}</h4>
    @endif
    @if($icon)
    <i class="bi bi-{{ $icon }} fs-3 me-2"></i>
    @endif
    {{ $slot }}
    @if($dismissible)
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>