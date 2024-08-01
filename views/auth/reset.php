<main class="auth">

    <h2 class="auth__heading"><?php echo $title  ?></h2>
    <p class="auth__text">Introduce tu nueva contraseña</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <?php

    if($valid_token) {
    ?>
    <form method="POST" class="form">
        <div class="form__field">
            <label class="form__label" for="password">Nueva contraseña</label>
            <input class="form__input" type="password" placeholder="Introduce tu nueva contraseña" id="password" name="password">
        </div>
        <input class="form__submit" value="Guardar contraseña" type="submit">

        <div class="auth-links">
            <a href="/login" class="auth-links__link">Iniciar Sesión</a>
            <a href="/register" class="auth-links__link">Crear cuenta nueva</a>
        </div>
    </form>

    <?php
    };
    ?>
</main>