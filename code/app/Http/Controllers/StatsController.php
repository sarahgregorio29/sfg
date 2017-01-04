<?php

namespace App\Http\Controllers;
use App\Http\MO;

class StatsController
{
	function stats()
	{
		$mo = new MO;
		$response['last_15_min_mo_count'] = $mo->last_15_min();
		$response['time_span_last_10k'] = $mo->last_10k();
		return $response;
	}
}