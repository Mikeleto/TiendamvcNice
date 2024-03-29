<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenid@ a nuestra tienda</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/c858fc57f5.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a href="<?= ROOT ?>shop" class="navbar-brand">Tienda</a>
    <div class="collapse navbar-collapse" id="menu">
<!--        Enlaces del menú para todos-->
        <?php if($data['menu']): ?>
            <div class="d-flex justify-content-start">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="<?= ROOT ?>courses" class="nav-link <?= (isset($data['active']) && $data['active']=='courses') ? 'active' : '' ?>">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>books" class="nav-link <?= (isset($data['active']) && $data['active']=='books') ? 'active' : '' ?>">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>shop/whoami" class="nav-link <?= (isset($data['active']) && $data['active']=='whoami') ? 'active' : '' ?>">Quienes somos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>shop/contact" class="nav-link <?= (isset($data['active']) && $data['active']=='contact') ? 'active' : '' ?>">Contacto</a>
                    </li>

                    <?php


                    // Verificar si el usuario ha iniciado sesión
                    if (isset($_SESSION['user_id'])) {

                        // Conectar a la base de datos
                        $conn = mysqli_connect('localhost', 'username', 'password', 'database');

                        // Verificar si el usuario es un admin
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM admins WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            // Mostrar el elemento de navegación para el panel de administración
                            ?>
                            <li class="nav-item">
                                <a href="<?= ROOT ?>adminShop" class="nav-link <?= (isset($data['active']) && $data['active']=='contact') ? 'active' : '' ?>">Ir al panel de administracion</a>
                            </li>
                            <?php
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($conn);
                    }
                    ?>

                </ul>
            </div>
            <div class="d-flex justify-content-end">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['cartTotal']) && $_SESSION['cartTotal'] > 0): ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>cart" class="nav-link">
                            Carrito: <?= number_format($_SESSION['cartTotal'], 2) ?>&euro;
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <form action="<?= ROOT ?>search/products" class="d-flex" method="POST">
                            <input type="text" name="search" id="search" class="form-control"
                                   size="20" placeholder="¿producto?" required
                            >
                            <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                        </form>
                    </li>
                    <li class="nav-item d-flex flex-row">
                        <?php if(isset($_SESSION['user'])): ?>
                            <a href="<?= ROOT ?>shop/logout" class="nav-link text-light" style="display: inline-block">Cerrar sesión</a>
                        <?php else: ?>
                            <a href="<?= ROOT ?>login/index" class="nav-link text-light">Iniciar sesión</a>
                            <a href="<?= ROOT ?>login/registro" class="nav-link text-light">Registro</a>
                        <?php endif; ?>
                        <?php if(isset( $_SESSION['admin'])): ?>
                        <a href="<?= ROOT ?>adminUser" class="nav-link text-light" style="display: inline-block">Ir al panel de administracion</a>
                        <?php endif; ?>
                    </li>

                </ul>

            </div>


        <?php endif; ?>


        <?php if(isset($data['admin']) && $data['admin']): ?>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminUser" class="nav-link">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminProduct" class="nav-link">Productos</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminShop/payMode" class="nav-link">Metodos de pago</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminShop/sales" class="nav-link">Compras</a>
                </li>
                <li class="nav-item">

                    <form action="<?= ROOT ?>adminSearch/products" class="d-flex" method="POST">
                        <?php if(isset($data['admin']) && $data['admin']): ?>
                        <input type="text" name="search" id="search" class="form-control"
                               size="20" placeholder="¿producto?" required
                        >
                        <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                        <?php endif; ?>
                    </form>

                </li>

                <li>
    <a href="<?= ROOT ?>shop/logout" class="nav-link text-light" style="display: inline-block">Salir</a>
</li>
            </ul>
        <?php endif; ?>
    </div>
</nav>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">
            <?php if (isset($data['errors']) && count($data['errors']) > 0) : ?>
                <div class="alert alert-danger mt-3">
                    <ul class="list-group">
                        <?php foreach($data['errors'] as $value) : ?>
                            <li class="list-group-item alert alert-danger">
                                <strong><?= $value ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
