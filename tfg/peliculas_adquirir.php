<?php
session_start();
$mysqli = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$nombre = $_SESSION['usuario'];
$precio_alquilar = $_POST['precio_alquilar'];
$precio_comprar = $_POST['precio_comprar'];
$id_pelicula = $_POST['id_pelicula'];

$sql = "SELECT hucha FROM login WHERE usuario = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$hucha = $row['hucha'];

$sql = "SELECT * FROM peliculas_adquiridas WHERE usuario = ? AND id_pelicula = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $nombre, $id_pelicula);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "<script>alert('Ya tienes la peli alquilada/adquirida');</script>";
    echo "<script>window.location.href = 'ver_pelicula.php?id_pelicula=$id_pelicula';</script>";
    exit;
}

if ($_POST['accion'] == 'alquilar') {
    if ($hucha < $precio_alquilar) {
        echo "<script>alert('Saldo insuficiente');</script>";
        echo "<script>window.location.href = 'ver_pelicula.php?id_pelicula=$id_pelicula';</script>";
    } else {
        $sql = "INSERT INTO peliculas_adquiridas (usuario, id_pelicula, fecha_compra, fecha_expiracion, modo) VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), ?)";
        $stmt = $mysqli->prepare($sql);
        $modo = "a";
        $stmt->bind_param("sis", $nombre, $id_pelicula, $modo);
        if ($stmt->execute()) {
            $sql = "UPDATE login SET hucha = hucha - ? WHERE usuario = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $precio_alquilar, $nombre);
            $stmt->execute();

            header("Location: pelicula.php?id_pelicula=" . $id_pelicula);
            exit;
        }
    }
} elseif ($_POST['accion'] == 'comprar') {
    if ($hucha < $precio_comprar) {
        echo "<script>alert('Saldo insuficiente');</script>";
        echo "<script>window.location.href = 'ver_pelicula.php?id_pelicula=$id_pelicula';</script>";
    } else {
        $sql = "INSERT INTO peliculas_adquiridas (usuario, id_pelicula, fecha_compra, modo) VALUES (?, ?, CURDATE(), ?)";
        $stmt = $mysqli->prepare($sql);
        $modo = "c";
        $stmt->bind_param("sis", $nombre, $id_pelicula, $modo);
        if ($stmt->execute()) {
            $sql = "UPDATE login SET hucha = hucha - ? WHERE usuario = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $precio_comprar, $nombre);
            $stmt->execute();

            $_SESSION['id_pelicula'] = $id_pelicula;
            header("Location: pelicula.php?id_pelicula={$_SESSION['id_pelicula']}");
            exit;
        }
    }
}

$mysqli->close();
?>
