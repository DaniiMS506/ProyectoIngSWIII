<?php
//Si no existe el login del usuario no puede entrar a main
session_start();
if (!isset($_SESSION['Id_usuario'])) {
    echo '<script> 
                alert("Debe iniciar sesion y/o Registrarse");
                window.location.href = "Login.html";
            </script>';
    die();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoFarma</title>

    <!--Web Icon-->
    <link rel='shortcut icon' type='image/png' href='IMG/Icons/web-icon.png' />
    <!--CSS-->
    <link rel="stylesheet" href="CSS/Styles.css">
    <link rel="stylesheet" href="CSS/scrollBar.css">

    <!--LINKS-->
    <!--Icons-->
    <script src="https://use.fontawesome.com/1cf4292344.js"></script>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Cards Style -->
    <style>
        main h2 {
            text-align: center;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
            overflow-y: auto;
        }

        /* Estilos responsive */
        @media screen and (max-width: 814px) {
            main {
                overflow: auto;
                flex-direction: column;
                width: 250vw;
                padding: 10px;
                margin: 10px;
            }

            .card {
                margin: 40px;
            }
        }
    </style>

</head>

<body>
    <header class="header">
        <h1>TecnoFarma - Inicio <i class="fa fa-user-secret"></i> </h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="homeAdmin.php" class="active fa fa-home"> Inicio</a></li>

            <li><a href="PagesAdmin/ProductosAdmin.php" class="fa fa-dropbox"> Productos</a></li>
            <li><a href="PagesAdmin/InventarioAdmin.php" class="fa fa-archive"> Inventario</a></li>

            <li><a href="PagesAdmin/CategoriaAdmin.php" class="fa fa-list"> Categoria</a></li>
            <li><a href="PagesAdmin/ProveedorAdmin.php" class="fa fa-group"> Proveedor</a></li>

            <li><a href="PagesAdmin/PedidosAdmin.php" class="fa fa-book"> Pedidos de Clientes</a></li>
            <li><a href="PagesAdmin/Detalle_pedidoAdmin.php" class="fa fa-clipboard"> Detalle de Pedidos de Clientes</a></li>


            <li><a href="/ProyectoIngSWIII/Proyecto/PHP/logout.php" class="fa fa-sign-out"> Logout</a></li>

            <div class="animation start-home"></div>
        </ul>
    </nav>


    <main>
        <section id="product-sales" class="card">
            <h2>PRODUCTOS MÁS VENDIDOS</h2>
            <!-- Tabla venta productos -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('PHP/dbDashBoardAnalytics.php');
                    // Mostrar productos más vendidos
                    while ($row = $resultProductosVendidos->fetch_assoc()) {
                        echo "<tr><td>" . $row["nombre_producto"] . "</td><td>" . $row["unidades"] . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section id="recent-sales" class="card">
            <h2>ÚLTIMAS VENTAS</h2>
            <!-- Tabla ventas recientes -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('PHP/dbDashBoardAnalytics.php');
                    // Mostrar productos más vendidos
                    while ($row = $resultUltimasVentas->fetch_assoc()) {
                        echo "<tr><td>" . $row["nombre_producto"] . "</td><td>" . $row["fecha"] . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section id="recent-products" class="card">
            <h2>PRODUCTOS RECIENTEMENTE AÑADIDOS</h2>
            <!-- Tabla productos recientes -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Fecha Adicion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('PHP/dbDashBoardAnalytics.php');
                    // Mostrar productos más vendidos
                    while ($row = $resultProductosRecientes->fetch_assoc()) {
                        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["fecha_adicion"] . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <br></br>
    <footer>
        <!--Social-Media Icons-->
        <div class="social-media">
            <a href="#"> <i class="fa fa-facebook-square" aria-hidden="false"></i> </a>
            <a href="#"> <i class="fa fa-twitter-square" aria-hidden="false"></i> </a>
            <a href="#"> <i class="fa fa-instagram" aria-hidden="false"></i> </a>
            <a href="#"> <i class="fa fa-linkedin-square" aria-hidden="false"></i> </a>
        </div>
    </footer>

</body>

</html>