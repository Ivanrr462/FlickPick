<?php
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$a = md5($clave);
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("error en la conexion");
}

$consulta ="select * from login where usuario = '$usuario' ";
$result = $conn->query($consulta);
$n=mysqli_affected_rows($conn);
$fila = $result->fetch_array();
if(($n==1) && ($a==$fila[1])) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    if($usuario == 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: index.php');
    }
} else {
    echo "<script>alert('UHUH, algo salió mal');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>