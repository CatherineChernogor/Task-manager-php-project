<?php include 'views/partials/header.php'; ?>

<div class="container" id="orderApp">

    <h1>Мой календарь</h1>


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

                        <td><?= $item->id ?></td>
                        <td><?= $item->subject ?></td>
                        <td><?= $item->type ?></td>
                        <td><?= $item->place ?></td>
                        <td><?= $item->date_start ?></td>
                        <td><?= $item->date_end ?></td>
                        <td><?= $item->comment ?></td>
                        <td>
                            <button class="btn btn-success">edit</button>
                            <button class="btn btn-danger">delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>

</div>


<?php include 'views/partials/footer.php'; ?>