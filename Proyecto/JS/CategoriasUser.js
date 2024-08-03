// Obtener la fecha actual y Llenado dinamico de Fecha


// Asignar la fecha actual al input de fecha
//document.getElementById('txtFecha').value = formattedToday;


//////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function() {
    cargarTablaCategoria(1);

    // Evento de click para el botón de inserción de productos
    $('#btn_RegistrarCat').on('click', async function(e) {
        e.preventDefault();

        // Obtener datos del formulario de inserción
        var nombreCategoria = $('#NombreCategoria').val();
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
                success: async function(dataresponse) {
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
                    swal("Categoria Agregado!", "La categoria ha sido insertado correctamente.", "success");

                        // Después de la inserción, cargar nuevamente los datos de la tabla
                        await cargarTablaCategoria(1);
                    } else {
                        swal("Alerta!" + dataresponse, "warning");
                    }
                },
                error: function(request, errorcode, errortext) {
                    swal("Alerta!", "Error en la solicitud: " + errorcode, "warning");
                    console.log(request, errorcode, errortext);
                }
            });
        } catch (error) {
            console.error(error);
        }
    });

    // Función para cargar datos de la tabla
    function cargarTablaCategoria(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablaCategorias.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function(dataresponse, statustext, response) {
                document.getElementById("tablaCategorias").innerHTML = dataresponse;
            },
            error: function(request, errorcode, errortext) {
                swal("Alerta!", "Error en la solicitud: " + errorcode, "warning");
                console.log(request, errorcode, errortext);
            }
        });
    }

    // Manejar eventos de cambio de página para productos
    $(document).on("click", ".pagination-link-productos", function() {
        var pagina = $(this).data("pagina");
        cargarTablaCategoria(pagina);
    });
});