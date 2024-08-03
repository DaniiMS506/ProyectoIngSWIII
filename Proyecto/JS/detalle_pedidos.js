$(document).ready(function() {
    // Inicializar con la página 1
    cargarTabla(1);

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/DropDownList/TablaDetallePedido.php',
            method: 'POST',
            data: {
                pagina: pagina
            }, // Enviar número de página
            success: function(dataresponse, statustext, response) {
                document.getElementById("tablaDetalle_Pedidos").innerHTML = dataresponse;
            },
            error: function(request, errorcode, errortext) {
                swal("Alerta!", request, "warning");
                console.log(errorcode);
                console.log(errortext);
            }
        });
    }

    // Manejar eventos de cambio de página
    $(document).on("click", ".pagination-link", function() {
        var pagina = $(this).data("pagina");
        cargarTabla(pagina);
    });
});


////////////////////////////////Obtener Pedido///////////////////////////////

$(document).ready(function() {
    $.ajax({
        url: '../PHP/Consultas/obtener_pedido.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#sel_idPedido');
            select.empty();
            select.append('<option value="" selected>Seleccione un Pedido</option>');
            $.each(data, function(index, pedido) {
                select.append('<option value="' + pedido.Id_pedido + '">' + pedido.Id_pedido + '</option>');
            });
            
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los pedidos:', error);
        }
    });
});
////////////////////////////////Obtener NOMBRE del Producto///////////////////////////////

$(document).ready(function() {
    $.ajax({
        url: '../PHP/Consultas/obtener_producto.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#sel_idProducto');
            select.empty();
            select.append('<option value="" selected>Seleccione un Producto</option>');
            $.each(data, function(index, producto) {
                select.append('<option value="' + producto.Id_producto + '">' + producto.Nombre_producto + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los productos:', error);
        }
    });
});

////////Insertar nuevo detalle de pedido/////////

$(document).ready(function() {
    // Evento de click para el botón de inserción
    $('#btn_RegistrarDetalle_Pedido').on('click', function(e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var Id_pedido = $('#sel_idPedido').val();
        var Id_producto = $('#sel_idProducto').val();
        var cantidad = $('#cantidad').val();
        var tipo_envio = $('#tipo_envio').val();
        var precio_unitario = $('#precio_unitario').val();
        

        // Validaciones
        if (Id_pedido === '' || Id_producto === '' || cantidad === '' || tipo_envio === ''|| precio_unitario === '') {
            swal("Alerta!", "Por favor, complete todos los campos!", "warning");
            return;
        }

        // Realizar la solicitud AJAX para insertar datos en PHP
        $.ajax({
            type: 'POST',
            url: '../PHP/Inserts/insertDetallePedido.php',
            data: {
                Id_pedido: Id_pedido,
                Id_producto: Id_producto,
                cantidad: cantidad,
                tipo_envio: tipo_envio,
                precio_unitario: precio_unitario

            },
            success: function(response) {
                console.log(response);
                swal("Pedido Registrado!", response, "success");
                // Refrescar la página después de 2 segundos
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                swal("Error en la inserción de datos!", errortext, "error");
            }
        });
    });
});