<?php
require_once('../Conexion/conn.php');

// Verificar si la conexión se estableció correctamente
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

////////////////////////////////////////////////////////////////////

// ////////// Categoria id=selProducto \\\\\\\\\\ \\
$sqlProducto = "SELECT Id_producto, Nombre_producto FROM producto";
$resultProducto = $conn->query($sqlProducto);

// Almacena las opciones de proveedores en una variable
$optionsSelProducto = '';

// Verifica si la consulta fue exitosa
if ($resultProducto === false) {
    die('Error en la consulta SQL: ' . $conn->error);
}

// Verificar si hay resultados
if ($resultProducto->num_rows > 0) {
    $optionsSelProducto .= '<select id="selProducto" class="form-select">';
    $optionsSelProducto .= '<option value="">Seleccione el Producto</option>';

    // Itera sobre los resultados y genera las opciones del select
    while ($rowTipo = $resultProducto->fetch_assoc()) {
        $id_tipo = $rowTipo["Id_producto"];
        $tipo_producto = $rowTipo["Nombre_producto"];
        $optionsSelProducto .= '<option value="' . $id_tipo . '">' . $tipo_producto . '</option>';
    }

    $optionsSelProducto .= '</select>';
} else {
    $optionsSelProducto .= '<select id="selProducto" class="form-select">';
    $optionsSelProducto .= '<option value="" disabled selected>No hay Productos Disponibles</option>';
    $optionsSelProducto .= '</select>';
}


/////////////////////////////////////////
// Cierra la conexión a la base de datos
mysqli_close($conn);
