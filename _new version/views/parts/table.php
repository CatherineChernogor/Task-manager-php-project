<div>
    <div class="h3">Расписание</div>
    <div class="row">
        <div class="col-md-12">

            <nav>
                <div>
                    <div class="form-inline d-flex justify-content-end">
                        <input type="date" class="form-control mr-1">
                        <button type="button" class="btn btn-success">Найти по
                            дате</button>

                    </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item ">
                            <button type="button" class="btn btn-light">Все</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-light">Просроченные</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-light">Текущие</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-light">Выполненные</button>
                        </li>
                    </ul>

                </div>
            </nav>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
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
                                <form method='POST' action="/makedone.php">
                                    <input type='hidden' name='id' value="<?= $event->id ?>">
                                    <input type='checkbox' <?= $event->is_done() ? 'checked' : '' ?> name='checked' value="<?= $event->status ?>" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td><a href="?updated_id=<?= $event->id ?>" class="nav-link"><?= $event->subject ?></a></td>
                            <td class="align-middle"><?= $event->get_texed_type() ?></td>
                            <td class="align-middle"><?= $event->place ?></td>
                            <td class="align-middle"><?= $event->date_start ?></td>
                            <td class="align-middle"><?= $event->date_end ?></td>
                            <td class="align-middle"><?= $event->comment ?></td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm">
                                    <a href="?deleted_id=<?= $event->id ?>" class="nav-link">
                                        delete
                                    </a>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>