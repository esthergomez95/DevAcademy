<h2 class = "dashboard__heading"> <?php echo $title ?></h2>

<div class = "dashboard__form">
    <?php
    include_once __DIR__ . '/../../templates/alerts.php';
    ?>
    <form class = "form" method = "POST" enctype = "multipart/form-data" action = "/admin/teachers/delete">
        <?php include_once __DIR__ . '/form.php' ?>
        <input type = "submit" value = "Añadir profesor" class = "form__submit form__submit--register">
    </form>
</div>

