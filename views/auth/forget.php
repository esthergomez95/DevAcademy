<main class="auth">

    <h2 class="auth__heading"><?php echo $title  ?></h2>
    <p class="auth__text">Recupera tu contraseña</p>


    <form class="form">
        <div class="form__field">
            <label class="form__label" for="email">Correo Electrónico</label>
            <input class="form__input" type="email" placeholder="Introduce tu email" id="email" name="email">
        </div>
        <input class="form__submit" value="Recuperar contraseña" type="submit">

        <div class="auth-links">
            <a href="/login" class="auth-links__link">Iniciar Sesión</a>
            <a href="/register" class="auth-links__link">Crear cuenta nueva</a>
        </div>
    </form>


</main>