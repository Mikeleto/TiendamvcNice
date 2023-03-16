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
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th>Ciudad</th>
                <th>Provincia</th>
                <th>Coidgo postal</th>
                <th>Pais</th>
                </thead>
                <tbody>

                <form action="<?= ROOT ?>adminUser/show/<?= $data['data']->id ?>" method="POST">
                <tr>
                    <td class="text-center"><?= $data['data']->id ?></td>
                    <td class="text-center"><?= $data['data']->first_name ?></td>
                    <td class="text-center"><?= $data['data']->last_name_1 ?></td>
                    <td class="text-center"><?= $data['data']->last_name_2 ?></td>
                    <td class="text-center"><?= $data['data']->email ?></td>
                    <td class="text-center"><?= $data['data']->address ?></td>
                    <td class="text-center"><?= $data['data']->city ?></td>
                    <td class="text-center"><?= $data['data']->state ?></td>
                    <td class="text-center"><?= $data['data']->zipcode ?></td>
                    <td class="text-center"><?= $data['data']->country ?></td>
                </tr>
                    </form>




                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= ROOT ?>adminUser/normal" class="btn btn-success">
                        Volver atras
                    </a>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div>
<?php include_once(VIEWS . 'footer.php')?>