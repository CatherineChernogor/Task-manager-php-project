<?php include 'views/partials/header.php'; ?>

<div class="container" id="orderApp">

    <h1>Мой календарь</h1>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0">

                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">Action</button>
                        <button class="dropdown-item" type="button">Another action</button>
                        <button class="dropdown-item" type="button">Something else here</button>
                    </div>
                </div>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

                <div >
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Сегодня</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Завтра</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">На эту неделю</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">На следующую неделю</button>
                </div>
            </form>
        </div>
    </nav>



    <form method="POST" action="">
        <table class="table table-hover table-striped">
            <thead>
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Place</th>
                    <th>Date_start</th>
                    <th>Date_end</th>
                    <th>Comment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $item) : ?>
                    <tr>

                        <td name="id"><?= $item->id ?></td>
                        <td><?= $item->subject ?></td>
                        <td><?= $item->type ?></td>
                        <td><?= $item->place ?></td>
                        <td><?= $item->date_start ?></td>
                        <td><?= $item->date_end ?></td>
                        <td><?= $item->comment ?></td>
                        <td>
                            <button class="btn btn-success"  >edit</button>
                            <button class="btn btn-danger" onclick="deleteRowById(<?= $item->id?>, this)" >delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>

</div>
<script src="js/functions.js"></script>
<?php include 'views/partials/footer.php'; ?>