<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>My calendar</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        .main-page {
            max-width: 1200px;
            flex-direction: column;
        }

        .input-group-prepend,
        .input-group-text {
            width: 120px;
        }

        .jumbotron,
        .jumbotron>p {
            margin: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .content {
            flex: 1 0 auto;
        }

        .footer {
            flex: 0 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="content">
            <header><?php include("header.php") ?></header>
            <main>