<?php

include 'bootstrap.php';

use App\Models\Order;

$order = new Order();

if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
}
if ($_POST) {

    $order->fill($_POST);

    if ($order->save()) {
        
        $_SESSION['successMessage'] = "Спасибо, ваши данные сохранены";
        header('Location: index.php');
        exit;
    } else {

        $errors = $order->get_errors();
    }
}

include 'views/show.php';
