<main class="auth">

    <h2 class="auth__heading"><?php echo $title  ?></h2>
    <p class="auth__text">Iniciar Sesion en DevAcademy</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="post" action="/login" class="form">
        <div class="form__field">
            <label class="form__label" for="email">Correo Electrónico</label>
            <input class="form__input" type="email" placeholder="Introduce tu email" id="email" name="email">
        </div>
        <div class="form__field">
            <label class="form__label" for="password">Contraseña</label>
            <input class="form__input" type="password" placeholder="Introduce tu contraseña" id="password" name="password">
        </div>
        <input class="form__submit" value="Iniciar Sesión" type="submit">

        <div class="auth-links">
            <a href="/register" class="auth-links__link">Crear una cuenta nueva</a>
            <a href="/forget" class="auth-links__link">Olvidé mi contraseña</a>
        </div>
    </form>


</main>