<aside class="dashboard__sidebar">
    <nav class="dashboard__nav">
        <a href="/admin/dashboard" class="dashboard__link <?php echo current_page('/dashboard') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-home dashboard__icon"></i>
            <span class = "dashboard__nav-text">
                Inicio
            </span>
        </a>
        <a href="/admin/teachers" class="dashboard__link <?php echo current_page('/teachers') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-user-tie dashboard__icon"></i>
            <span class = "dashboard__nav-text">
                Profesores
            </span>
        </a>
        <a href="/admin/courses" class="dashboard__link <?php echo current_page('/courses') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-chalkboard-user dashboard__icon"></i>
            <span class = "dashboard__nav-text">
                Cursos
            </span>
        </a>

        <a href="/admin/registers" class="dashboard__link <?php echo current_page('/registers') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-users dashboard__icon"></i>
            <span class = "dashboard__nav-text">
                Registrados
            </span>
        </a>
    </nav>
</aside>