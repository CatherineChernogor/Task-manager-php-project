<div>
    <?php if ($event->is_new()) : ?>
        <div class="h3">Создать задачу</div>
    <?php else : ?>
        <div class="h3">Отредактировать задачу</div>
    <?php endif ?>

    <form method="POST" action="/index.php">

        <?php if (!$event->is_new()) : ?>
            <input type="hidden" name="id" value="<?= $event->id ?>">
        <?php endif ?>

        <?php if (!$event->is_new()) : ?>
            <input type="hidden" name="status" value="<?= $event->status ?>">
        <?php endif ?>


        <div class="form-group">
            <span class="text-danger text-sm-left"><?= $event->get_error('subject') ?></span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Тема</span>
                </div>
                <input class="form-control" type="text" name="subject" value="<?= htmlspecialchars($event->subject) ?>">
            </div>
        </div>


        <div class="form-group">
            <span class="text-danger text-sm-left"><?= $event->get_error('type') ?></span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Тип</label>
                </div>
                <select class="custom-select" name="type">
                    <?php foreach ($event->list_types() as $type => $typeName) : ?>
                        <option value="<?= $type ?>" <?= $event->type === $type ? 'selected' : '' ?>><?= htmlspecialchars($typeName) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>


        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Место</span>
            </div>
            <input class="form-control" type="text" name="place" value="<?= htmlspecialchars($event->place) ?>">
        </div>


        <div class="form-group">
            <span class="text-danger text-sm-left"><?= $event->get_error('date_start') ?></span>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Дата начала</span>
                </div>
                <input class="form-control" type="datetime-local" name="date_start" value="<?= formatLocalTime($event->date_start) ?>">
            </div>
        </div>


        <div class="form-group">
            <span class="text-danger text-sm-left"><?= $event->get_error('date_end') ?></span>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Дата конца</span>
                </div>
                <input class="form-control" type="datetime-local" name="date_end" value="<?= formatLocalTime($event->date_end) ?>">

            </div>
        </div>


        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Комментарий</span>
            </div>
            <input class="form-control" type="text" name="comment" value="<?= htmlspecialchars($event->comment) ?>">
        </div>


        <div class="form-group mb-3 d-flex justify-content-end">
            <?php if ($event->is_new()) : ?>
                <button class="btn btn-primary" type="submit">Отправить</button>
            <?php else : ?>
                <button class="btn btn-primary" type="submit">Изменить</button>
                <a href="/schedule.php" class="btn btn-outline-primary ml-2">Отмена</a>
            <?php endif ?>
        </div>

    </form>

</div>