<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__stats">
    <div class="dashboard__stats-item">
        <h3 class="dashboard__stats-item-title">Cursos Activos</h3>
        <p class="dashboard__stats-item-value"><?php echo $coursesCount ?? 0; ?></p>
    </div>
    <div class="dashboard__stats-item">
        <h3 class="dashboard__stats-item-title">Profesores</h3>
        <p class="dashboard__stats-item-value"><?php echo $teachersCount ?? 0; ?></p>
    </div>
    <div class="dashboard__stats-item">
        <h3 class="dashboard__stats-item-title">Usuarios Registrados</h3>
        <p class="dashboard__stats-item-value"><?php echo $usersCount ?? 0; ?></p>
    </div>
    <div class="dashboard__stats-item">
        <h3 class="dashboard__stats-item-title">Categorías</h3>
        <p class="dashboard__stats-item-value"><?php echo $categoriesCount ?? 0; ?></p>
    </div>
</div>


<div class="dashboard__quick-actions">
    <h3 class="dashboard__quick-actions-title">Accesos Rápidos</h3>
    <a href="/admin/courses/create" class="dashboard__button">Crear Curso</a>
    <a href="/admin/teachers/create" class="dashboard__button">Registrar Profesor</a>
    <a href="/admin/users" class="dashboard__button">Ver Usuarios</a>
    <a href="/admin/categories/create" class="dashboard__button">Crear Categoría</a>
</div>
