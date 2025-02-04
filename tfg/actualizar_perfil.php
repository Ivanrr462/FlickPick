<?php
session_start();

$usuarioOriginal = $_SESSION['usuario']; // Asegúrate de que este valor se establece correctamente cuando el usuario inicia sesión
$usuarioNuevo = $_POST['usuario'];
$clave = $_POST['contraseña'];
$correo = $_POST['email'];
$a = md5($clave);
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("error en la conexion");
}

if (!empty($usuarioNuevo)) {
    $consulta = "UPDATE login SET usuario = '$usuarioNuevo' WHERE usuario = '$usuarioOriginal'";
    $result = $conn->query($consulta);
    if (!$result) {
        echo "<script>alert('Error al actualizar el usuario.');</script>";
    } else {
        // Actualiza el usuario en la sesión
        $_SESSION['usuario'] = $usuarioNuevo;
    }
}

if (!empty($clave)) {
    $consulta = "UPDATE login SET contraseña = '$a' WHERE usuario = '$usuarioNuevo'";
    $result = $conn->query($consulta);
    if (!$result) {
        echo "<script>alert('Error al actualizar la contraseña.');</script>";
    }
}

if (!empty($correo)) {
    $consulta = "UPDATE login SET correo = '$correo' WHERE usuario = '$usuarioNuevo'";
    $result = $conn->query($consulta);
    if (!$result) {
        echo "<script>alert('Error al actualizar el correo.');</script>";
    }
}

header('Location: perfil.php?usuario=' . $usuarioNuevo);
?>
