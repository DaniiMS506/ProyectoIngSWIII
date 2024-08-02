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
            url: '../PHP/Consultas/TablaInventario.php',
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