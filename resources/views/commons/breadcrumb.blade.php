@if (count($breadcrumbs))
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active" style="font-weight:bold;"><span class="badge badge-pill badge-dark">{{ $breadcrumb->title }}</span></li>
        @endif
    @endforeach
@endif