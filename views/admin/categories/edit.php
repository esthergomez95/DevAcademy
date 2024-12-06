<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/categories" class="dashboard__button">
        <i class="fa-solid fa-circle-left"></i>
        Regresar
    </a>
</div>

<div class="dashboard__form">
    <?php include_once __DIR__ . '/../../templates/alerts.php'; ?>

    <form class="form" method="POST" action="/admin/categories/edit?id=<?= s($category->id, ENT_QUOTES, 'UTF-8'); ?>">
        <?php include_once __DIR__ . '/form.php'; ?>
        <input type="submit" value="Guardar Cambios" class="form__submit">
    </form>
</div>
