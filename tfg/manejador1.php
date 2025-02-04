<?php
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
$trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
$video = mysqli_real_escape_string($conn, $_POST['video']);
$baner = mysqli_real_escape_string($conn, $_POST['baner']);
$cartel = mysqli_real_escape_string($conn, $_POST['cartel']);

$sql = "UPDATE peliculas SET trailer='$trailer', video='$video', baner='$baner', cartel='$cartel' WHERE titulo='$titulo'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Datos ingresados con exito');</script>";
        echo "<script>window.location.href = 'admin.php';</script>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
