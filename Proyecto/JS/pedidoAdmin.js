$(document).ready(function() {
    // Inicializar con la página 1
    cargarTabla(1);

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        console.log("Cargando tabla de la página: " + pagina);
        $.ajax({
            url: '../PHP/DropDownList/TablaPedidosAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            }, // Enviar número de página
            success: function(dataresponse, statustext, response) {
                console.log("Respuesta del servidor: ", dataresponse);
                document.getElementById("tablaPedidos").innerHTML = dataresponse;
            },
            error: function(request, errorcode, errortext) {
                swal("Alerta!", "Error: " + request.status + " " + request.statusText, "warning");
                console.log("Error: ", errorcode);
                console.log("Error text: ", errortext);
            }
        });
    }

    // Manejar eventos de cambio de página
    $(document).on("click", ".pagination-link", function() {
        var pagina = $(this).data("pagina");
        console.log("Página seleccionada: " + pagina);
        cargarTabla(pagina);
    });
});



////////////////////////////////Obtener NOMBRE del CLIENTE///////////////////////////////

$(document).ready(function() {
    $.ajax({
        url: '../PHP/Consultas/obtener_clientes.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#sel_idCliente');
            select.empty();
            select.append('<option value="" selected>Seleccione un Usuario</option>');
            $.each(data, function(index, cliente) {
                select.append('<option value="' + cliente.Id_cliente + '">' + cliente.Nombre + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los clientes:', error);
        }
    });
});

////////Insertar nuevo pedido/////////

$(document).ready(function() {
    // Evento de click para el botón de inserción
    $('#btn_RegistrarPedido').on('click', function(e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var Id_cliente = $('#sel_idCliente').val();
        var fecha_pedido = $('#FechaPedido').val();
        var estado = $('#estado_pedido').val();
        var total_pedido = $('#total_pedido').val();
        

        // Validaciones
        if (Id_cliente === '' || fecha_pedido === '' || estado === '' || total_pedido === '') {
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
            url: '../PHP/Inserts/insertPedido.php',
            data: {
                Id_cliente: Id_cliente,
                fecha_pedido: fecha_pedido,
                estado: estado,
                total_pedido: total_pedido
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: 'Pedido Registrado!',
                    text: response,
                    icon: 'success'
                });
                // Recargar la página después de 1 segundo
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(error) {
                console.log(error);
                Swal.fire({
                    title: 'Error en la inserción de datos!',
                    text: 'Ocurrió un error al registrar el pedido. Intente nuevamente.',
                    icon: 'error'
                });
            }
        });
    });
});


/////////////////////DELETE//////////////////////////
 
//Manejar eliminacion del producto
$(document).on('click', '.eliminar', function(event) {
    event.preventDefault();
    var Id_pedido = $(this).closest('tr').find('td:eq(0)').text();
    eliminarPedido(Id_pedido);
});

$(document).on('click', '.eliminar', function(event) {
    event.preventDefault();
    var Id_detalle = $(this).closest('tr').find('td:eq(0)').text();
    eliminarDetallePedido(Id_detalle);
});

function eliminarPedido(Id_pedido) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Estás seguro de eliminar el Pedido con ID ${Id_pedido}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../PHP/Delets/delete_pedidos_admin.php',
                type: 'POST',
                data: {
                    Id_pedido: Id_pedido
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: 'El pedido ha sido eliminado correctamente.',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    // Recargar la página después de 1 segundo
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar el pedido.'
                    });
                }
            });
        }
    });
}


///////////////////////////UPDATE//////////////////////////


// Se declara la variable editando en false, para que no se active el modo de edición
var editando = false;

// Se ejecuta cuando se le da click al botón de editar, y se ejecuta la función
$(document).on('click', '.editar', function(event) {
    event.preventDefault();
    var Id_pedido = $(this).closest('tr').find('.Id_pedido').val();
    cargarDatosParaEditar(Id_pedido);
});

// Función encargada de traer los datos para poder editarlos
function cargarDatosParaEditar(Id_pedido) {
    Swal.fire({
        title: '¿Desea Editar?',
        text: `¿Estás seguro de Editar el Pedido con ID ${Id_pedido}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sí, Editar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_pedido_actualizar.php',
                type: 'GET',
                data: {
                    Id_pedido: Id_pedido
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data) {
                        $("#Id_pedido").val(Id_pedido);
                        $("#sel_idCliente").val(data.sel_idCliente);
                        $("#FechaPedido").val(data.FechaPedido);
                        $("#estado_pedido").val(data.estado_pedido);
                        $("#total_pedido").val(data.total_pedido);
                        $("#btn_Update").show(); // Se muestra el botón de editar después de cargar los datos
                        
                        // La variable editando pasa a true, ya que el evento actualizar se está ejecutando
                        editando = true;
                        asignarEventoActualizar(Id_pedido); // Se asigna el evento click después de mostrar el botón

                        // Enviar mensaje de éxito después de cargar los datos
                        Swal.fire("¡Datos Cargados!", "Los datos han sido cargados para editar.", "success");
                    }
                },
                error: function() {
                    Swal.fire("Error", "Error al cargar los datos para editar", "error");
                }
            });
        } else {
            Swal.fire("Cancelado", `La edición del pedido ${Id_pedido} ha sido cancelada.`, "error");
        }
    });
}

// Función encargada de ejecutar el evento actualizar
function asignarEventoActualizar(Id_pedido) {
    $("#btn_Update").off('click').on('click', function(event) { 
        event.preventDefault();
        if (editando) {
            var sel_idCliente = $('#sel_idCliente').val();
            var FechaPedido = $('#FechaPedido').val();
            var estado_pedido = $('#estado_pedido').val();
            var total_pedido = $('#total_pedido').val();

            $.ajax({
                type: "POST",
                url: '../PHP/Updates/updatePedidosAdmin.php',
                data: {
                    Id_pedido: Id_pedido,
                    sel_idCliente: sel_idCliente,
                    FechaPedido: FechaPedido,
                    estado_pedido: estado_pedido,
                    total_pedido: total_pedido
                },
                success: function(response) {
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
                error: function() {
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
