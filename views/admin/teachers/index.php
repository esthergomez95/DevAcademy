<h2 class = "dashboard__heading"> <?php echo $title ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/teachers/create" class="dashboard__button">
       <i class = "fa-solid fa-circle-plus"></i>
       Añadir Profesor
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($teachers)) : ?>
        <table class="table">
            <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">Nombre</th>
                <th scope="col" class="table__th">Ubicación</th>
                <th scope="col" class="table__th">Conocimientos</th>
                <th scope="col" class="table__th"></th>
            </tr>
            </thead>

            <tbody class="table__tbody">
            <?php foreach ($teachers as $teacher) : ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?= s($teacher->name . " " . $teacher->surname, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td">
                        <?= s($teacher->city . ", " . $teacher->country, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td">
                        <?= s($teacher->tags, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="table__td--actions">
                        <a class="table__action table__action--edit" href="/admin/teachers/edit?id=<?= s($teacher->id, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/teachers/delete" class="table__form">
                            <input type="hidden" name="id" value="<?= s($teacher->id, ENT_QUOTES, 'UTF-8') ?>">
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
        <p class="text-center">No hay profesores todavía</p>
    <?php endif; ?>
</div>
