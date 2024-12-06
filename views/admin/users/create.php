<h2 class = "dashboard__heading"> <?php echo $title ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/users" class="dashboard__button">
        <i class = "fa-solid fa-circle-left"></i>
        Regresar
    </a>
</div>

<div class = "dashboard__form">
    <?php
    include_once __DIR__ . '/../../templates/alerts.php';
    ?>
    <form class = "form" method = "POST" enctype = "multipart/form-data" action = "/admin/users/create">
        <?php include_once __DIR__ . '/form.php' ?>
        <input type = "submit" value = "Añadir usuario" class = "form__submit form__submit--register">
    </form>
</div>

