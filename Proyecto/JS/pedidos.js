$(document).ready(function () {
    // Inicializar con la página 1
    cargarTabla(1);

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        console.log("Cargando tabla de la página: " + pagina);
        $.ajax({
            url: '../PHP/Consultas/TablaPedidos.php',
            method: 'POST',
            data: {
                pagina: pagina
            }, // Enviar número de página
            success: function (dataresponse, statustext, response) {
                console.log("Respuesta del servidor: ", dataresponse);
                document.getElementById("tablaPedidos").innerHTML = dataresponse;
            },
            error: function (request, errorcode, errortext) {
                swal("Alerta!", "Error: " + request.status + " " + request.statusText, "warning");
                console.log("Error: ", errorcode);
                console.log("Error text: ", errortext);
            }
        });
    }

    // Manejar eventos de cambio de página
    $(document).on("click", ".pagination-link", function () {
        var pagina = $(this).data("pagina");
        console.log("Página seleccionada: " + pagina);
        cargarTabla(pagina);
    });
});



////////////////////////////////Obtener NOMBRE del CLIENTE///////////////////////////////

$(document).ready(function () {
    $.ajax({
        url: '../PHP/DropDownList/obtener_clientes.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#sel_idCliente');
            select.empty();
            select.append('<option value="" selected>Seleccione un Usuario</option>');
            $.each(data, function (index, cliente) {
                select.append('<option value="' + cliente.Id_cliente + '">' + cliente.Nombre + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los clientes:', error);
        }
    });
});

////////Insertar nuevo pedido/////////

$(document).ready(function () {
    // Evento de click para el botón de inserción
    $('#btn_RegistrarPedido').on('click', function (e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var Id_cliente = $('#sel_idCliente').val();
        var fecha_pedido = $('#FechaPedido').val();
        var estado = $('#estado_pedido').val();
        var total_pedido = $('#total_pedido').val();


        // Validaciones
        if (Id_cliente === '' || fecha_pedido === '' || estado === '' || total_pedido === '') {
            swal("Alerta!", "Por favor, complete todos los campos!", "warning");
            return;
        }

        // Realizar la solicitud AJAX para insertar datos en PHP
        $.ajax({
            type: 'POST',
            url: '../PHP/Inserts/insertPedido.php',
            data: {
                Id_cliente: Id_cliente,
                fecha_pedido: fecha_pedido,
                estado: estado,
                total_pedido: total_pedido
            },
            success: function (response) {
                console.log(response);
                swal("Pedido Registrado!", response, "success");
            },
            error: function (error) {
                console.log(error);
                swal("Error en la inserción de datos!", errortext, "error");
            }
        });
    });
});