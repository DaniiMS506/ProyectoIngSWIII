// Obtener la fecha actual y Llenado dinamico de Fecha
const today = new Date();

// Formatear la fecha en formato yyyy-mm-dd
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0'); // Meses comienzan en 0
const dd = String(today.getDate()).padStart(2, '0');

const formattedToday = `${yyyy}-${mm}-${dd}`;

// Asignar la fecha actual al input de fecha
document.getElementById('txtFecha').value = formattedToday;


/////////////////////////////////////////////////////////////////////////
/* INSERT */
/////////////////////////////////////////////////////////////////////////

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
                        swal("Alerta!", insertedRow.error, "warning");
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
            url: '../PHP/Consultas/TablasAdmin/TablaProductosAdmin.php',
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


/////////////////////////////////////////////////////////////////////////
/* UPDATE */
/////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    // Función para cargar datos del producto para editar
    window.cargarDatosParaEditar = async function (idProducto) {
        try {
            const response = await $.ajax({
                url: '../PHP/Consultas/CargarDatosEditar/obtener_datos_producto.php',
                method: 'POST',
                data: { id_producto: idProducto },
                dataType: 'json'
            });

            if (response.error) {
                swal("Alerta!", response.error, "warning");
                return;
            }

            $('#NombreProducto').val(response.Nombre_producto);
            $('#txtPrecio').val(response.Precio);
            $('#txtFecha').val(response.Fecha_expiracion);
            $('#Descripcion').val(response.Descripcion);
            $('#selTipo').val(response.Id_categoria);
            $('#ImagenProd').val(''); // Se mantiene vacío, ya que no se puede prellenar el campo file
            $('#btn_RegistrarProd').hide();
            $('#btn_Update').show().data('id_producto', idProducto);

            // Enviar mensaje de éxito después de cargar los datos
            swal("¡Datos Cargados!", "Los datos han sido cargados para editar.", "success");

        } catch (error) {
            console.error(error);
            swal("Alerta!", "Error al cargar los datos del producto.", "warning");
        }
    };

    // Función para actualizar el producto
    $('#btn_Update').on('click', async function (e) {
        e.preventDefault();

        const idProducto = $(this).data('id_producto');
        let nombreProducto = $('#NombreProducto').val().trim();
        let descripcion = $('#Descripcion').val().trim();
        let precio = $('#txtPrecio').val().trim();
        let fechaExpiracion = $('#txtFecha').val().trim();
        let idCategoria = $('#selTipo').val();

        console.log('Name: ' + nombreProducto, ' descripcion: ' + descripcion);

        if (!nombreProducto || !idCategoria || !precio || isNaN(precio) || parseFloat(precio) <= 0 || !descripcion || !fechaExpiracion) {
            swal("Alerta!", "Todos los campos son obligatorios y deben ser válidos.", "warning");
            return;
        }

        let formData = new FormData();
        formData.append('id_producto', idProducto);
        formData.append('NombreProducto', nombreProducto);
        formData.append('Descripcion', descripcion);
        formData.append('Precio', precio);
        formData.append('Fecha_expiracion', fechaExpiracion);
        formData.append('Id_categoria', idCategoria);

        let file = $('#ImagenProd')[0].files[0];
        if (file) {
            formData.append('ImagenProd', file);
        }


        // Depurar los valores de FormData
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }


        try {
            const response = await $.ajax({
                url: '../PHP/Updates/updateProducto.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json'
            });

            if (response.error) {
                swal("Alerta!", response.error, "warning");
                return;
            }

            swal("Éxito!", "Producto actualizado correctamente.", "success");

            $('#btn_Update').hide();
            $('#btn_RegistrarProd').show();

            $('#NombreProducto, #txtPrecio, #Descripcion, #selTipo, #txtFecha, #ImagenProd').val('');

            cargarTablaProductos(1);
        } catch (error) {
            console.error(error);
            swal("Alerta!", "Error en la actualización del producto.", "warning");
        }
    });

    // Función para cargar la tabla de productos
    function cargarTablaProductos(pagina) {
        $.ajax({
            url: '../PHP/Consultas/TablasAdmin/TablaProductosAdmin.php',
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


/////////////////////////////////////////////////////////////////////////
/* DELETE */
/////////////////////////////////////////////////////////////////////////

// Manejar eliminación del producto
$(document).on('click', '.eliminar', function (event) {
    event.preventDefault();
    var id_producto = $(this).closest('tr').find('td:eq(0)').text();
    eliminarProducto(id_producto);
});

// Función encargada de eliminar el producto
function eliminarProducto(id_producto) {
    // Confirmar con SweetAlert antes de eliminar
    swal({
        title: "¿Estás seguro?",
        text: `¿Estás seguro de eliminar el producto con ID ${id_producto}?`,
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
                url: '../PHP/Delets/delete_productos_admin.php',
                type: 'POST',
                data: {
                    id_producto: id_producto
                },
                success: function (response) {
                    if (response.error) {
                        swal({
                            icon: 'error',
                            title: 'Error al eliminar',
                            text: response.error,
                            showConfirmButton: true
                        });
                    } else {
                        swal("¡Eliminado!", "Eliminada correctamente.", "success");
                        // Se recarga la página después de 1 segundo
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
            swal("Cancelado", `El producto con ID ${id_producto} no ha sido eliminado.`, "error");
        }
    });
}