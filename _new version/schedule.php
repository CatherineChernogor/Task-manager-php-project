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
        header('Location: /schedule.php');
        exit;
    }
} else if (isset($_GET['updated_id'])) {

    $id = $_GET['updated_id'];
    header('HTTP/1.1');
    header('Location: /index.php/?updated_id=' . $id);
} else if (isset($_GET['deleted_id'])) {

    $id = $_GET['deleted_id'];
    $event = Event::delete_by_id($id);
    header('HTTP/1.1');
    header('Location: /schedule.php');
    exit;
}


if (isset($_GET['status'])) {

    switch ($_GET['status']) {
        case 'done':
            $events = Event::get_all_done();
            break;

        case 'failed':
            $events = Event::get_all_failed();
            break;

        case 'pending':
            $events = Event::get_all_pending();
            break;


        case 'all':
            $events = Event::get_all();
            break;
    }
} else {
    $events = Event::get_all();
}
include("views/template_s.php");
