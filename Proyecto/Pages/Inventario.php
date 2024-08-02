<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>

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
    </style>
</head>

<body>
    <header class="header">
        <h1>TecnoFarma - Inventario</h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../home.php" class="fa fa-home"> Inicio</a></li>

            <li><a href="Productos.php" class="fa fa-dropbox"> Productos</a></li>
            <li><a href="Inventario.php" class="active fa fa-archive"> Inventario</a></li>
            <li><a href="Ventas.php" class="fa fa-usd"> Ventas</a></li>
            <li><a href="ReporteVentas.php" class="fa fa-bar-chart"> Reporte de ventas</a></li>
            <li><a href="Categorias.php" class="fa fa-list"> Categoria</a></li>

            <li><a href="../PHP/logout.php" class="fa fa-sign-out"> Logout</a></li>

            <div class="animation start-home"></div>
        </ul>
    </nav>

    <!-- Registrar Inventario -->
    <div class="container">
        <div class="container_registro">
            <!--Registro Inventario-->
            <form action="" class="form-control formulario_registro" id="form-control" method="post" enctype="multipart/form-data">
                <!-- <form action="" class="form-control formulario_registro" id="form-control"> -->

                <div class="accordion" id="accordionExample">

                    <!--Accordion 1 Registrar Inventario-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="accordionBTN">
                                Registrar Nuevo Inventario
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h2>Registrar Inventario</h2>

                                <?php
                                require_once('../PHP/DropDownList/Logica_Inventario.php');
                                ?>

                                <!-- Lista Tipos id=selProducto -->
                                <?php echo $optionsSelProducto; ?>

                                <input class="form-control" type="text" name="" id="txtCantidad" placeholder="Ingrese la Cantidad">

                                <button type="submit" class="btn btn-dark" id="btn_RegistrarInventario" style="margin-top: 15px;">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div> <!--Accordion 1 End-->
        </div>

        </form>
    </div>
    </div>

    <h2 id="tituloProd">Tabla de Inventario</h2>

    <div class="div-tabla">
        <table class="table table-dark" id="tabla">
            <thead>
                <tr class="table-active">
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>

            <tbody id="tablaInventario">
            </tbody>
        </table>
    </div>
</body>

</html>

<!-- JS -->
<script src="../JS/InventarioUser.js"></script>