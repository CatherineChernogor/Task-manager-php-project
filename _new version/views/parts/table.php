<div>
    <div class="h3">Расписание</div>
    <div class="row">
        <div class="col-md-12">

            <nav>
                <div>
                    <div class="form-inline d-flex justify-content-end">
                        <form method="POST" action="/schedule.php">
                            <input type="date" class="form-control mr-1">
                            <button type="button" class="btn btn-success">Найти по дате</button>
                        </form>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item ">
                            <a href="?status=all" class="nav-link <?= get_cur_status() === 'all' ? 'active' : '' ?>">Все</a>
                        </li>
                        <li class="nav-item">
                            <a href="?status=failed" class="nav-link <?= get_cur_status() === 'failed' ? 'active' : '' ?>">Просроченные</a>
                        </li>
                        <li class="nav-item">
                            <a href="?status=pending" class="nav-link <?= get_cur_status() === 'pending' ? 'active' : '' ?>">Текущие</a>
                        </li>
                        <li class="nav-item">
                            <a href="?status=done" class="nav-link <?= get_cur_status() === 'done' ? 'active' : '' ?>">Выполненные</a>
                        </li>
                    </ul>

                </div>
            </nav>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Статус</th>
                        <th>Тема</th>
                        <th>Тип</th>
                        <th>Место</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                        <th>Комментарий</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event) : ?>
                        <tr>
                            <td class="align-middle">
                                <form method='POST' action="/schedule.php">
                                    <input type='hidden' name='id' value="<?= $event->id ?>">
                                    <input type='checkbox' <?= $event->is_done() ? 'checked' : '' ?> name='checked' value="<?= $event->status ?>" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td><a href="?updated_id=<?= $event->id ?>" class="nav-link"><?= $event->subject ?></a></td>
                            <td class="align-middle"><?= $event->get_texed_type() ?></td>
                            <td class="align-middle"><?= $event->place ?></td>
                            <td class="align-middle"><?= $event->date_start ?></td>
                            <td class="align-middle <?= $event->is_failed() ? 'text-danger' : '' ?>"><?= $event->date_end ?></td>
                            <td class="align-middle"><?= $event->comment ?></td>
                            <td><a href="?deleted_id=<?= $event->id ?>" class="nav-link btn btn-outline-danger">удалить</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>