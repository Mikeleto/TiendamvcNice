<?php include_once(VIEWS . 'header.php')?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Eliminación de un usuario administrador</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminUser/deleteNormal/<?= $data['data']->id ?>" method="POST">
            <div class="form-group text-left">
                <label for="name">Usuario:</label>
                <input type="text" name="name" class="form-control"
                       placeholder="Escribe tu nombre completo" disabled
                       value="<?= $data['data']->first_name ?? '' ?>"
                >
            </div>
            <div class="form-group text-left">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" class="form-control"
                       placeholder="Escribe el correo electrónico" disabled
                       value="<?= $data['data']->email ?? '' ?>"
                >
            </div>
            <div class="form-group">
                <label for="status">Selecciona un estado</label>
                <select name="status" id="status" class="form-control" disabled>
                    <option value="">Selecciona el estado del usuario</option>
                    <?php foreach($data['status'] as $status): ?>
                        <option value="<?= $status->value ?>"<?= $status->value == $data['data']->status ? ' selected' : '' ?>><?= $status->description ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Enviar" class="btn btn-success">
                <a href="<?= ROOT ?>adminUser/deleteNormal" class="btn btn-info">Regresar</a>
                <p>Una vez borrado, la información no será recuperable</p>
            </div>
        </form>
    </div>
</div>
<?php include_once(VIEWS . 'footer.php')?>
