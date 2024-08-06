<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Farmacia TecnoFarma</title>
    <!-- Web Icon -->
    <link id="favicon1" runat="server" rel="shortcut icon" href="IMG/Icons/1.ico" type="image/x-icon" />
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!--Icons -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link href="CSS/StylesIndex.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/CarouselStyle.css">
    <link rel="stylesheet" href="CSS/scrollBar.css">
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!--SweetAlert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        * {
            box-sizing: border-box;
        }

        .cards-container {
            /* display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start; */
            gap: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .card {
            /* flex: 1 1 235px;
            width: 235px; */
            flex: 1 1 100%;
            width: 100%;
            max-width: 240px;
            height: 380px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            object-fit: contain;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 140px;
        }

        .card-footer {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            height: 100px;
        }
    </style>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="home">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!"> <img src="IMG/Logo.png" style="width: 115px; height: 95px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Info">Informaci&oacute;n</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#Productos">Productos</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!" id="Contactenos">Cont&aacute;ctenos</a></li>
                        </ul>
                    </li>

                    <!-- Login Button -->
                    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                        <li class="nav-item dropdown">
                            <!-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user fa-fw"></i> </a> -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownLogin">
                                <i class="fas fa-user fa-fw"></i> <span id="userName"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!" id="btn_Login">Login</a></li>
                                <li><a class="dropdown-item" href="#!" id="btn_Registrarse">Registrarse</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="PHP/logoutCliente.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
                <!-- Carrito de Compras -->
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="button" id="cart-button">
                        <i class="bi-cart-fill me-1"></i>
                        Carrito
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>

                </form>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">InventaTech Pro</h1>
                <p class="lead fw-normal text-white-50 mb-0">Dise&ntilde;o y desarrollo con excelencia</p>
                <p class="lead fw-normal text-white-50 mb-0"> <span class="multiple-text2"> <!--Typed JS--> </span> </p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="Info" id="Info">
        <div class="container px-4 px-lg-5 mt-5">
            <!-- Carousel -->
            <h2 class="h2" style="text-align: center;">Informaci&oacute;n</h2>
            <hr>

            <!-- carousel -->
            <div class="carousel">
                <!-- list item -->
                <div class="list">
                    <div class="item">
                        <img src="IMG/Carousel IMG/1.jpg">
                        <div class="content">
                            <div class="author">Informaci&oacute;n</div>
                            <div class="title">TecnoFarma</div>
                            <div class="topic">Web</div>
                            <div class="des">
                                En nuestra farmacia, nos dedicamos a ofrecer una amplia variedad de productos médicos y
                                medicinas de alta calidad para satisfacer todas sus necesidades de salud y bienestar.
                                Nos enorgullece ser su destino de confianza para encontrar soluciones efectivas y
                                seguras para el cuidado personal.
                            </div>
                            <div class="buttons">
                                <button id="readmore" onclick="readmore('rm1')">Leer M&aacute;s</button>
                                <button>TecnoFarma</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/2.jpg">
                        <div class="content">
                            <div class="author">Inyecciones y Píldoras Médicas</div>
                            <div class="title">Medicamentos y</div>
                            <div class="topic">Tratamientos</div>
                            <div class="des">
                                Imagen de diversas inyecciones y píldoras, ilustrando la variedad de tratamientos
                                disponibles en la farmacia para diferentes necesidades médicas.
                            </div>
                            <div class="buttons">
                                <button id="readmore" onclick="readmore('rm2')">Leer M&aacute;s</button>
                                <button>TecnoFarma</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/3.jpg">
                        <div class="content">
                            <div class="author">Investigación Farmacéutico</div>
                            <div class="title">Investigación y</div>
                            <div class="topic">Desarrollo</div>
                            <div class="des">
                                Un farmacéutico utilizando un microscopio, destacando el rigor científico y la
                                investigación detrás de la creación y mejora de medicamentos.
                            </div>
                            <div class="buttons">
                                <button id="readmore" onclick="readmore('rm3')">Leer M&aacute;s</button>
                                <button>TecnoFarma</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/4.jpg">
                        <div class="content">
                            <div class="author">Desarrollo de Medicamentos</div>
                            <div class="title">Producción y Ensayos</div>
                            <div class="topic">Farmacéuticos</div>
                            <div class="des">
                                Persona trabajando en el desarrollo de medicamentos, mostrando el proceso cuidadoso y
                                detallado para garantizar la eficacia y seguridad de los productos farmacéuticos.
                            </div>
                            <div class="buttons">
                                <button id="readmore" onclick="readmore('rm4')">Leer M&aacute;s</button>
                                <button>TecnoFarma</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list thumnail -->
                <div class="thumbnail">
                    <div class="item">
                        <img src="IMG/Carousel IMG/1.jpg">
                        <div class="content">
                            <div class="title">
                                TecnoFarma
                            </div>
                            <div class="description">
                                Web
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/2.jpg">
                        <div class="content">
                            <div class="title">
                                TecnoFarma
                            </div>
                            <div class="description">
                                Medicamentos y Tratamientos
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/3.jpg">
                        <div class="content">
                            <div class="title">
                                TecnoFarma
                            </div>
                            <div class="description">
                                Investigación y Desarrollo
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="IMG/Carousel IMG/4.jpg">
                        <div class="content">
                            <div class="title">
                                TecnoFarma
                            </div>
                            <div class="description">
                                Producción y Ensayos
                            </div>
                        </div>
                    </div>
                </div>
                <!-- next prev -->

                <div class="arrows">
                    <button id="prev"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button id="next"> <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
                <!-- time running -->
                <div class="time"></div>
            </div>



            <!-- Cards PRODUCTOS-->
            <h2 class="h2" style="text-align: center;" id="Productos">Productos</h2>

            <!-- Buscador -->
            <input type="text" class="form-control" placeholder="Buscar Producto por Nombre, Descripcion, Precio o Categoria" id="BuscarProducto">

            <hr>

            <div class="cards-container">

                <?php
                require_once('Conexion/conn.php');

                /*$sql = "SELECT p.Id_producto, p.Nombre_producto, p.Precio, p.Descripcion, i.Imagen 
                    FROM Producto p 
                    LEFT JOIN Imagen i ON p.Id_producto = i.Id_producto";
                $result = $conn->query($sql);*/
                $sql = "SELECT p.Id_producto, p.Nombre_producto, p.Precio, p.Descripcion, i.Imagen, c.Nombre_categoria
                        FROM Producto p
                        LEFT JOIN Imagen i ON p.Id_producto = i.Id_producto
                        LEFT JOIN Categoria c ON p.Id_categoria = c.Id_categoria";
                $result = $conn->query($sql);
                ?>

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="col mb-5 product-card" data-product-name="<?php echo htmlspecialchars($row['Nombre_producto']); ?>" data-product-description="<?php echo htmlspecialchars($row['Descripcion']); ?>" data-product-price="<?php echo number_format($row['Precio'], 2); ?>" data-product-category="<?php echo htmlspecialchars($row['Nombre_categoria']); ?>">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" alt="Product Image" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo htmlspecialchars($row['Nombre_producto']); ?></h5>

                                        <!-- Product Description-->
                                        <span id="descripcion"><?php echo htmlspecialchars($row['Descripcion'], 2); ?></span>

                                        <!-- Product Category-->
                                        <p class="text-muted"><?php echo htmlspecialchars($row['Nombre_categoria']); ?></p>

                                        <!-- Product price-->
                                        <h6 id="precio">$<?php echo number_format($row['Precio'], 2); ?></h6>
                                    </div>
                                </div>

                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <button class="btn btn-outline-dark mt-auto add-to-cart" data-id="<?php echo $row['Id_producto']; ?>">Add to cart</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php $conn->close(); ?>
            </div>
            <!-- Cards END PRODUCTOS-->


        </div>
    </section>



    <!-- MODAL CARRITO DE COMPRAS -->
    <div id="cart-container" style="display: none;">

        <!-- Productos Modal Carrito Compras-->
        <h3>Productos</h3>
        <hr>
        <div id="cart-products"></div>

        <!-- Inputs Modal Carrito Compras -->
        <h3>Datos de Compra</h3>
        <hr>

        <!-- Row 1 -->
        <div class="row">
            <div class="col-md-6">
                <label for="sel_idCliente" style="float: inline-start;">Cliente:</label>
                <select class="form-select" name="" id="sel_idCliente" style="margin-bottom: 10px;">
                    <option value="" selected>Seleccione un Usuario</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="FechaPedido" style="float: inline-start;">Fecha:</label>
                <input class="form-control" type="datetime-local" name="" id="FechaPedido" placeholder="Fecha del pedido" style="margin-bottom: 10px;">
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-6">
                <label for="estado_pedido" style="float: inline-start;">Estado del Pedido:</label>
                <select class="form-control" id="estado_pedido" name="estado_pedido" style="margin-bottom: 10px;">
                    <option value="">Estado del pedido</option>
                    <option value="pendiente" selected>Pendiente</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tipo_envio" style="float: inline-start;">Tipo de Envio:</label>
                <select class="form-control" id="tipo_envio" name="tipo_envio" style="margin-bottom: 10px;">
                    <option value="">Tipo de envio</option>
                    <option value="Express" selected>Express</option>
                </select>
            </div>
        </div>

        <!-- BTN -->
        <button class="btn btn-success" id="checkout-button">Comprar</button>

    </div>
    <!-- ENDMODAL CARRITO DE COMPRAS -->


    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container footer">
            <p class="m-0 text-center text-white">InventaTech Pro &copy; E-Commerce 2024</p>
            <p class="text-center text-white"> By <span class="multiple-text1 text-white"> <!--Typed JS--></span> </p>
        </div>

        <div class="footer-iconTop" style="display: flex; justify-content: flex-end; margin-right: 100px; font-size: 25px;">
            <abbr title="Volver al inicio"><a href="#home"><i class="fa fa-arrow-circle-up"></i></a></abbr>
        </div>

    </footer>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--Scroll Reveal/Animations-->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!--Typed JS/Text Animations-->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <!-- JS Scripts -->
    <script src="JS/ScrollReveal.js"></script>
    <script src="JS/JsCarousel.js"></script>
    <script src="JS/LandingPage.js"></script>
    <script src="JS/CarritoCompras.js"></script>
</body>

</html>