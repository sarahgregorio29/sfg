<?php
require dirname(dirname(__FILE__)).'/vendor/autoload.php';
use App\Http\Controllers\StatsController;

$stats_controller = new StatsController;
// $response = sprintf("%s\n", json_encode($stats_controller->stats()));

echo "<pre>";
print_r($stats_controller->stats());