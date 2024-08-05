<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Pedidos de Clientes</title>

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
    <!-- Incluye SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Incluye SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header class="header">
        <h1>TecnoFarma - Detalle de Pedidos de Clientes <i class="fa fa-user-secret"></i></h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../homeAdmin.php" class="fa fa-home"> Inicio</a></li>
            <li><a href="ProductosAdmin.php" class="fa fa-dropbox"> Productos</a></li>
            <li><a href="InventarioAdmin.php" class="fa fa-archive"> Inventario</a></li>

            <li><a href="PedidosAdmin.php" class="fa fa-book"> Pedidos de Clientes</a></li>
            <li><a href="Detalle_pedidoAdmin.php" class="active fa fa-clipboard"> Detalle de Pedidos de Clientes</a></li>

            <li><a href="../PHP/logout.php" class="fa fa-sign-out"> Logout</a></li>

            <div class="animation start-home"></div>
        </ul>
    </nav>

    <!-- Formulario de detalle -->
    <main class="main">
        <!-- Registrar detalle -->
        <div class="container">
            <div class="container_registro">
                <!--Registro detalle-->
                <form action="" class="form-control formulario_registro" id="form-control">
                    <div class="accordion" id="accordionExample">

                        <!--Accordion 1 Registrar detall-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="accordionBTN">
                                    Detalle de Pedidos de clientes
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h2>Pedidos</h2>

                                    <label for="sel_idPedido">Seleccione un Pedido:</label>
                                    <select class="form-select" name="" id="sel_idPedido" style="margin-bottom: 10px;">
                                        <option value="" selected>Seleccione un Pedido</option>
                                    </select>

                                    <label for="sel_idProducto">Seleccione un Producto:</label>
                                    <select class="form-select" name="" id="sel_idProducto" style="margin-bottom: 10px;">
                                        <option value="" selected>Seleccione un Producto</option>
                                    </select>

                                    <input class="form-control" type="number" name="" id="cantidad" placeholder="Cantidad" style="margin-bottom: 10px;">

                                    <select class="form-control" id="tipo_envio" name="tipo_envio" style="margin-bottom: 10px;">
                                        <option value="">Tipo de envio</option>
                                        <option value="Express">Express</option>
                                        <option value="En tienda">En tienda</option>
                                    </select>

                                    <input class="form-control" type="text" name="" id="total" placeholder="Total Final" style="margin-bottom: 10px;" readonly>

                                    <button type="submit" class="btn btn-dark" id="btn_RegistrarDetalle_Pedido" style="margin-top: 15px;">Agregar</button>
                                    <button type="submit" class="btn btn-dark" id="btn_Update" style="margin-top: 15px; display: none;">Actualizar campos</button>
                                </div>
                            </div>
                        </div>
                    </div><!--Accordion End-->
                </form>
            </div>
        </div>
    </main>
    <h2 id="tituloProd">Tabla de Detalles de Pedidos</h2>

    <div class="div-tabla">
        <table class="table table-dark" id="tabla">
            <thead>
                <tr class="table-active">
                    <th>ID del Detalle</th>
                    <th>ID del Pedido</th>
                    <th>ID del Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo de envio</th>
                    <th>Total Final</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tablaDetalle_Pedidos">
            </tbody>
        </table>
    </div>
</body>
<!-- JS -->
<script src="../JS/detalle_pedidoAdmin.js"></script>

</html>