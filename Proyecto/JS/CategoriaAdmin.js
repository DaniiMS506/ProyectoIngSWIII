/////////////////////////////////////////////////////////////////////////
/* INSERT */
/////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    cargarTabla(1);

    // Evento de click para el botón de inserción de inventario
    $('#btn_RegistrarCategoria').on('click', async function (e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var nombreCategoria = $('#nombreCategoria').val();
        var descripcion = $('#descripcion').val();

        // Validaciones
        if (nombreCategoria === '' || descripcion === '') {
            swal("Alerta!", "Por favor, complete todos los campos!", "warning");
            return;
        }

        try {
            // Realizar la inserción mediante AJAX
            await $.ajax({
                url: '../PHP/Inserts/insertCategoria.php',
                method: 'POST',
                data: {
                    Nombre_categoria: nombreCategoria,
                    Descripcion: descripcion
                },
                success: async function (dataresponse) {
                    if (dataresponse.status === 'success') {
                        var insertedRow = dataresponse.data;

                        // Agregar la fila a la tabla
                        $("#tablaCategorias").append(`
                            <tr>
                            <td>${insertedRow.nombreCategoria}</td>
                            <td>${insertedRow.descripcion}</td>
                            </tr>
                        `);

                        // Limpiar los campos del formulario
                        $('#NombreCategoria, #descripcion').val('');

                        // Mostrar mensaje de éxito
                        swal("Categoria Agregada!", "La categoria ha sido insertada correctamente.", "success");

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
            url: '../PHP/Consultas/TablasAdmin/TablaCategoriaAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaCategoria").innerHTML = dataresponse;
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
    window.cargarDatosParaEditar = async function (idCategoria) {
        try {
            const response = await $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_datos_categoria.php',
                method: 'POST',
                data: { Id_categoria: idCategoria },
                dataType: 'json'
            });

            if (!response) {
                swal("Error", "No se encontraron datos para editar", "error");
                return;
            }


            $('#nombreCategoria').val(response.Nombre_categoria);
            $('#descripcion').val(response.Descripcion);
            $('#btn_Update').show().data('id', idCategoria); // Mostrar botón de actualizar
            console.log(response.Nombre_categoria + response.Descripcion + idCategoria);

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
        var idCategoria = $(this).data('id');
        cargarDatosParaEditar(idCategoria);
    });

    // Evento para actualizar el inventario
    $('#btn_Update').on('click', async function (e) {
        e.preventDefault();

        const idCategoria = $(this).data('id');
        const nombre = $('#nombreCategoria').val().trim();
        const descripcion = $('#descripcion').val().trim();

        // Validaciones
        if (!nombre || !descripcion) {
            swal("Alerta!", "Por favor, complete todos los campos correctamente.", "warning");
            return;
        }

        try {

            const response = await $.ajax({
                url: '../PHP/Updates/updateCategoria.php',
                method: 'POST',
                data: {
                    Id_categoria: idCategoria,
                    Nombre_categoria: nombre,
                    Descripcion: descripcion
                },
                dataType: 'json'
            });

            if (response.success) {
                swal("Éxito!", "Categoria actualizada correctamente.", "success");

                $('#btn_Update').hide();

                $('#nombreCategoria, #descripcion').val('');

                cargarTabla(1);

            } else {
                swal("Error", "No se pudo actualizar la categoria", "error");
            }
        } catch (error) {
            console.error(error);
            swal("Error", "Error al actualizar la categoria", "error");
        }
    });

    // Función para cargar datos de la tabla
    function cargarTabla(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaCategoriaAdmin.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse, statustext, response) {
                document.getElementById("tablaCategoria").innerHTML = dataresponse;
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
    var Id_categoria = $(this).closest('tr').find('td:eq(0)').text();
    eliminarCategoria(Id_categoria);
});

// Función encargada de eliminar el inventario
function eliminarCategoria(Id_categoria) {
    // Confirmar con SweetAlert antes de eliminar
    swal({
        title: "¿Estás seguro?",
        text: `¿Estás seguro de eliminar la categoria con ID ${Id_categoria}?`,
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
                url: '../PHP/Delets/delete_categoria_admin.php',
                type: 'POST',
                data: {
                    Id_categoria: Id_categoria
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
                        swal("¡Eliminado!", "La categoria ha sido eliminado correctamente.", "success");
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
            swal("Cancelado", `La categoria con ID ${Id_categoria} no ha sido eliminado.`, "error");
        }
    });
}