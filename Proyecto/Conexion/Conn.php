<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "farmaciaproyecto";

// Configuración de errores de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Crear conexión
$conn = mysqli_connect($server, $user, $pass, $db);

// Validar conexión
if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

?>