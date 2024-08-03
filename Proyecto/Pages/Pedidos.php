<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos de clientes</title>

    <!--Web Icon-->
    <link rel='shortcut icon' type='image/png' href='../IMG/web-icon.png' />
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
    
</head>

<body>
    <header class="header">
        <h1>ING SW II - Pedidos de clientes</h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../home.php" class="fa fa-home"> Inicio</a></li>
            <li><a href="Productos.php" class="fa fa-dropbox"> Productos</a></li>
            <li><a href="Ventas.php" class="fa fa-usd"> Ventas</a></li>
            <li><a href="ReporteVentas.php" class="fa fa-bar-chart"> Reporte de ventas</a></li>
            <li><a href="Categorias.php" class="fa fa-list"> Categoria</a></li>
            <li><a href="Pedidos.php" class="active fa fa-book"> Pedidos de Clientes</a></li>
            <li><a href="Detalle_pedido.php" class="fa fa-clipboard"> Detalle de Pedidos de Clientes</a></li>
            <li><a href="../PHP/logout.php" class="fa fa-sign-out"> Logout</a></li>

            <div class="animation start-home"></div>
        </ul>
    </nav>

    <!-- Formulario pedidos -->
    <main class="main">
        <!-- Registrar pedido -->
        <div class="container">
            <div class="container_registro">
                <!--Registro Producto-->
                <form action="" class="form-control formulario_registro" id="form-control">
                    <div class="accordion" id="accordionExample">

                        <!--Accordion 1 Registrar Productp-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="accordionBTN">
                                    Pedidos de clientes
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h2>Pedidos</h2>
                            
                                    <label for="sel_idCliente">Seleccione un Usuario:</label>
                                        <select class="form-select" name="" id="sel_idCliente" style="margin-bottom: 10px;">
                                            <option value="" selected>Seleccione un Usuario</option>
                                    </select>
                                    
                                    <input class="form-control" type="datetime-local" name="" id="FechaPedido" placeholder="Fecha del pedido" style="margin-bottom: 10px;">
                                        <select class="form-control" id="estado_pedido" name="estado_pedido" style="margin-bottom: 10px;">
                                            <option value="">Estado del pedido</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="procesado">Procesado</option>
                                            <option value="entregado">Entregado</option>
                                            <option value="cancelado">Cancelado</option>
                                            <option value="enviado">Enviado</option>
                                        </select>
                                    <input class="form-control" type="int" name="" id="total_pedido" placeholder="Total del pedido" style="margin-bottom: 10px;">
                                
                                    <button type="submit" class="btn btn-dark" id="btn_RegistrarPedido" style="margin-top: 15px;">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div><!--Accordion End-->
                </form>
            </div>
        </div>
    </main>
    <h2 id="tituloProd">Tabla de Pedidos</h2>

    <div class="div-tabla">
        <table class="table table-dark" id="tabla">
            <thead>
                <tr class="table-active">
                    <th>ID del Pedido</th>
                    <th>ID del cliente</th>
                    <th>Fecha del pedido</th>
                    <th>Estado del pedido</th>
                    <th>Total Final</th>
                </tr>
            </thead>

            <tbody id="tablaPedidos">
            </tbody>
        </table>
    </div>
</body>
<!-- JS -->
<script src="../JS/pedidos.js"></script>
</html>