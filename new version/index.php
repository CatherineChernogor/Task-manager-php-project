<?php

include 'bootstrap.php';

use App\Controllers\OrderController;
use App\Request;

$request = new Request;

$order_controller = new OrderController($request);

switch ($request->method())
{
    case 'GET':
        $order_controller->show();
        break;

    case 'POST':
        $order_controller->save();
        break;
}

