<table class="table table-hover table-striped">
    <thead>
        <tr class="table-primary">>
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
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->subject ?></td>
            <td><?= $order->type ?></td>
            <td><?= $order->place ?></td>
            <td><?= $order->date_start ?></td>
            <td><?= $order->date_end ?></td>
            <td class="table-warning"><?= $order->comment ?></td>
            <td>
                <button  class="btn btn-success" >edit</button>
                <button  class="btn btn-danger" >delete</button>
            </td>
        </tr>
    </tbody>
</table>