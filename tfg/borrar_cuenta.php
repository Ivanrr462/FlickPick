<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    exit;
}

$usuario = $_SESSION['usuario'];

$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($conn->connect_error) {
    die("Error en la conexión");
}

$consulta = "DELETE FROM login WHERE usuario = '$usuario'";
$result = $conn->query($consulta);

if ($result && $conn->affected_rows > 0) {
    session_destroy();
    header("Location: index.php");
} else {
    echo "Error al borrar la cuenta";
}

$conn->close();
?>
