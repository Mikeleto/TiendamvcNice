<?php include_once 'header.php'?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Registro</h1>
        </div>
        <div class="card-body">
            <form action="<?= ROOT ?>cart/paymentmode" method="post">
                <div class="form-group text-left">
                    <label for="first_name">Nombre:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                      required     placeholder="Escriba su nombre"
                           value="<?php isset($data['data']['firstName']) ? print $data['data']['firstName'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="last_name_1">Apellido 1:</label>
                    <input type="text" name="last_name_1" id="last_name_1" class="form-control"
                       required     placeholder="Escriba su primer apellido"
                           value="<?php isset($data['data']['lastName1']) ? print $data['data']['lastName1'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="last_name_2">Apellido 2:</label>
                    <input type="text" name="last_name_2" id="last_name_2" class="form-control"
                      required     placeholder="Escriba su segundo apellido"
                           value="<?php isset($data['data']['lastName2']) ? print $data['data']['lastName2'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control"
                        required   placeholder="Escriba su correo electrónico"
                           value="<?php isset($data['data']['email']) ? print $data['data']['email'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="address">Dirección:</label>
                    <input type="text" name="address" id="address" class="form-control"
                           required placeholder="Escriba su dirección"
                           value="<?php isset($data['data']['address']) ? print $data['data']['address'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="city">Ciudad:</label>
                    <input type="text" name="city" id="city" class="form-control"
                           required placeholder="Escriba su ciudad"
                           value="<?php isset($data['data']['city']) ? print $data['data']['city'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="state">Provincia:</label>
                    <input type="text" name="state" id="state" class="form-control"
                           required placeholder="Escriba su provincia"
                           value="<?php isset($data['data']['state']) ? print $data['data']['state'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="postcode">Código postal:</label>
                    <input type="text" name="postcode" id="postcode" class="form-control"
                           required placeholder="Escriba su código postal"
                           value="<?php isset($data['data']['postcode']) ? print $data['data']['postcode'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <label for="country">País:</label>
                    <input type="text" name="country" id="country" class="form-control"
                           required placeholder="Escriba su país"
                           value="<?php isset($data['data']['country']) ? print $data['data']['country'] : '' ?>"
                    >
                </div>
                <div class="form-group text-left">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
<?php include_once 'footer.php'?>