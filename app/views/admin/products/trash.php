<?php include_once(VIEWS . 'header.php')?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Papelera</h1>
        </div>
        <div class="card-body">
            <table class="table text-center" width="100%">
                <thead>
                <th>Id</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Restaurar</th>
                </thead>
                <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td class="text-center"><?= $user->id ?></td>
                        <td class="text-center"><?= $user->type ?></td>
                        <td class="text-center"><?= $user->name ?></td>
                        <td class="text-center"><?= html_entity_decode($user->description) ?></td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminProduct/restore/<?= $user->id ?>"
                                class="btn btn-info"
                            >Restaurar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">

                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div>
<?php include_once(VIEWS . 'footer.php')?>