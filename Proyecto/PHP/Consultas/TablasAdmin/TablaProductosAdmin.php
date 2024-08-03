<?php
require_once('../../../Conexion/conn.php');

$tabla = "";
$limit = 5; // Número de registros por página

// Obtener el número total de registros
$sqlCount = "SELECT COUNT(*) as total FROM Producto";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRegistros = $rowCount['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalRegistros / $limit);

// Obtener la página actual (por defecto, la primera página)
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

// Calcular el offset
$offset = ($pagina - 1) * $limit;

// Obtener los productos con paginación y el nombre de la categoría
$sql = "SELECT p.Id_producto, p.Nombre_producto, p.Descripcion, p.Precio, p.Fecha_expiracion, c.Nombre_categoria, i.Imagen
        FROM Producto p
        INNER JOIN Categoria c ON p.Id_categoria = c.Id_categoria
        LEFT JOIN Imagen i ON p.Id_producto = i.Id_producto
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $imagen = $row["Imagen"] ? '<img src="data:image/jpeg;base64,' . base64_encode($row["Imagen"]) . '" alt="' . htmlspecialchars($row["Nombre_producto"]) . '" class="product-image">' : '<div class="no-image">Imagen no disponible</div>';

    $tabla .= "
        <tr>
            <td>" . htmlspecialchars($row["Nombre_producto"]) . "</td>
            <td>" . htmlspecialchars($row["Descripcion"]) . "</td>
            <td>" . '₡' . htmlspecialchars($row["Precio"]) . "</td>
            <td>" . htmlspecialchars($row["Fecha_expiracion"]) . "</td>
            <td>" . htmlspecialchars($row["Nombre_categoria"]) . "</td>
            <td><div class='image-container'>" . $imagen . "</div></td>

            <td id=\"contenedor\"> 
                <abbr title=\"Editar\"><button class=\"btn btn_danger\" onclick=\"cargarDatosParaEditar(" . $row["Id_producto"] . ")\" style='border-color:#0B7DE1; border-radius: 12px; margin-left: 8px' class='btn' >  <i class=\"fa fa-pencil-square-o\" style='color:#238ce8;'> </i> </button></abbr>
                <abbr title=\"Eliminar\"><button class=\"btn btn_danger\" onclick=\"eliminarProducto(" . $row["Id_producto"] . ")\" style='border-color:#D60404; border-radius: 12px;' class='btn' >  <i class=\"fa fa-trash\" style='color:#D60404; font-weight: bold;'> </i> </button></abbr>
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
