<?php
require_once('../../Conexion/conn.php');

$tabla = "";
$limit = 5; // Número de registros por página

// Obtener el número total de registros
$sqlCount = "SELECT COUNT(*) as total FROM categoria";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRegistros = $rowCount['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalRegistros / $limit);

// Obtener la página actual (por defecto, la primera página)
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

// Calcular el offset
$offset = ($pagina - 1) * $limit;

// Obtener los categorias con paginación y el nombre de la categoría
$sql = "SELECT * from categoria
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {

    $tabla .= "
        <tr>
            <td>" . $row["Nombre_categoria"] . "</td>
            <td>" . $row["Descripcion"] . "</td>
        </tr>";
}

// Agregar la paginación al final del resultado
$tabla .= '<tr><td colspan="6">';
for ($i = 1; $i <= $totalPaginas; $i++) {
    $tabla .= '<a href="javascript:void(0);" class="pagination-link-productos" data-pagina="' . $i . '">' . $i . '</a> ';
}
$tabla .= '</td></tr>';

echo $tabla;
