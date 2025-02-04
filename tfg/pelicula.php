<?php
session_start();

$mysqli = new mysqli("flickpick_bdd:3306", "root", "", "FlickPick");

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if(isset($_SESSION['usuario']) && isset($_GET['id_pelicula'])) {
    $nombre = $_SESSION['usuario'];
    $id_pelicula = $_GET['id_pelicula'];
} else {
    exit;
}

$sql = "SELECT fecha_compra, fecha_expiracion FROM peliculas_adquiridas WHERE usuario = ? AND id_pelicula = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $nombre, $id_pelicula);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$consulta2 ="select * from login where usuario = '$nombre'";
$result2 = $mysqli->query($consulta2);
$login = $result2->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FlickPick</title>
    <link rel="icon" href="imagenes/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<header>
    <nav>
        <div class="junto">
        <a href="index.php"><img src="imagenes/favicon.png" width="50px" height="50px"></a>
        <h4>FlickPick</h4>
        </div>
        <ul>
        <li>
            <div class="dropdown-genero">
                <a href="#">Género</a>
                <div class="dropdown-content-genero">
                    <table>
                        <tr>
                            <td><a href="genero.php?genero=Ciencia Ficcion">Ciencia Ficción</a></td>
                            <td><a href="genero.php?genero=Fantasia">Fantasía</a></td>
                            <td><a href="genero.php?genero=Comedia">Comedia</a></td>
                        </tr>
                        <tr>
                            <td><a href="genero.php?genero=Accion">Acción</a></td>
                            <td><a href="genero.php?genero=Terror">Terror</a></td>
                            <td><a href="genero.php?genero=Aventura">Aventura</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </li>
            <li><a href="peliculas.php">Peliculas</a></li>
            <li><a href="biblioteca.php">Mi biblioteca</a></li>
            <li><div class="junto">
                <a href="pago.php"><img src="imagenes/hucha.png" width="25px" height="25px"></a>
                <span><?php echo $login['hucha']; ?>€</span>
            </div></li>
            <li><div class="dropdown">
                <img src="<?php echo $login['perfil']; ?>" width="25px" height="25px" class="avatar">
                <div class="dropdown-content">
                    <p><a href="perfil.php?usuario=<?php echo $nombre; ?>">Ver perfil</a></p>
                    <p><a href="logout.php">Salir</a></p>
                </div>
            </div></li>
        </ul>
    </nav>
</header>
<?php


$sql = "SELECT * FROM peliculas WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_pelicula);
$stmt->execute();
$result = $stmt->get_result();
$pelicula = $result->fetch_assoc();

if ($pelicula) {
    echo "<center><h1>" . $pelicula['titulo'] . "</h1><br><br>";
    if ($row && $row['fecha_expiracion'] !== NULL) {
        $fecha_expiracion = new DateTime($row['fecha_expiracion']);
        $fecha_actual = new DateTime();
        $dias_restantes = $fecha_actual->diff($fecha_expiracion)->days;
        echo "<h3>Tienes " . $dias_restantes . " días para ver la película.</h3>";
    }
    echo "<br><br><br>";
    echo "<video width='1300' height='750' controls>
                    <source src='" . $pelicula['video'] . "' type='video/mp4'>
                    Tu navegador no soporta el elemento de video.
                </video><br><br>";
}
if ($row && $row['fecha_expiracion'] == NULL) {
    echo "<a href='" . $pelicula['video'] . "' download style=\"display: inline-block; font-size: 1em; padding: 10px 20px; background-color: blue; color: white; text-decoration: none;\">Descargar video</a></center>";
}
?>

</body>
</html>
