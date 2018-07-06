@for ($i = 0; $i < 5; $i++)
	@if ($i < $params)
		<i class="fas fa-star fa-lg" style="color:#ffcc00;"></i>
	@else
		<i class="fas fa-star fa-lg" style="color:lightgrey;"></i>
	@endif
@endfor