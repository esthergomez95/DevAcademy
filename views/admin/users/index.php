<h2 class="dashboard__heading"> <?php echo $title ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/users/create" class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Usuario
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($users)) : ?>
        <table class="table">
            <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">Nombre</th>
                <th scope="col" class="table__th">Apellidos</th>
                <th scope="col" class="table__th">Email</th>
                <th scope="col" class="table__th">Rol</th>
                <th scope="col" class="table__th"></th>
            </tr>
            </thead>

            <tbody class="table__tbody">
            <?php foreach ($users as $user) : ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?= s($user->name) ?>
                    </td>
                    <td class="table__td">
                        <?= s($user->surname) ?>
                    </td>
                    <td class="table__td">
                        <?= s($user->email) ?>
                    </td>
                    <td class="table__td">
                        <?= ($user->admin == 1) ? 'Administrador' : 'Usuario' ?>
                    </td>
                    <td class="table__td--actions">
                        <a class="table__action table__action--edit" href="/admin/users/edit?id=<?= s($user->id, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/users/delete" class="table__form">
                            <input type="hidden" name="id" value="<?= s($user->id) ?>">
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
        <p class="text-center">No hay usuarios registrados todavía</p>
    <?php endif; ?>
</div>
