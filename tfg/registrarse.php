<?php
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$correo = $_POST['email'];
$a = md5($clave);
$perfil = "imagenes/usuario.png";
$hucha = 0;
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$consulta = "INSERT INTO login (usuario, contrasea, correo, perfil, hucha) VALUES ('$usuario', '$a', '$correo', '$perfil', '$hucha')";
if ($conn->query($consulta) === TRUE) {
    header('Location: login.html');
} else {
    echo "<script>alert('UHUH, algo salió mal');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>