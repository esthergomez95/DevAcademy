<h2 class = "dashboard__heading"> <?php echo $title ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/courses/create" class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
            Añadir Curso
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($courses)) : ?>
        <table class="table">
            <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">Nombre</th>
                <th scope="col" class="table__th">Descripción</th>
                <th scope="col" class="table__th">Precio</th>
                <th scope="col" class="table__th">Profesor</th>
                <th scope="col" class="table__th"></th>
            </tr>
            </thead>

            <tbody class="table__tbody">
            <?php foreach ($courses as $course) : ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?= s($course->name, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td">
                        <?= s($course->description, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td">
                        <?= s($course->price . " €" , ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td">
                        <?= s($course->teacher->name . ' ' . $course->teacher->surname, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td--actions">
                        <a class="table__action table__action--edit" href="/admin/courses/edit?id=<?= s($course->id, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/courses/delete" class="table__form">
                            <input type="hidden" name="id" value="<?= s($course->id, ENT_QUOTES, 'UTF-8') ?>">
                            <button class="table__action table__action--delete" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">No hay cursos todavía</p>
    <?php endif; ?>
</div>


