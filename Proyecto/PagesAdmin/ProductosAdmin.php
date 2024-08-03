<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Admin</title>
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
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

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
        <h1>TecnoFarma - Productos <i class="fa fa-user-secret"></i> </h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../homeAdmin.php" class="fa fa-home"> Inicio</a></li>

            <li><a href="ProductosAdmin.php" class="active fa fa-dropbox"> Productos</a></li>

            <li><a href="InventarioAdmin.php" class="fa fa-archive"> Inventario</a></li>

            <!-- <li><a href="Ventas.php" class="fa fa-usd"> Ventas</a></li>
            <li><a href="ReporteVentas.php" class="fa fa-bar-chart"> Reporte de ventas</a></li>
            <li><a href="Categorias.php" class="fa fa-list"> Categoria</a></li> -->

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
                                Registrar Nuevo Producto
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h2>Registrar Producto</h2>
                                <input class="form-control" type="text" name="" id="NombreProducto" placeholder="Nombre Producto">

                                <?php
                                require_once('../PHP/DropDownList/Logica_Productos.php');
                                ?>

                                <!-- Lista Tipos id=selTipo -->
                                <?php echo $optionsSelTipo; ?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="txtFecha">Fecha de la Compra:</label>
                                        <input class="form-control" type="date" name="" id="txtFecha" placeholder="Fecha">
                                    </div>
                                    <div class="col-md-8">
                                        <label for="txtPrecio">Precio Total:</label>
                                        <input class="form-control" type="text" name="" id="txtPrecio" placeholder="Precio Total ₡">
                                    </div>
                                </div>

                                <input class="form-control" type="text" name="" id="Descripcion" placeholder="Descripcion del Producto">

                                <label for="ImagenProd">Agregue una Imagen:</label>
                                <input type="file" class="form-control" name="ImagenProd" id="ImagenProd" accept="image/*">

                                <button type="submit" class="btn btn-dark" id="btn_RegistrarProd" style="margin-top: 15px;">Agregar</button>
                                <button type="submit" class="btn btn-dark" id="btn_Update" style="margin-top: 15px; display: none;">Actualizar campos</button>

                            </div>
                        </div>
                    </div>
                </div> <!--Accordion 1 End-->
        </div>

        </form>
    </div>
    </div>

    <h2 id="tituloProd">Tabla de Productos</h2>

    <div class="div-tabla">
        <table class="table table-dark" id="tabla">
            <thead>
                <tr class="table-active">
                    <th>Nombre Producto</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Fecha Adicion</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tablaProductos">
            </tbody>
        </table>
    </div>
</body>

</html>

<!-- JS -->
<script src="../JS/ProductosAdmin.js"></script>