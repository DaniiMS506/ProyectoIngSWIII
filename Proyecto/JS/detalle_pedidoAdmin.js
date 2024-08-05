$(document).ready(function () {
    // Inicializar con la página 1
    cargarTabla(1);

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaDetallePedidoAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            }, // Enviar número de página
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaDetalle_Pedidos").innerHTML = dataresponse;
            },
            error: function (request, errorcode, errortext) {
                swal("Alerta!", request, "warning");
                console.log(errorcode);
                console.log(errortext);
            }
        });
    }

    // Manejar eventos de cambio de página
    $(document).on("click", ".pagination-link-pedidos", function () {
        var pagina = $(this).data("pagina");
        cargarTabla(pagina);
    });
});


////////////////////////////////Obtener Pedido///////////////////////////////

$(document).ready(function () {
    $.ajax({
        url: '../PHP/DropDownList/obtener_pedido.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#sel_idPedido');
            select.empty();
            select.append('<option value="" selected>Seleccione un Pedido</option>');
            $.each(data, function (index, pedido) {
                select.append('<option value="' + pedido.Id_pedido + '">' + pedido.Id_pedido + '</option>');
            });

        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los pedidos:', error);
        }
    });
});
////////////////////////////////Obtener NOMBRE del Producto///////////////////////////////

$(document).ready(function () {
    $.ajax({
        url: '../PHP/DropDownList/obtener_producto.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#sel_idProducto');
            select.empty();
            select.append('<option value="" selected>Seleccione un Producto</option>');
            $.each(data, function (index, producto) {
                select.append('<option value="' + producto.Id_producto + '">' + producto.Nombre_producto + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los productos:', error);
        }
    });


    $('#sel_idProducto').change(function () {
        var precio = parseFloat($('#sel_idProducto option:selected').data('precio')) || 0;
        $('#total').val(precio.toFixed(2));
    });

    $('#cantidad').on('input', function () {
        var precio = parseFloat($('#sel_idProducto option:selected').data('precio')) || 0;
        var cantidad = parseInt($('#cantidad').val()) || 0;
        var total = precio * cantidad;

        $('#total').val(total.toFixed(2));
    });
});

////////Insertar nuevo detalle de pedido/////////

$(document).ready(function () {
    // Evento de click para el botón de inserción
    $('#btn_RegistrarDetalle_Pedido').on('click', function (e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var Id_pedido = $('#sel_idPedido').val();
        var Id_producto = $('#sel_idProducto').val();
        var cantidad = $('#cantidad').val();
        var tipo_envio = $('#tipo_envio').val();
        var total = $('#total').val();

        // Validaciones
        if (Id_pedido === '' || Id_producto === '' || cantidad === '' || tipo_envio === '' || total === '') {
            Swal.fire({
                title: 'Alerta!',
                text: 'Por favor, complete todos los campos!',
                icon: 'warning'
            });
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
                total: total
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    title: 'Pedido Registrado!',
                    text: response,
                    icon: 'success'
                });
                // Refrescar la página después de 2 segundos
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    title: 'Error en la inserción de datos!',
                    text: 'Ocurrió un error al registrar el detalle del pedido. Intente nuevamente.',
                    icon: 'error'
                });
            }
        });
    });
});



////////////DELETE///////////////
//Manejar eliminacion del producto
$(document).on('click', '.eliminar', function (event) {
    event.preventDefault();
    var Id_detalle = $(this).closest('tr').find('td:eq(0)').text();
    eliminarDetallePedido(Id_detalle);
});

function eliminarDetallePedido(Id_detalle) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Estás seguro de eliminar el Detalle del Pedido con ID ${Id_detalle}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../PHP/Delets/delete_detalle_pedidosAdmin_admin.php',
                type: 'POST',
                data: {
                    Id_detalle: Id_detalle
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: 'El detalle del pedido ha sido eliminado correctamente.',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    // Recargar la página después de 1 segundo
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar el detalle del pedido.'
                    });
                }
            });
        }
    });
}


///////////////////UPDATE///////////////////////////////

// Se declara la variable editando en false, para que no se active el modo de edición
var editando = false;

// Se ejecuta cuando se le da click al botón de editar, y se ejecuta la función
$(document).on('click', '.editar', function (event) {
    event.preventDefault();
    var Id_detalle = $(this).closest('tr').find('.Id_detalle').val();
    cargarDatosParaEditar(Id_detalle);
});

// Función encargada de traer los datos para poder editarlos
function cargarDatosParaEditar(Id_detalle) {
    Swal.fire({
        title: '¿Desea Editar?',
        text: `¿Estás seguro de Editar el Detalle del Pedido con ID ${Id_detalle}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sí, Editar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_detallepedido_actualizar.php',
                type: 'GET',
                data: {
                    Id_detalle: Id_detalle
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $("#Id_detalle").val(Id_detalle);
                        $("#sel_idPedido").val(data.sel_idPedido);
                        $("#sel_idProducto").val(data.sel_idProducto);
                        $("#cantidad").val(data.cantidad);
                        $("#tipo_envio").val(data.tipo_envio);
                        $("#total").val(data.total);
                        $("#btn_Update").show(); // Se muestra el botón de editar después de cargar los datos

                        // La variable editando pasa a true, ya que el evento actualizar se está ejecutando
                        editando = true;
                        asignarEventoActualizar(Id_detalle); // Se asigna el evento click después de mostrar el botón

                        // Enviar mensaje de éxito después de cargar los datos
                        Swal.fire("¡Datos Cargados!", "Los datos han sido cargados para editar.", "success");
                    }
                },
                error: function () {
                    Swal.fire("Error", "Error al cargar los datos para editar", "error");
                }
            });
        } else {
            Swal.fire("Cancelado", `La edición del detalle del pedido ${Id_detalle} ha sido cancelada.`, "error");
        }
    });
}

// Función encargada de ejecutar el evento actualizar
function asignarEventoActualizar(Id_detalle) {
    $("#btn_Update").off('click').on('click', function (event) {
        event.preventDefault();
        if (editando) {
            var sel_idPedido = $('#sel_idPedido').val();
            var sel_idProducto = $('#sel_idProducto').val();
            var cantidad = $('#cantidad').val();
            var tipo_envio = $('#tipo_envio').val();
            var total = $('#total').val();

            $.ajax({
                type: "POST",
                url: '../PHP/Updates/updateDetallePedidosAdmin.php',
                data: {
                    Id_detalle: Id_detalle,
                    sel_idPedido: sel_idPedido,
                    sel_idProducto: sel_idProducto,
                    cantidad: cantidad,
                    tipo_envio: tipo_envio,
                    total: total
                },
                success: function (response) {
                    Swal.fire({
                        title: '¡Datos Actualizados!',
                        text: 'Los datos han sido actualizados correctamente.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                    console.log(response);
                    $("#btn_Update").hide(); // Se oculta el botón de editar después de actualizar los datos
                },
                error: function () {
                    Swal.fire("Error", "Error al actualizar los datos, intente de nuevo", "error");
                }
            });
        } else {
            Swal.fire("Error", "No se seleccionó ningún pedido para editar", "warning");
        }
        // La variable editando pasa a false, ya que se dejó de editar
        editando = false;
    });
}