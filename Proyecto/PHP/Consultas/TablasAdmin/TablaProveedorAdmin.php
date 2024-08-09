<?php
require_once('../../../Conexion/conn.php');

$tabla = "";
$limit = 6; // Número de registros por página

// Obtener el número total de registros
$sqlCount = "SELECT COUNT(*) as total FROM proveedor";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRegistros = $rowCount['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalRegistros / $limit);

// Obtener la página actual (por defecto, la primera página)
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

// Calcular el offset
$offset = ($pagina - 1) * $limit;

// Consultar los datos de las tablas Inventario y Producto
$sql = "SELECT * from proveedor
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $tabla .= "
        <tr>
            <td>" . $row["Nombre"] . "</td>
            <td>" . $row["Direccion"] . "</td>
            <td>" . $row["Telefono"] . "</td>
            <td>" . $row["Email"] . "</td>

            <td id=\"contenedor\"> 
                <abbr title=\"Editar\"><button class=\"btn btn_danger\" onclick=\"cargarDatosParaEditar(" . $row["Id_proveedor"] . ")\" style='border-color:#0B7DE1; border-radius: 12px; margin-left: 8px' class='btn' >  <i class=\"fa fa-pencil-square-o\" style='color:#238ce8;'> </i> </button></abbr>
                <abbr title=\"Eliminar\"><button class=\"btn btn_danger\" onclick=\"eliminarProveedor(" . $row["Id_proveedor"] . ")\" style='border-color:#D60404; border-radius: 12px;' class='btn' >  <i class=\"fa fa-trash\" style='color:#D60404; font-weight: bold;'> </i> </button></abbr>
            </td>

        </tr>";
}

// Agregar la paginación al final del resultado
$tabla .= '<tr><td colspan="12">';
for ($i = 1; $i <= $totalPaginas; $i++) {
    $tabla .= '<a href="javascript:void(0);" class="pagination-link-productos" data-pagina="' . $i . '">' . $i . '</a> ';
}
$tabla .= '</td></tr>';

echo $tabla;
