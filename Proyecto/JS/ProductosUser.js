// Obtener la fecha actual y Llenado dinamico de Fecha
const today = new Date();

// Formatear la fecha en formato yyyy-mm-dd
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0'); // Meses comienzan en 0
const dd = String(today.getDate()).padStart(2, '0');

const formattedToday = `${yyyy}-${mm}-${dd}`;

// Asignar la fecha actual al input de fecha
document.getElementById('txtFecha').value = formattedToday;


//////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    // Cargar Tabla
    cargarTablaProductos(1);

    // BTN Insert Producto 
    $('#btn_RegistrarProd').on('click', async function (e) {
        e.preventDefault();

        // Obtener los valores del formulario
        let nombreProducto = document.getElementById('NombreProducto').value.trim();
        let descripcion = document.getElementById('Descripcion').value.trim();
        let precio = document.getElementById('txtPrecio').value.trim();
        let fechaExpiracion = document.getElementById('txtFecha').value.trim();
        let idCategoria = document.getElementById('selTipo').value;

        // Validaciones
        if (!nombreProducto) {
            swal("Alerta!", "El nombre del producto es obligatorio.", "warning");
            return;
        }

        if (!idCategoria) {
            swal("Alerta!", "Debe seleccionar una categoría.", "warning");
            return;
        }

        if (!precio || isNaN(precio) || parseFloat(precio) <= 0) {
            swal("Alerta!", "El precio debe ser un número positivo.", "warning");
            return;
        }

        if (!descripcion) {
            swal("Alerta!", "La descripción es obligatoria.", "warning");
            return;
        }

        if (!fechaExpiracion) {
            swal("Alerta!", "La fecha de expiración es obligatoria.", "warning");
            return;
        }


        // Variables de Envio
        let formData = new FormData();
        formData.append('Nombre_producto', $('#NombreProducto').val());
        formData.append('Descripcion', $('#Descripcion').val());
        formData.append('Precio', $('#txtPrecio').val());
        formData.append('Fecha_expiracion', $('#txtFecha').val());
        formData.append('Id_categoria', $('#selTipo').val());


        // Verificar si se seleccionó un archivo y agregarlo
        let file = $('#ImagenProd')[0].files[0];
        if (file) {
            formData.append('ImagenProd', file);
        }


        try {
            // Realizar la inserción mediante AJAX
            await $.ajax({
                url: '../PHP/Inserts/insertProducto.php',
                method: 'POST',
                data: formData,
                processData: false,  // Importante para enviar FormData
                contentType: false,  // Importante para enviar FormData
                dataType: 'json',
                success: async function (insertedRow) {
                    if (insertedRow.error) {
                        swal("Alerta!" + insertedRow, "warning");
                        return;
                    }

                    // Agregar la fila a la tabla
                    $("#tablaProductos").append(`
                        <tr>
                            <td>${insertedRow.Nombre_producto}</td>
                            <td>${insertedRow.Descripcion}</td>
                            <td>₡${insertedRow.Precio}</td>
                            <td>${insertedRow.Fecha_expiracion}</td>
                            <td>${insertedRow.Id_categoria}</td>
                            <td><img src="../PHP/Imagenes/getImagen.php?id=${insertedRow.Id_producto}" alt="Imagen" class="product-image"></td>
                        </tr>
                    `);

                    // Limpiar los campos del formulario
                    $('#NombreProducto, #txtPrecio, #Descripcion, #selTipo, #txtFecha, #ImagenProd').val('');

                    // Mostrar mensaje de éxito
                    swal("Producto Agregado!", "El producto ha sido insertado correctamente.", "success");

                    // Después de la inserción, cargar nuevamente los datos de la tabla
                    await cargarTablaProductos(1);
                },
                error: function (request, errorcode, errortext) {
                    swal("Alerta!", "Error en la solicitud: " + errortext, "warning");
                    console.log(errorcode);
                    console.log(errortext);
                }
            });
        } catch (error) {
            console.error(error);
            swal("Alerta!", "Error en la solicitud.", "warning");
        }
    });

    // Función para cargar la tabla de productos
    function cargarTablaProductos(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablaProductos.php',
            method: 'POST',
            data: {
                pagina: pagina
            },
            success: function (dataresponse) {
                document.getElementById("tablaProductos").innerHTML = dataresponse;
            },
            error: function (request, errorcode, errortext) {
                swal("Alerta!", "Error al cargar los productos: " + errortext, "warning");
                console.log(errorcode);
                console.log(errortext);
            }
        });
    }

    $(document).on("click", ".pagination-link-productos", function () {
        var pagina = $(this).data("pagina");
        cargarTablaProductos(pagina);
    });
});
