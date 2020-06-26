<div class="jumbotron">
    <hr class="my-4">
    <div class="d-flex justify-content-between ">

        <?php if ($_SERVER['REQUEST_URI'] === '/schedule.php') : ?>
            <a class="nav-link d-inline text-secondary" href="/index.php">Перейти к форме</a>
        <?php else : ?>
            <a class="nav-link d-inline text-secondary" href="/schedule.php">Перейти к расписанию</a>
        <?php endif ?>

        <span class="d-inline nav-link text-secondary">14221 Chernogor Ekaterina</span>

    </div>
</div>