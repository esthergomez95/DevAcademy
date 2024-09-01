<main class="auth">

    <h2 class="auth__heading"><?php echo $title  ?></h2>
    <p class="auth__text">Regístrate en DevAcademy</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="POST" action="/register" class="form">
        <div class="form__field">
            <label class="form__label" for="name">Nombre</label>
            <input class="form__input" type="text" placeholder="Introduce tu nombre" id="name" name="name" value="<?php echo s($user->name ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="surname">Apellidos</label>
            <input class="form__input" type="text" placeholder="Introduce tu apellido" id="surname" name="surname" value="<?php echo s($user->surname ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="email">Correo Electrónico</label>
            <input class="form__input" type="email" placeholder="Introduce tu email" id="email" name="email" value="<?php echo s($user->email ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="password">Contraseña</label>
            <input class="form__input" type="password" placeholder="Introduce tu contraseña" id="password" name="password">
        </div>
        <div class="form__field">
            <label class="form__label" for="password2">Repite tu contraseña</label>
            <input class="form__input" type="password" placeholder="Introduce tu contraseña" id="password2" name="password2">
        </div>
        <input class="form__submit" value="Crear cuenta" type="submit">

        <div class="auth-links">
            <a href="/login" class="auth-links__link">Ya tengo cuenta</a>
            <a href="/forget" class="auth-links__link">Olvidé mi contraseña</a>
        </div>
    </form>
</main>