<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <!--Web Icon-->
    <link rel='shortcut icon' type='image/png' href='../IMG/Icons/web-icon.png' />

    <!--CSS-->
    <link rel="stylesheet" href="../CSS/Styles.css">
    <link rel="stylesheet" href="../CSS/Styles2.css">
    <link rel="stylesheet" href="../CSS/scrollBar.css">

    <!--LINKS-->
    <!--Icons-->
    <script src="https://use.fontawesome.com/1cf4292344.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .form-select {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .form-control {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* IMG */
        .image-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 120px;
            height: 120px;
            object-fit: contain;
            overflow: hidden;
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain !important;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>TecnoFarma - Proveedores</h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../home.php" class="fa fa-home"> Inicio</a></li>

            <li><a href="Productos.php" class="fa fa-dropbox"> Productos</a></li>
            <li><a href="Inventario.php" class="fa fa-archive"> Inventario</a></li>
            <li><a href="Categorias.php" class="fa fa-list"> Categorias</a></li>
            <li><a href="proveedores.php" class="active fa fa-group"> Proveedores</a></li>
            <li><a href="Pedidos.php" class="active fa fa-book"> Pedidos de Clientes</a></li>
            <li><a href="Detalle_pedido.php" class="fa fa-clipboard"> Detalle de Pedidos de Clientes</a></li>

            <li><a href="../PHP/logout.php" class="fa fa-sign-out"> Logout</a></li>

            <div class="animation start-home"></div>
        </ul>
    </nav>

    <!-- Registrar Producto -->
    <div class="container">
        <div class="container_registro">
            <!--Registro Producto-->
            <form action="" class="form-control formulario_registro" id="form-control" method="post" enctype="multipart/form-data">
                <!-- <form action="" class="form-control formulario_registro" id="form-control"> -->

                <div class="accordion" id="accordionExample">

                    <!--Accordion 1 Registrar Producto-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="accordionBTN">
                                Registrar Nuevo Proveedor
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h2>Registrar Proveedor</h2>

                                <input class="form-control" type="text" name="" id="NombreProveedor" placeholder="Nombre Proveedor">

                                <input class="form-control" type="text" name="" id="direccion" placeholder="Direccion">

                                <input class="form-control" type="number" name="" id="telefono" placeholder="Telefono">

                                <input class="form-control" type="text" name="" id="email" placeholder="Email">

                                <button type="submit" class="btn btn-dark" id="btn_RegistrarProv" style="margin-top: 15px;">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div> <!--Accordion 1 End-->
        </div>

        </form>
    </div>
    </div>

    <h2 id="tituloProd">Tabla de Proveedores</h2>

    <div class="div-tabla">
        <table class="table table-dark" id="tabla">
            <thead>
                <tr class="table-active">
                    <th>Nombre Proveedor</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody id="tablaProveedores">
                <!-- aqui van los datos -->
            </tbody>
        </table>
    </div>
</body>

</html>

<!-- JS -->
<script src="../JS/ProveedoresUsers.js"></script>