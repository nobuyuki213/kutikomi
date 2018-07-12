@php
use Carbon\Carbon;

	$now = Carbon::now();
	$c_at = Carbon::parse($date);
	$diff_sec = $now->diffInSeconds($c_at);
	if ($diff_sec < 60) {
		print $c_at->diffInSeconds($now).'秒前';
	}
	elseif ($diff_sec < 3600) {
		print $c_at->diffInMinutes($now).'分前';
	}
	elseif ($diff_sec < 86400) {
		print $c_at->diffInHours($now).'時間前';
	}
	elseif ($diff_sec < 604800) {
		print $c_at->diffInDays($now).'日前';
	}
	elseif ($diff_sec < 2764800) {
		print $c_at->diffInWeeks($now).'週前';
	}
	else {
		if ($now->year == $c_at->year) {
			print $c_at->format('Y年n月j日');
		}
		else {
			print $c_at->format('n月j日');
		}
	}
@endphp