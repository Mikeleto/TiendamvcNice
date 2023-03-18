<?php include_once dirname(__DIR__) . ROOT . 'header.php' ?>
<h2 class="text-center"><?= $data['subtitle'] ?></h2>
<img src="<?= ROOT ?>img/<?= $data['data']->image ?>" class="rounded float-right" alt="">
<h4>Precio:</h4>
<p><?= number_format($data['data']->price, 2) ?>€</p>
<?php if ($data['data']->type == 1): ?>
    <h4>Descripción:</h4>
    <?= html_entity_decode($data['data']->description) ?>
    <h4>A quien va dirigido:</h4>
    <p><?= $data['data']->people ?></p>
    <h4>Objetivos:</h4>
    <p><?= $data['data']->objetives ?></p>
    <h4>¿Qué es necesario conocer?</h4>
    <p><?= $data['data']->necesites ?></p>
<?php elseif ($data['data']->type == 2): ?>
    <h4>Autor:</h4>
    <p><?= $data['data']->author ?></p>
    <h4>Editorial:</h4>
    <p><?= $data['data']->publisher ?></p>
    <h4>Número de páginas:</h4>
    <p><?= $data['data']->pages ?></p>
    <h4>Resumen:</h4>
    <?= html_entity_decode($data['data']->description) ?>
<?php endif; ?>
<a href="<?= ROOT . (!empty($data['back']) ? $data['back'] : 'shop') ?>" class="btn btn-success">Volver al listado de <?= $data['listTitle'] ?></a>
<?php if (isset($_SESSION['user'])): ?>
    <a href="<?= ROOT ?>cart/addproduct/<?= $data['data']->id ?>/<?= $data['user_id'] ?>" class="btn btn-primary">
        Comprar
    </a>
<?php elseif (isset($_SESSION['admin'])): ?>
    <a href="<?= ROOT ?>cart/addproduct/<?= $data['data']->id ?>/<?= $data['user_id'] ?>" class="btn btn-primary">
        Comprar
    </a>
<?php else: ?>
    <a href="<?= ROOT ?>login/index" class="btn btn-primary">
        Comprar
    </a>
<?php endif; ?>
<div class="card-header">
    <h1 class="text-center">Productos relacionados</h1>
</div>
<div class="card-body">
    <?php foreach ($data['relation'] as $key => $value): ?>
        <?php if($key%4 == 0): ?>
            <div class="row">
        <?php endif; ?>
        <div class="card pt-2 col-sm-3">
            <img src="img/<?= $value->image ?>" class="img-responsive"
                 style="width: 100%" alt="<?= $value->name ?>">
            <a href="<?= ROOT ?>shop/show/<?= $value->id ?>">
                <p><?= $value->name ?></p>
            </a>
        </div>
        <?php if($key%4 == 3): ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>



