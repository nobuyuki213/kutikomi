@if (count($breadcrumbs))
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item" style="font-size:0.75rem;">
            	<a href="{{ $breadcrumb->url }}">{{ empty($breadcrumb->icon) ? '' : $breadcrumb->icon }} {{ $breadcrumb->title }}</a>
            </li>
        @else
            <li class="breadcrumb-item active" style="font-size:0.75rem;">{{ empty($breadcrumb->icon) ? '' : $breadcrumb->icon }} {{ $breadcrumb->title }}</li>
        @endif
    @endforeach
@endif
<script type="apprication/ld+json">
{
	"@context": "http://schema.org",
	"@type": "BreadcrumbList",
	"itemListElement":
	[
		@foreach ($breadcrumbs as $key => $breadcrumb)
		{
			"@type": "ListItem",
			"position": {{ $key + 1 }},
			"item":
			{
				"@id": "{{ $breadcrumb->url }}",
				"name": "{{ empty($breadcrumb->title) ? '' : $breadcrumb->title }}"
			}
		}
		@if (!$loop->last)
		,
		@endif
		@endforeach
	]
}
</script>