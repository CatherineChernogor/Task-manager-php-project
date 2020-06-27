<?php include("parts/main-head.php") ?>

<div class="main-page d-flex justify-content-center pl-5">

    <?php if (!empty($successMessage)) : ?>
        <div class="w-25">
            <div class="alert alert-success" role="alert"><?= $successMessage ?></div>
            <a href="/" class="btn btn-outline-success">Создать еще одну запись</a>
        </div>
    <?php else : ?>
        <?php include("parts/form.php") ?>
    <?php endif ?>

</div>
<?php include("parts/main-foot.php") ?>