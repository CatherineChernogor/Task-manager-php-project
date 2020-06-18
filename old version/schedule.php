<?php

include 'bootstrap.php';

use App\Models\Order as Order;

$data = Order::get_all();


include 'views/sched.php';