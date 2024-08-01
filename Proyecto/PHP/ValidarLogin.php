<?php
session_start();
require_once("../Conexion/conn.php");

$email = $_REQUEST['logemail'];
$password = $_REQUEST['logpass'];

// Utiliza consultas preparadas para evitar SQL injection
$queryUsuario = "SELECT Id_usuario, Email, Password, Id_rol FROM usuario WHERE Email=? AND Password=?";
$stmtUsuario = mysqli_prepare($conn, $queryUsuario);
mysqli_stmt_bind_param($stmtUsuario, 'ss', $email, $password);
mysqli_stmt_execute($stmtUsuario);
mysqli_stmt_store_result($stmtUsuario);

// Si encuentra una fila que corresponda en Usuario
if (mysqli_stmt_num_rows($stmtUsuario) > 0) {
    mysqli_stmt_bind_result($stmtUsuario, $id_Usuario, $email, $pass, $id_rol);

    // Fetch result
    mysqli_stmt_fetch($stmtUsuario);

    $_SESSION['Id_usuario'] = $id_Usuario;
    $_SESSION['Email'] = $email;
    $_SESSION['Tipo'] = $id_rol;

    // Validar tipo de usuario
    if ($_SESSION['Tipo'] == '1') { // Admin
        echo 'Comprobando...';
    } else if ($_SESSION['Tipo'] == '2') { // Usuario
        echo 'Validando Usuario...';
    } else {
        echo 'El usuario no existe';
    }

    mysqli_stmt_close($stmtUsuario);
    mysqli_close($conn);
    exit();
} else {
    echo 'El usuario no existe';
    mysqli_stmt_close($stmtUsuario);
    mysqli_close($conn);
    exit();
}
