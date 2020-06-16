<div class="form-group">
    <label for="subjectInput">Тема:</label>
    <input class="form-control" id="subjectInput" type="text" name='subject' value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
    <span class="alert-danger" role="alert"><?= $errors['subject'] ?? '' ?></span>
</div>

<div class="form-group">
    <label>Тип:</label>
    <select class="form-control" name="type" value="<?= $_POST['type'] ?? '' ?>">
        <?php foreach ($order->getTypes() as $typeID => $typeName) : ?>
            <option value="<?= $typeID ?>" <?= !empty($_POST['type']) && $_POST['type'] == $typeID ? ' selected' : '' ?>><?= $typeName ?></option>
        <?php endforeach ?>
    </select>
    <span class="alert-danger" role="alert"><?= $errors['type'] ?? '' ?></span>
</div>

<div class="form-group">
    <label>Место:</label>
    <input class="form-control" type="text" name='place' value="<?= htmlspecialchars($_POST['place'] ?? '') ?>">
</div>

<div class="form-group">
    <label>Дата и время начала:</label>
    <input class="form-control" type="datetime-local" name='date_start' value="<?= htmlspecialchars($_POST['date_start'] ?? '') ?>">
    <span class="alert-danger" role="alert"><?= $errors['date_start'] ?? '' ?></span>
</div>

<div class="form-group">
    <label>Дата и время конца:</label>
    <input class="form-control" type="datetime-local" name='date_end' value="<?= htmlspecialchars($_POST['date_end'] ?? '') ?>">
    <span class="alert-danger" role="alert"><?= $errors['date_end'] ?? '' ?></span>
</div>


<div class="form-group">
    <label>Комментарий:</label>
    <input class="form-control" type="text" name='comment' value="<?= htmlspecialchars($_POST['comment'] ?? '') ?>">
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Добавить</button>
    <!--
    <span class="text-info" >Добавляю...</span>
    <span class="text-danger" >{{ danger_message }}</span>
    -->

</div>