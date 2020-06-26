<?php

include 'autoload.php';

use App\Models\Event;

$event = new Event;

if (getenv('REQUEST_METHOD') === 'POST') {

    $event = Event::get_by_id($_POST['id']);
    if (isset($_POST['checked'])) {

        $event->status = Event::STATUS_DONE;
    } else {

        $event->status = Event::STATUS_PENDING;
    }

    if ($event->set()) {
        header('HTTP/1.1');
        header('Location: ');
        exit;
    }
} else {
    header('HTTP/1.1');
    header('Location: /');
}
