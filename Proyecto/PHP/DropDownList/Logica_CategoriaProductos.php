<?php
require_once('../Conexion/conn.php');

// Verificar si la conexión se estableció correctamente
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

////////////////////////////////////////////////////////////////////

// ////////// Categoria id=selTipo \\\\\\\\\\ \\
$sqlTipo = "SELECT Id_categoria, Nombre_categoria FROM categoria";
$resultTipo = $conn->query($sqlTipo);

// Almacena las opciones de proveedores en una variable
$optionsSelTipo = '';

// Verifica si la consulta fue exitosa
if ($resultTipo === false) {
    die('Error en la consulta SQL: ' . $conn->error);
}

// Verificar si hay resultados
if ($resultTipo->num_rows > 0) {
    $optionsSelTipo .= '<select id="selTipo" class="form-select">';
    $optionsSelTipo .= '<option value="">Seleccione la Categoria del Producto</option>';

    // Itera sobre los resultados y genera las opciones del select
    while ($rowTipo = $resultTipo->fetch_assoc()) {
        $id_tipo = $rowTipo["Id_categoria"];
        $tipo_producto = $rowTipo["Nombre_categoria"];
        $optionsSelTipo .= '<option value="' . $id_tipo . '">' . $tipo_producto . '</option>';
    }

    $optionsSelTipo .= '</select>';
} else {
    $optionsSelTipo .= '<select id="selTipo" class="form-select">';
    $optionsSelTipo .= '<option value="" disabled selected>No hay Categorias de Productos Disponibles</option>';
    $optionsSelTipo .= '</select>';
}


/////////////////////////////////////////
// Cierra la conexión a la base de datos
mysqli_close($conn);
