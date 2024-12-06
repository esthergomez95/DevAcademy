<fieldset class="form__fieldset">
    <legend class="form__legend">Información del Usuario</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input type="text" class="form__input" id="name" name="name" placeholder="Introduce el nombre" value="<?= $user->name ?? ''; ?>">
    </div>

    <div class="form__field">
        <label for="surname" class="form__label">Apellido</label>
        <input type="text" class="form__input" id="surname" name="surname" placeholder="Introduce los apellidos" value="<?= $user->surname ?? ''; ?>">
    </div>

    <div class="form__field">
        <label for="email" class="form__label">Email</label>
        <input type="email" class="form__input" id="email" name="email" placeholder="Introduce el correo electrónico" value="<?= $user->email ?? ''; ?>">
    </div>
    <div class="form__field">
        <label class="form__label" for="password">Contraseña</label>
        <input class="form__input" type="password" placeholder="Introduce tu contraseña" id="password" name="password">
    </div>
    <div class="form__field">
        <label class="form__label" for="password2">Repite tu contraseña</label>
        <input class="form__input" type="password" placeholder="Introduce tu contraseña" id="password2" name="password2">
    </div>
    <div class="form__field">
        <label for="admin" class="form__label">Rol de Administrador</label>
        <select class="form__select" id="admin" name="admin">
            <option value="0" <?= ($user->admin == 0) ? 'selected' : ''; ?>>Usuario</option>
            <option value="1" <?= ($user->admin == 1) ? 'selected' : ''; ?>>Administrador</option>
        </select>
    </div>
</fieldset>
