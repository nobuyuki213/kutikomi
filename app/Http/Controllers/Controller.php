<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
	 * @param $items
	 * @param $perPage
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	public function custom_paginate($items, $perPage)
	{
		$pageStart = request('page', 1);
		$offSet    = ($pageStart * $perPage) - $perPage;
		// $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);
		$itemsForCurrentPage = $items->slice($offSet, $perPage);
		return new LengthAwarePaginator(
			$itemsForCurrentPage,
			count($items),
			$perPage,
			Paginator::resolveCurrentPage(),
			['path' => Paginator::resolveCurrentPath()]
		);
	}
}
