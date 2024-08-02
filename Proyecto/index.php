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
                    <button class="btn btn-outline-dark" type="submit">
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
            <hr>

            <?php
            require_once('Conexion/conn.php');

            $sql = "SELECT p.Id_producto, p.Nombre_producto, p.Precio, i.Imagen 
                    FROM Producto p 
                    LEFT JOIN Imagen i ON p.Id_producto = i.Id_producto";
            $result = $conn->query($sql);
            ?>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" alt="Product Image" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo htmlspecialchars($row['Nombre_producto']); ?></h5>
                                    <!-- Product price-->
                                    <span id="precio">$<?php echo number_format($row['Precio'], 2); ?></span>
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
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container footer">
            <p class="m-0 text-center text-white">InventaTech Pro &copy; E-Commerce 2024</p>
        </div>

        <div class="footer-iconTop" style="display: flex; justify-content: flex-end; margin-right: 100px; font-size: 25px;">
            <abbr title="Volver al inicio"><a href="#home"><i class="fa fa-arrow-circle-up"></i></a></abbr>
        </div>

    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Scroll Reveal/Animations-->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- JS Scripts -->
    <script src="JS/ScrollReveal.js"></script>
    <script src="JS/JsCarousel.js"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        // Btn Contactenos
        $('#Contactenos').on('click', async function(e) {
            e.preventDefault();
            //alert('OK');
            Swal.fire({
                title: "Contáctenos",
                html: '<i class="fas fa-envelope"></i> Email: TecnoFarma@gmail.com<br><i class="fas fa-phone"></i> Teléfono: 123-456-7890',
                icon: "info"
            });
        });

        // Btn Login
        $('#btn_Login').on('click', async function(e) {
            e.preventDefault();

            const {
                value: formValues
            } = await Swal.fire({
                title: "Login",
                html: '<input id="swal-input1" class="swal2-input" placeholder="Email">' +
                    '<input id="swal-input2" type="password" class="swal2-input" placeholder="Password">',
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ];
                }
            });

            if (formValues) {
                const [email, password] = formValues;

                try {
                    const response = await fetch('PHP/ValidaLoginCliente.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            email,
                            password
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        Swal.fire({
                            title: 'Login Successful!',
                            text: `Welcome ${result.data.Nombre} ${result.data.Apellido}`,
                            icon: 'success'
                        });

                        // Update the navbar with the user's name
                        $('#navbarDropdownLogin').html(`<i class="fas fa-user fa-fw"></i> ${result.data.Nombre} ${result.data.Apellido}`);

                        // Optionally, you might want to hide or disable the login and registration links
                        $('#btn_Login').hide();
                        $('#btn_Registrarse').hide();
                    } else {
                        Swal.fire({
                            title: 'Login Failed!',
                            text: result.message,
                            icon: 'error'
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        title: 'Error!',
                        text: `Request failed: ${error}`,
                        icon: 'error'
                    });
                }
            }
        });





        // Btn Registro btn_Registrarse
        $('#btn_Registrarse').on('click', async function(e) {
            e.preventDefault();
            //alert('OK');

            Swal.fire({
                title: "Login",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Look up",
                showLoaderOnConfirm: true,
                preConfirm: async (login) => {
                    try {
                        const githubUrl = `https://api.github.com/users/${login} `;
                        const response = await fetch(githubUrl);
                        if (!response.ok) {
                            return Swal.showValidationMessage(`${JSON.stringify(await response.json())}`);
                        }
                        return response.json();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
                    });
                }
            });
        });

    });
</script>