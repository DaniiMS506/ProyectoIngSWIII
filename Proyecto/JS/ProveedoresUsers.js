// Obtener la fecha actual y Llenado dinamico de Fecha


// Asignar la fecha actual al input de fecha
//document.getElementById('txtFecha').value = formattedToday;


//////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function() {
    cargarTablaProveedores(1);

    // Evento de click para el botón de inserción de productos
    $('#btn_RegistrarProv').on('click', async function(e) {
        e.preventDefault();
        
        // Obtener datos del formulario de inserción
        var nombreProveedor = $('#NombreProveedor').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();

        // Validaciones
        if (nombreProveedor === '' || direccion === '' || telefono === ''|| email === '') {
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
                success: async function(dataresponse) {
                    if (dataresponse.status === 'success') {
                        var insertedRow = dataresponse.data;

                        // Agregar la fila a la tabla
                        $("#tablaProveedores").append(`
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
                        await cargarTablaProveedores(1);
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
    function cargarTablaProveedores(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablaProveedores.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function(dataresponse, statustext, response) {
                document.getElementById("tablaProveedores").innerHTML = dataresponse;
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
        cargarTablaProveedores(pagina);
    });
});