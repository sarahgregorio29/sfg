<?php
require dirname(dirname(__FILE__)).'/vendor/autoload.php';

use App\Http\Controllers\MOController;
$mo_controller = new MOController;

var_dump($mo_controller->addMO());
