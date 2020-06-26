<?php
include 'autoload.php';

use App\Models\Event;

$event = new Event;

if (getenv('REQUEST_METHOD') === 'POST') {

    $event->fill($_POST);

    if ($event->set()) {
        header('HTTP/1.1');
        header('Location: /');
        exit;
    }
} 

include("views/template_f.php");
