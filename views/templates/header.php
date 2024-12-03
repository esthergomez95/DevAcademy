<header class="header__container">
    <div class="head__container">
        <div class="head__title">
            <h1>De aprendiz a maestro: <br> Sé imparable</h1>
        </div>
        <nav class="head__nav">
            <?php if (!is_authenticated()): ?>
                <a href="/login">Iniciar sesión</a>
                <a href="/register">Registrarse</a>
            <?php else: ?>
                <form action="/logout" method="POST">
                    <button style="cursor:pointer" type="submit">Cerrar Sesión</button>
                </form>
                <?php if (is_admin()): ?>
                    <a href="/admin/dashboard">Panel de Administración</a>
                <?php endif; ?>
            <?php endif; ?>

        </nav>
    </div>
    <div class="nav">
        <div class="nav__container">
            <div class="nav__logo"><a href="/main"><img src="build/img/logo.png" alt="logo"></a></div>            <nav class="nav__nav">
                <a href="/about">Quienes somos</a>
                <a href="/plans">Planes</a>
                <a href="/courses">Cursos</a>
            </nav>
        </div>
    </div>
</header>


