<?php
require_once('../../Conexion/conn.php');

$tabla = "";
$limit = 12; // Número de registros por página

// Obtener el número total de registros
$sqlCount = "SELECT COUNT(*) as total FROM proveedores";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRegistros = $rowCount['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalRegistros / $limit);

// Obtener la página actual (por defecto, la primera página)
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

// Calcular el offset
$offset = ($pagina - 1) * $limit;

$sql = "SELECT * FROM proveedores LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $tabla .= "
            <tr>
                <td>" . $row["id_proveedor"] . "</td>
                <td>" . $row["proveedor"] . "</td>

                <td id=\"contenedor\"> 
                    <abbr title=\"Editar\"><button class=\"btn btn_danger\" onclick=\"cargarDatosParaEditar(" . $row["id_proveedor"] . ")\" style='border-color:#0B7DE1; border-radius: 12px; float: right; margin-left: 8px' class='btn' >  <i class=\"fa fa-pencil-square-o\" style='color:#238ce8;'> </i> </button></abbr>
                    <abbr title=\"Eliminar\"><button class=\"btn btn_danger\" onclick=\"eliminarProveedor(" . $row["id_proveedor"] . ")\" style='border-color:#D60404; border-radius: 12px; float: right;' class='btn' >  <i class=\"fa fa-trash\" style='color:#D60404; font-weight: bold;'> </i> </button></abbr>
                </td>
            </tr>";
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Agregar la paginación al final del resultado
$tabla .= '<tr><td colspan="3">';
for ($i = 1; $i <= $totalPaginas; $i++) {
    $tabla .= '<a href="javascript:void(0);" class="pagination-link-proveedores" data-pagina="' . $i . '">' . $i . '</a> ';
}
$tabla .= '</td></tr>';

echo $tabla;
?>
