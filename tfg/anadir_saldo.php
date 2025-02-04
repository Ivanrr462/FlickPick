<?php
session_start();
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if ($conn->connect_error) {
    die('Error de Conexión (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

$nombre = $_SESSION['usuario'];
$metodo_pago = $_POST['pago'];
$codigoPromocional = $_POST['codigoPromocional'];

if ($metodo_pago == 'Tarjeta') {
    if (isset($_POST['numeroTarjeta']) && isset($_POST['fechaCaducidad']) && isset($_POST['cvc']) && isset($_POST['valor'])) {
        $numero_tarjeta = $_POST['numeroTarjeta'];
        $fecha_caducidad = $_POST['fechaCaducidad'];
        $cvc = $_POST['cvc'];
        $valor = $_POST['valor'];

        if (!empty($numero_tarjeta) && !empty($fecha_caducidad) && !empty($cvc) && !empty($valor)) {
            $sql = "UPDATE login SET hucha = hucha + ? WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $valor, $nombre);
            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            }
        } else {
            echo "Por favor, rellena todos los campos.";
        }
    }
}

if ($metodo_pago == 'Código Promocional') {
    $sql = "SELECT valor FROM codigos WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigoPromocional);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valor = $row['valor'];
        $sql = "UPDATE login SET hucha = hucha + ? WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $valor, $nombre);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        }
    }
}

$conn->close();
?>
