<?php include_once(VIEWS . 'header.php')?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Usuarios</h1>
        </div>
        <div class="card-body">
            <table class="table text-center" width="100%">
                <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Editar</th>
                <th>Borrar</th>
                <th>Ver detalles</th>
                </thead>
                <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td class="text-center"><?= $user->id ?></td>
                        <td class="text-center"><?= $user->first_name ?></td>
                        <td class="text-center"><?= $user->email ?></td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminUser/editNormal/<?= $user->id ?>"
                                class="btn btn-info"
                            >Editar</a>
                        </td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminUser/deleteNormal/<?= $user->id ?>"
                               class="btn btn-danger"
                            >Borrar</a>
                        </td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminUser/show/<?= $user->id ?>"
                               class="btn btn-danger"
                            >Ver detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= ROOT ?>adminUser/create" class="btn btn-success">
                        Crear Usuario
                    </a>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div>
<?php include_once(VIEWS . 'footer.php')?>