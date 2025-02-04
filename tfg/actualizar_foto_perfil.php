<?php
ob_start(); // Inicia el almacenamiento en búfer de la salida
session_start();

$usuario = $_SESSION['usuario']; 
if(isset($_FILES['nueva_foto'])){
    $usuario = $_SESSION['usuario'];
    $conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

    if (!$conn) {
        die("error en la conexion");
    }

    $target_dir = "fotos_perfil/";
    $perfil = $target_dir . basename($_FILES['nueva_foto']['name']);

    if (move_uploaded_file($_FILES['nueva_foto']['tmp_name'], $perfil)){
        $consulta = "UPDATE login SET perfil = '$perfil' WHERE usuario = '$usuario'";
        $result = $conn->query($consulta);

        if ($result) {
            echo "<script>alert('Foto actualizada con éxito.');</script>";
            header('Location: perfil.php?usuario=' . $usuario);
        } else {
            echo "Hubo un error al actualizar la foto de perfil";
        }
    } else {
        echo "Hubo un error al subir la foto de perfil";
    }
}
ob_end_flush(); // Envía el contenido del búfer de salida y apaga el almacenamiento en búfer de la salida
?>

