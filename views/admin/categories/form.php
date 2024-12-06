<fieldset class="form__fieldset">
    <legend class="form__legend">Detalles de la Categoría</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre de la Categoría</label>
        <input type="text" class="form__input" id="name" name="name"
               placeholder="Introduce un nombre para la categoría"
               value="<?= s($category->name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </div>
</fieldset>
