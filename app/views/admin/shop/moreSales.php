<?php include_once(VIEWS . 'header.php')?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Ventas</h1>
        </div>
        <div class="card-body">
            <table class="table text-center" width="100%">
                <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Nombre del producto</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Precio</th>
                <th>Envio</th>
                <th>Total</th>
                <th>Fecha de venta</th>
                </thead>
                <tbody>
                <form action="<?= ROOT ?>adminShop/moreSales/<?= $data['data']->id ?>" method="POST">

                    <tr>
                        <td class="text-center"><?= $data['data']->user_id ?></td>
                        <td class="text-center"><?= $data['data']->name ?></td>
                        <td class="text-center"><?= $data['data']->email ?></td>
                        <td class="text-center"><?= $data['data']->product_name ?></td>
                        <td class="text-center"><?= $data['data']->quantity ?></td>
                        <td class="text-center"><?= $data['data']->discount ?>€</td>
                        <td class="text-center"><?= $data['data']->price ?>€</td>
                        <td class="text-center"><?= $data['data']->send ?>€</td>
                        <td class="text-center"><?= $data['data']->total?></td>
                        <td class="text-center"><?= $data['data']->date ?></td>
                    </tr>

                    </form>

                </tbody>

            </table>
            <div class="col-sm-6">
                <a href="<?= ROOT ?>adminShop/sales" class="btn btn-success">
                    Volver atras
                </a>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
<?php include_once(VIEWS . 'footer.php')?>