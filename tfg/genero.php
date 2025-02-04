<?php
session_start();
$usuario = "";

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

if (isset($_GET['genero'])) {
    $genero = $_GET['genero'];
} else {
    echo "No se ha seleccionado ningún género.";
}

$genero = mysqli_real_escape_string($conn, $genero);

$consulta2 ="select * from login where usuario = '$usuario'";
$result2 = $conn->query($consulta2);
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
    <?php if($usuario != ""): ?>
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
                        <p><a href="perfil.php?usuario=<?php echo $usuario; ?>">Ver perfil</a></p>
                        <p><a href="logout.php">Salir</a></p>
                    </div>
                </div></li>
            </ul>
        </nav>
    </header>
    <?php
    $conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    echo "<h3>Todas las peliculas del genero " . $genero . "</h3>";
    $consulta2 = "SELECT * FROM peliculas WHERE genero = '" . $genero . "'";
    $result = $conn->query($consulta2);
    $counter = 0; 

    echo '<table><tr>';
    
    while ($fila = $result->fetch_array()) {
        echo "<td style='vertical-align: top; padding: 10px;'>"; 
        echo "<a href='ver_pelicula.php?id_pelicula={$fila['id']}' title='{$fila['titulo']}'>";
        echo "<img src='{$fila['cartel']}' width='200' style='display: block;'><br>"; 
        echo "<div style='width: 200px; margin: auto;'><h3>{$fila['titulo']}</h3></div>"; 
        echo "</a>";
        echo "</td>";
        $counter++;
    
        if ($counter % 7 == 0) {
            echo '</tr><tr>'; 
        }
    }
    
    echo '</tr></table>';
    
    $conn->close();
        ?>
    <?php else: ?>
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
                <li><div>
                    <a href="login.html"><img src="imagenes/usuario.png" width="25px" height="25px"></a>
                </div></li>
            </ul>
        </nav>
    </header>
    <?php
    $conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    echo "<h3>Todas las peliculas del genero " . $genero . "</h3>";
    $consulta2 = "SELECT * FROM peliculas WHERE genero = '" . $genero . "'";
    $result = $conn->query($consulta2);
    $counter = 0; 

    echo '<table><tr>';
    
    while ($fila = $result->fetch_array()) {
        echo "<td style='vertical-align: top; padding: 10px;'>"; 
        echo "<a href='ver_pelicula.php?id_pelicula={$fila['id']}' title='{$fila['titulo']}'>";
        echo "<img src='{$fila['cartel']}' width='200' style='display: block;'><br>"; 
        echo "<div style='width: 200px; margin: auto;'><h3>{$fila['titulo']}</h3></div>"; 
        echo "</a>";
        echo "</td>";
        $counter++;
    
        if ($counter % 7 == 0) {
            echo '</tr><tr>'; 
        }
    }
    
    echo '</tr></table>';
    
    $conn->close();
        ?>
    <?php endif; ?>
</body>
</html>