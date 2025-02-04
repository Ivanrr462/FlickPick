<?php
session_start();

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}

$usuario = $_SESSION['usuario'];
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$consulta2 ="select * from login where usuario = '$usuario'";
$result2 = $conn->query($consulta2);
$login = $result2->fetch_assoc();

$consulta3 ="SELECT peliculas.* FROM peliculas_adquiridas INNER JOIN peliculas ON peliculas_adquiridas.id_pelicula = peliculas.id WHERE peliculas_adquiridas.usuario = '$usuario' ORDER BY peliculas_adquiridas.fecha_compra DESC";
$result3 = $conn->query($consulta3);



?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FlickPick - Perfil de <?php echo $usuario; ?></title>
    <link rel="icon" href="imagenes/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        form {
            width: 50%; 
            margin: 20px auto; 
        }

        form table {
            width: 100%;
            margin-top: 20px;
        }

        form td {
            padding: 10px;
        }

        form input[type="text"], form input[type="email"], form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        form input[type="button"], form button {
            background-color: grey;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
            margin-top: 10px;
        }

        form input[type="button"]:hover, form button:hover {
            background-color: black;
        }
    </style>
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
            <li>
                <div class="junto">
                    <a href="pago.php"><img src="imagenes/hucha.png" width="25px" height="25px"></a>
                    <span><?php echo $login['hucha']; ?>€</span>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <img src="<?php echo $login['perfil']; ?>" width="25px" height="25px" class="avatar">
                    <div class="dropdown-content">
                        <p><a href="perfil.php?usuario=<?php echo $usuario; ?>">Ver perfil</a></p>
                        <p><a href="logout.php">Salir</a></p>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

    <main>
        <div style="display: flex; justify-content: space-between;">
            <!-- Sección de cambio de foto de perfil -->
            <div style="width: 45%;">
                <center><h2>Tu foto de perfil</h2>
                <form action="actualizar_foto_perfil.php" method="post" enctype="multipart/form-data">
                    <img src="<?php echo $login['perfil']; ?>" width="300px" height="300px" ><br>
                    <input type="file" name="nueva_foto" id="nueva_foto" style="display: none;">
                    <button type="button" onclick="document.getElementById('nueva_foto').click();">Cambiar foto de perfil</button><br>
                    <input type="submit" value="Actualizar foto de perfil">
                </form>
                </center>
            </div>

            <!-- Sección de cambio de información de perfil -->
            <div style="width: 45%;">
                <center><h2>Tu información de perfil</h2></center>
                <form action="actualizar_perfil.php" method="post" enctype="multipart/form-data" onsubmit="return validarContraseña();">
                    <table>
                        <tr><td>Usuario:</td><td><input type="text" name="usuario" value="<?php echo $login['usuario']; ?>"></td></tr>
                        <tr><td>Correo:</td><td><input type="email" name="email" value="<?php echo $login['correo']; ?>"></td></tr>
                        <tr><td>Contraseña Nueva:</td><td><input type="password" id="contraseña" name="contraseña" value=""></td></tr>
                    </table><br><br>
                    <input type="submit" value="Actualizar perfil">
                </form>
                <form action="borrar_cuenta.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres borrar tu cuenta? Esta acción no se puede deshacer.');">
                    <input type="submit" value="Borrar cuenta" style="background-color: red; color: white;">
                </form>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('#formPerfil').on('submit', function(e) {
                        var contraseña = $("#contraseña").val();
                        var confirmar_contraseña = $("#confirmar_contraseña").val();

                        if (contraseña != confirmar_contraseña) {
                            alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
                            e.preventDefault();
                        }
                    });
                });
                </script>
            </div>
        </div>
    <br><br><br>
    <h2>Películas adquiridas o alquiladas recientemente</h2>
    <table>
        <tr>
        <?php
        $counter = 0;
        while ($fila = $result3->fetch_assoc()) {
            echo "<td style='vertical-align: top; padding: 10px;'>"; 
            echo "<a href='pelicula.php?id_pelicula={$fila['id']}' title='{$fila['titulo']}'>";
            echo "<img src='{$fila['cartel']}' width='200' style='display: block;'><br>"; 
            echo "<div style='width: 200px; margin: auto;'><h3>{$fila['titulo']}</h3></div>"; 
            echo "</a>";
            echo "</td>";
            $counter++;

            if ($counter % 7 == 0) {
                echo '</tr>'; 
            }
        }
        ?>
    </table>
</main>
</body>
</html>