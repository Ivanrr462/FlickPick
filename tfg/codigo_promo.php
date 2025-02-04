<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["titulo"];
    $valor = $_POST["desc"];
    $conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO codigos (codigo, valor) VALUES ('$codigo', '$valor')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuevo codigo promocional generado con éxito');</script>";
        echo "<script>window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Error al generar un nuevo código promocional');</script>";
        echo "<script>window.location.href = 'admin.php';</script>";
    }
    } else {
        echo "<script>alert('Lo siento, hubo un error al generar tu código.');</script>";
        echo "<script>window.location.href = 'admin.php';</script>";
    }
    $conn->close();
?>