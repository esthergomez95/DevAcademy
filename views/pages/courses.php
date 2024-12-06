<main class="courses">
    <h2 class="courses__heading">Explora nuestros cursos</h2>
    <p class="courses__description">Nuestros cursos impartidos por nuestros expertos en desarrollo web</p>

    <form method="GET" action="">
        <div class="course-filter">
            <!-- Filtro por categoría -->
            <select id="category-filter" name="category_id" onchange="this.form.submit()">
                <option value="">Selecciona una categoría</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>" <?php if(isset($category_id) && $category_id == $category->id) echo 'selected'; ?>>
                        <?php echo $category->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Filtro por nivel -->
            <select id="level-filter" name="level_id" onchange="this.form.submit()">
                <option value="">Selecciona un nivel</option>
                <?php foreach($levels as $level): ?>
                    <option value="<?php echo $level->id; ?>" <?php if(isset($level_id) && $level_id == $level->id) echo 'selected'; ?>>
                        <?php echo $level->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Filtro por profesor -->
            <select id="teacher-filter" name="teacher_id" onchange="this.form.submit()">
                <option value="">Selecciona un profesor</option>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?php echo $teacher->id; ?>" <?php if(isset($teacher_id) && $teacher_id == $teacher->id) echo 'selected'; ?>>
                        <?php echo $teacher->name . ' ' . $teacher->surname; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <div class="courses__list slider swiper">
        <div class="swiper-wrapper">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="swiper-slide course-card">
                        <div class="course-card__info">
                            <h4 class="course-card__title"><?= s($course->name); ?></h4>
                            <p class="course-card__description"><?= s($course->description); ?></p>
                            <p class="course-card__price"><?= s($course->price); ?> €</p>
                            <p class="course-card__teacher"><?= s($course->teacher->name . ' ' . $course->teacher->surname); ?></p>
                            <a href="/preview?id=<?= s($course->id); ?>" class="course-card__preview-button">Previsualizar</a>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay cursos disponibles en esta categoría.</p>
            <?php endif; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</main>
