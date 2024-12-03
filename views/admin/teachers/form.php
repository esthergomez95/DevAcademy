<fieldset class="form__fieldset">
    <legend class="form__legend">Informacion Personal</legend>
    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input type="text"  class ="form__input" id="name" name="name" placeholder="Introduce tu nombre" value="<?php echo $teachers->name; ?>">
    </div>
    <div class="form__field">
        <label for="surname" class="form__label">Apellido</label>
        <input type="text" class="form__input" id="surname" name="surname" placeholder="Introduce tu apellido" value="<?php echo $teachers->surname ?? ''; ?>">
    </div>
    <div class="form__field">
        <label for="city" class="form__label">Ciudad</label>
        <input type="text" class="form__input" id="city" name="city" placeholder="Introduce tu ciudad" value="<?php echo $teachers->city ?? ''; ?>">
    </div>

    <div class="form__field">
        <label for="country" class="form__label">Pais</label>
        <input type="text" class="form__input" id="country" name="country" placeholder="Introduce tu pais" value="<?php echo $teachers->country ?? ''; ?>">
    </div>

</fieldset>
<fieldset class="form__fieldset">
    <legend class="form__legend">Información complementaria</legend>

    <div class="form__field">
        <label for="tags_input" class="form__label">Campos de especialización (separado por comas)</label>
        <input type="text" class="form__input" id="tags_input" placeholder="Ej. PHP, Laravel, JavaScript, Python">
        <div id="tags" class="form__list"></div>
        <input type="hidden" name="tags" value="<?php echo $teachers->tags ?? ''; ?>">
    </div>
</fieldset>