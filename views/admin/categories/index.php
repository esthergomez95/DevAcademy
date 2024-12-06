<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/categories/create" class="dashboard__button dashboard__button--green">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Categoría
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($categories)) : ?>
        <table class="table">
            <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">Nombre</th>
                <th scope="col" class="table__th"></th>
            </tr>
            </thead>
            <tbody class="table__tbody">
            <?php foreach ($categories as $category) : ?>
                <tr class="table__tr">
                    <td style="width: 100%" class="table__td">
                        <?= s($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td--actions">
                        <a href="/admin/categories/edit?id=<?= s($category->id, ENT_QUOTES, 'UTF-8'); ?>" class="table__action table__action--edit">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form action="/admin/categories/delete" method="POST" class="table__form">
                            <input type="hidden" name="id" value="<?= s($category->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="table__action table__action--delete">
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
        <p class="text-center">No hay categorías registradas.</p>
    <?php endif; ?>
</div>
