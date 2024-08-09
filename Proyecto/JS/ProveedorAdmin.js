/////////////////////////////////////////////////////////////////////////
/* INSERT */
/////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    cargarTabla(1);

    // Evento de click para el botón de inserción de inventario
    $('#btn_RegistrarProveedor').on('click', async function (e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var nombreProveedor = $('#NombreProveedor').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();

        // Validaciones
        if (nombreProveedor === '' || direccion === ''  || telefono === ''  || email === '') {
            swal("Alerta!", "Por favor, complete todos los campos!", "warning");
            return;
        }

        try {
            // Realizar la inserción mediante AJAX
            await $.ajax({
                url: '../PHP/Inserts/insertProveedor.php',
                method: 'POST',
                data: {
                    Nombre: nombreProveedor,
                    Direccion: direccion,
                    Telefono: telefono,
                    Email: email
                },
                success: async function (dataresponse) {
                    if (dataresponse.status === 'success') {
                        var insertedRow = dataresponse.data;

                        // Agregar la fila a la tabla
                        $("#tablaProveedor").append(`
                            <tr>
                            <td>${insertedRow.nombreProveedor}</td>
                            <td>${insertedRow.direccion}</td>
                            <td>${insertedRow.telefono}</td>
                            <td>${insertedRow.email}</td>
                            </tr>
                        `);

                        // Limpiar los campos del formulario
                        $('#NombreProveedor, #direccion, #telefono, #email').val('');

                        // Mostrar mensaje de éxito
                        swal("Proveedor Agregado!", "El Proveedor ha sido insertado correctamente.", "success");

                        // Después de la inserción, cargar nuevamente los datos de la tabla
                        await cargarTabla(1);
                    } else {
                        swal("Alerta!" + dataresponse, "warning");
                    }
                },
                error: function (request, errorcode, errortext) {
                    swal("Alerta!", "Error en la solicitud: " + errorcode, "warning");
                    console.log(request, errorcode, errortext);
                }
            });
        } catch (error) {
            console.error(error);
        }
    });

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaProveedorAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaProveedor").innerHTML = dataresponse;
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
    window.cargarDatosParaEditar = async function (idProveedor) {
        try {
            const response = await $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_datos_proveedor.php',
                method: 'POST',
                data: { Id_proveedor: idProveedor },
                dataType: 'json'
            });

            if (!response) {
                swal("Error", "No se encontraron datos para editar", "error");
                return;
            }


            $('#NombreProveedor').val(response.Nombre);
            $('#direccion').val(response.Direccion);
            $('#telefono').val(response.Telefono);
            $('#email').val(response.Email);

            $('#btn_Update').show().data('id', idProveedor); // Mostrar botón de actualizar
            console.log(response.Nombre + response.Direccion + idProveedor);

            // Enviar mensaje de éxito después de cargar los datos
            swal("¡Datos Cargados!", "Los datos han sido cargados para editar.", "success");

        } catch (error) {
            console.error(error);
            swal("Error", "Error al cargar los datos para editarlos", "error");
        }
    };

    // Evento para cargar datos para editar
    $(document).on('click', '.editar', function (event) {
        event.preventDefault();
        var idProveedor = $(this).data('id');
        cargarDatosParaEditar(idProveedor);
    });


    // Evento para actualizar el inventario
    $('#btn_Update').on('click', async function (e) {
        e.preventDefault();

        const idProveedor = $(this).data('id');

        const nombre = $('#NombreProveedor').val().trim();
        const direccion = $('#direccion').val().trim();
        const telefono = $('#telefono').val().trim();
        const email = $('#email').val().trim();

        // Validaciones
        if (!nombre || !direccion || !telefono || !email) {
            swal("Alerta!", "Por favor, complete todos los campos correctamente.", "warning");
            return;
        }

        try {
            const response = await $.ajax({
                url: '../PHP/Updates/updateProveedor.php',
                method: 'POST',
                data: {
                    Id_proveedor: idProveedor,
                    Nombre: nombre,
                    Direccion: direccion,
                    Telefono: telefono,
                    Email: email
                },
                dataType: 'json'
            });

            if (response.success) {
                swal("Éxito!", "Proveedor actualizado correctamente.", "success");

                $('#btn_Update').hide();

                $('#NombreProveedor, #direccion, #telefono, #email').val('');

                cargarTabla(1);

            } else {
                swal("Error", "No se pudo actualizar el proveedor", "error");
            }
        } catch (error) {
            console.error(error);
            swal("Error", "Error al actualizar el Proveedor", "error");
        }
    });

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaProveedorAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaProveedor").innerHTML = dataresponse;
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
    var Id_proveedor = $(this).closest('tr').find('td:eq(0)').text();
    eliminarProveedor(Id_proveedor);
});

// Función encargada de eliminar el inventario
function eliminarProveedor(Id_proveedor) {
    // Confirmar con SweetAlert antes de eliminar
    swal({
        title: "¿Estás seguro?",
        text: `¿Estás seguro de eliminar el proveedor con ID ${Id_proveedor}?`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, eliminarlo",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            // Realizar la solicitud AJAX para eliminar el categoria
            $.ajax({
                url: '../PHP/Delets/delete_proveedor_admin.php',
                type: 'POST',
                data: {
                    Id_proveedor: Id_proveedor
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
                        swal("¡Eliminado!", "El proveedor ha sido eliminado correctamente.", "success");
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
            swal("Cancelado", `El proveedor con ID ${Id_proveedor} no ha sido eliminado.`, "error");
        }
    });
}