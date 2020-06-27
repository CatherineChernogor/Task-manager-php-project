<?php
include 'autoload.php';

use App\Models\Event;

$event = new Event;

if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
}

if (getenv('REQUEST_METHOD') === 'POST') {

    $event->fill($_POST);

    if ($event->set()) {
        $_SESSION['successMessage'] = "Спасибо, ваши данные сохранены";
        header('HTTP/1.1');
        header('Location: /');
        exit;
    }
} else if (isset($_GET['updated_id'])) {

    $id = $_GET['updated_id'];
    $event = Event::get_by_id($id);
}
include("views/template_f.php");
