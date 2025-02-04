<?php
session_start();

if (!isset($_POST['id_pelicula'], $_POST['usuario'], $_POST['calificacion'])) {
    http_response_code(400);
    exit('Datos incompletos');
}

$id_pelicula = $_POST['id_pelicula'];
$usuario = $_POST['usuario'];
$calificacion = $_POST['calificacion'];

$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($conn->connect_error) {
    http_response_code(500);
    exit('Error en la conexión');
}

$sql = "INSERT INTO calificaciones (id_usuario, id_pelicula, calificacion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sii', $usuario, $id_pelicula, $calificacion);

if ($stmt->execute()) {
    http_response_code(200);
} else {
    http_response_code(500);
}

$stmt->close();
$conn->close();
?>