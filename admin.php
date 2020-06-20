<?php

include 'bootstrap.php';

use App\Controllers\AdminOrderController;
use App\Request;

$request = new Request;

$order_controller = new AdminOrderController($request);

switch ($request->method())
{
    case 'GET':
        if ($request->get('id'))
        {
            $order_controller->show();
        }
        else
        {
            $order_controller->index();
        }
        break;

    case 'PUT':
        if ($request->get('id'))
        {
            $order_controller->update();
        }
        break;

    case 'DELETE':
        if ($request->get('id'))
        {
            $order_controller->delete();
        }
        break;
}

