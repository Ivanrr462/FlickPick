<?php
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
$descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
$ano = mysqli_real_escape_string($conn, $_POST['ano']);
$genero = mysqli_real_escape_string($conn, $_POST['genero']);
$autor = mysqli_real_escape_string($conn, $_POST['autor']);
$precio_alquilar = mysqli_real_escape_string($conn, $_POST['precio_alquilar']);
$precio_comprar = mysqli_real_escape_string($conn, $_POST['precio_comprar']);

$sql = "INSERT INTO peliculas (titulo, descripcion, Ao, genero, autor, precio_alquilar, precio_comprar) VALUES ('$titulo', '$descripcion', '$ano', '$genero', '$autor', '$precio_alquilar', '$precio_comprar')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Datos ingresados con exito');</script>";
        echo "<script>window.location.href = 'agregar_peliculas.php';</script>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
