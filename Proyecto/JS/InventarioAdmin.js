/////////////////////////////////////////////////////////////////////////
/* INSERT */
/////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    cargarTabla(1);

    // Evento de click para el botón de inserción de inventario
    $('#btn_RegistrarInventario').on('click', async function (e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var selProducto = $('#selProducto').val();
        var txtCantidad = $('#txtCantidad').val();

        // Validaciones
        if (selProducto === '' || txtCantidad === '') {
            swal("Alerta!", "Por favor, complete todos los campos!", "warning");
            return;
        }

        try {
            // Realizar la inserción mediante AJAX
            await $.ajax({
                url: '../PHP/Inserts/insertInventario.php',
                method: 'POST',
                data: {
                    Id_producto: selProducto,
                    Cantidad: txtCantidad
                },
                success: async function (dataresponse, statustext, response) {
                    // Convertir la respuesta JSON a un objeto JavaScript
                    var insertedRow = JSON.parse(dataresponse);

                    // Agregar la fila a la tabla
                    $("#tablaInventario").append(`
                    <tr>
                        <td>${insertedRow.Nombre_producto}</td>
                        <td>${insertedRow.Cantidad}</td>
                    </tr>
                `);

                    // Limpiar los campos del formulario
                    $('#selProducto, #txtCantidad').val('');

                    // Mostrar mensaje de éxito
                    swal("Inventario Agregado!", "El inventario ha sido insertado correctamente.", "success");

                    // Después de la inserción, cargar nuevamente los datos de la tabla
                    await cargarTabla(1);
                },

                error: function (request, errorcode, errortext) {
                    swal("Alerta!" + request, "warning");
                    console.log(errorcode);
                    console.log(errortext);
                }
            });
        } catch (error) {
            console.error(error);
        }
    });

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaInventarioAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaInventario").innerHTML = dataresponse;
            },
            error: function (request, errorcode, errortext) {
                swal("Alerta!" + request, "warning");
                console.log(errorcode);
                console.log(errortext);
            }
        });
    }

    // Manejar eventos de cambio de página para inventario
    $(document).on("click", ".pagination-link-productos", function () {
        var pagina = $(this).data("pagina");
        cargarTabla(pagina);
    });
});



/////////////////////////////////////////////////////////////////////////
/* UPDATE */
/////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    // Función para cargar datos del inventario para editar
    window.cargarDatosParaEditar = async function (idInventario) {
        try {
            const response = await $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_datos_inventario.php',
                method: 'POST',
                data: { id_inventario: idInventario },
                dataType: 'json'
            });

            if (!response) {
                swal("Error", "No se encontraron datos para editar", "error");
                return;
            }

            $('#selProducto').val(response.Id_producto);
            $('#txtCantidad').val(response.Cantidad);
            $('#btn_Update').show().data('id', idInventario); // Mostrar botón de actualizar

            // Enviar mensaje de éxito después de cargar los datos
            swal("¡Datos Cargados!", "Los datos han sido cargados para editar.", "success");

        } catch (error) {
            console.error(error);
            swal("Error", "Error al cargar los datos para editar", "error");
        }
    };

    // Evento para cargar datos para editar
    $(document).on('click', '.editar', function (event) {
        event.preventDefault();
        var idInventario = $(this).data('id');
        cargarDatosParaEditar(idInventario);
    });

    // Evento para actualizar el inventario
    $('#btn_Update').on('click', async function (e) {
        e.preventDefault();

        const idInventario = $(this).data('id');
        const selProducto = $('#selProducto').val().trim();
        const txtCantidad = $('#txtCantidad').val().trim();

        // Validaciones
        if (!selProducto || !txtCantidad || isNaN(txtCantidad) || parseInt(txtCantidad) <= 0) {
            swal("Alerta!", "Por favor, complete todos los campos correctamente.", "warning");
            return;
        }

        try {
            const response = await $.ajax({
                url: '../PHP/Updates/updateInventario.php',
                method: 'POST',
                data: {
                    Id_inventario: idInventario,
                    Id_producto: selProducto,
                    Cantidad: txtCantidad
                },
                dataType: 'json'
            });

            if (response.success) {
                swal("Éxito!", "Inventario actualizado correctamente.", "success");

                $('#btn_Update').hide();

                $('#selProducto, #txtCantidad').val('');

                cargarTabla(1);

            } else {
                swal("Error", "No se pudo actualizar el inventario", "error");
            }
        } catch (error) {
            console.error(error);
            swal("Error", "Error al actualizar el inventario", "error");
        }
    });

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaInventarioAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaInventario").innerHTML = dataresponse;
            },
            error: function (request, errorcode, errortext) {
                swal("Alerta!" + request, "warning");
                console.log(errorcode);
                console.log(errortext);
            }
        });
    }

    // Manejar eventos de cambio de página para inventario
    $(document).on("click", ".pagination-link-productos", function () {
        var pagina = $(this).data("pagina");
        cargarTabla(pagina);
    });

});



/////////////////////////////////////////////////////////////////////////
/* DELETE */
/////////////////////////////////////////////////////////////////////////

// Manejar eliminación del inventario
$(document).on('click', '.eliminar', function (event) {
    event.preventDefault();
    var Id_inventario = $(this).closest('tr').find('td:eq(0)').text();
    eliminarInventario(Id_inventario);
});

// Función encargada de eliminar el inventario
function eliminarInventario(Id_inventario) {
    // Confirmar con SweetAlert antes de eliminar
    swal({
        title: "¿Estás seguro?",
        text: `¿Estás seguro de eliminar el producto con ID ${Id_inventario}?`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, eliminarlo",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            // Realizar la solicitud AJAX para eliminar el producto
            $.ajax({
                url: '../PHP/Delets/delete_Inventario_admin.php',
                type: 'POST',
                data: {
                    Id_inventario: Id_inventario
                },
                success: function (response) {
                    response = JSON.parse(response); // Convertir la respuesta a JSON
                    if (!response.success) {
                        swal({
                            icon: 'error',
                            title: 'Error al eliminar',
                            text: response.message,
                            showConfirmButton: true
                        });
                    } else {
                        swal("¡Eliminado!", "El producto ha sido eliminado correctamente.", "success");
                        // Se recarga la página después de 1.5 segundos
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function () {
                    swal({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar el registro.',
                        showConfirmButton: true
                    });
                }
            });
        } else {
            swal("Cancelado", `El producto con ID ${Id_inventario} no ha sido eliminado.`, "error");
        }
    });
}