<fieldset class="form__fieldset">
    <legend class="form__legend">Detalles del Curso</legend>

    <div class="form__field">
        <label for="name" class="form__label">Título del Curso</label>
        <input type="text" class="form__input" id="name" name="name" placeholder="Introduce un título atractivo para el curso"   value="<?php echo $courses->name; ?>">
    </div>

    <div class="form__field">
        <label for="description" class="form__label">Descripción del Curso</label>
        <textarea class="form__input" id="description" name="description" placeholder="Proporciona una descripción detallada del curso" rows="3"><?php echo $courses->description; ?></textarea>
    </div>

    <div class="form__field">
        <label for="teachers" class="form__label">Seleccionar Profesor</label>
        <select class="form__select" id="teachers" name="teacher_id">
            <option value="">Selecciona un profesor</option>
            <?php foreach($teachers as $teacher) { ?>
                <option <?php echo ($courses->teacher_id === $teacher->id) ? 'selected' : '' ?> value="<?php echo $teacher->id; ?>">
                    <?php echo $teacher->name . ' ' . $teacher->surname; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form__field">
        <label for="category" class="form__label">Categoría</label>
        <select class="form__select" id="category" name="category_id">
            <option value="">Selecciona una categoría</option>
            <?php foreach($categories as $category) { ?>
                <option <?php echo ($courses->category_id === $category->id) ? 'selected' : '' ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
            <?php } ?>
        </select>
    </div>

<fieldset class="form__fieldset">
    <legend class="form__legend">Detalles Adicionales</legend>

    <div class="form__field">
        <label for="requirements" class="form__label">Requisitos</label>
        <textarea class="form__input" id="requirements" name="requirements" placeholder="Enumera los requisitos o prerrequisitos del curso" rows="2"><?php echo $courses->requirements ?? ''; ?></textarea>
    </div>

    <div class="form__field">
        <label for="outcomes" class="form__label">Resultados de Aprendizaje</label>
        <textarea class="form__input" id="outcomes" name="outcomes" placeholder="Describe lo que los estudiantes lograrán al completar el curso" rows="2"><?php echo $courses->outcomes ?? ''; ?></textarea>
    </div>

    <div class="form__field">
        <label for="price" class="form__label">Precio del Curso</label>
        <input type="number" step="any" class="form__input" id="price" name="price" placeholder="Establece el precio del curso (en USD)" value="<?php echo $courses->price ?? ''; ?>">
    </div>
</fieldset>
