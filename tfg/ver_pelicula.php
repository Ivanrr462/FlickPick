<?php
session_start();
$usuario = "";

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}

$id_pelicula = $_GET['id_pelicula'];
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("error en la conexion");
}

$consulta1 ="select * from peliculas where id = '$id_pelicula' ";
$consulta2 ="select * from login where usuario = '$usuario'";
$result = $conn->query($consulta1);
$result2 = $conn->query($consulta2);
$pelicula = $result->fetch_assoc();
$login = $result2->fetch_assoc();
$consulta3 ="SELECT AVG(calificacion) as media FROM calificaciones WHERE id_pelicula = $id_pelicula";
$result3 = $conn->query($consulta3);
$calificacion = $result3->fetch_assoc();
$media = $calificacion['media'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pelicula['titulo']; ?></title>
    <link rel="icon" href="imagenes/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
.center {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

button:hover {
    opacity: 0.8;
}

.star-rating {
            display: flex;
            justify-content: center;
            padding: 50px;
        }
        .star {
            cursor: pointer;
            color: lightgray;
            font-size: 50px;
            transition: color 0.2s;
        }
        .star.checked {
            color: orange;
        }
    </style>
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
    <center>
    <?php echo '<img src="'.$pelicula['baner'].'" alt="Banner" style="width: 50%; height: 30vh;">'; echo '<img src="'.$pelicula['baner'].'" alt="Banner" style="width: 50%; height: 30vh;">'; ?>
</center>
<div style="display: flex; justify-content: space-between;">

<div style="width: 45%; padding-right: 10px;">
    <div style="border: 1px; padding: 10px; display: flex;">
        <div style="width: 35%; padding-right: 10px;">
            <?php echo '<img src="'.$pelicula['cartel'].'" style="width: 60%; height: auto;">'; ?>
        </div>
        <div style="width: 65%; padding-left: 2px;">
            
                <h1><?php echo $pelicula['titulo']; ?></h1>
                <p><?php echo $pelicula['descripcion']; ?></p>
                <p><b>Género:</b> <?php echo $pelicula['genero']; ?></p>
                <p><b>Año:</b> <?php echo $pelicula['Año']; ?></p>
                <p><b>Autor:</b> <?php echo $pelicula['autor']; ?></p>
                <center>
                <p><h3>Calificación media: <?php echo round($media, 2); ?>★ </h3></p>
                <div class="star-rating">
                    <span class="star" id="star1" onclick="setRating(1)">★</span>
                    <span class="star" id="star2" onclick="setRating(2)">★</span>
                    <span class="star" id="star3" onclick="setRating(3)">★</span>
                    <span class="star" id="star4" onclick="setRating(4)">★</span>
                    <span class="star" id="star5" onclick="setRating(5)">★</span>
                </div>
                <script>
                function setRating(rating) {
                    let id_pelicula = <?php echo $id_pelicula; ?>;
                    let usuario = '<?php echo $usuario; ?>';

                    // Marcar la estrella seleccionada
                    for (let i = 1; i <= 5; i++) {
                        let star = document.getElementById('star' + i);
                        star.classList.remove('checked');
                        if (i <= rating) {
                            star.classList.add('checked');
                        }
                    }

                    // Enviar la calificación al servidor
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'guardar_calificacion.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('id_pelicula=' + id_pelicula + '&usuario=' + usuario + '&calificacion=' + rating);

                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            alert('Calificación guardada con éxito');
                        } else {
                            alert('Error al guardar la calificación');
                        }
                    };
                }
                </script>

            </center>
        </div>
    </div>
    <br><br><br>
    <center>
    <form action="peliculas_adquirir.php" method="post">
        <input type="hidden" name="precio_alquilar" value="<?php echo $pelicula['precio_alquilar']; ?>">
        <input type="hidden" name="id_pelicula" value="<?php echo $id_pelicula; ?>">
        <button type="submit" name="accion" value="alquilar">Alquilar por <?php echo $pelicula['precio_alquilar']; ?>€</button>

        <input type="hidden" name="precio_comprar" value="<?php echo $pelicula['precio_comprar']; ?>">
        <input type="hidden" name="id_pelicula" value="<?php echo $id_pelicula; ?>">
        <button type="submit" name="accion" value="comprar">Comprar por <?php echo $pelicula['precio_comprar']; ?>€</button>
    </form>
    </center>
    
</div>

<div style="width: 45%; padding-left: 10px;">
    <center><h2>Trailer</center>
        <div style="display: flex; justify-content: center;">
            <video width="100%" height="auto" controls>
                <source src="<?php echo $pelicula['trailer']; ?>" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div><br><br>
</div>
</div>
<script src="script/script.js"></script>

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
    <center>
    <?php echo '<img src="'.$pelicula['baner'].'" alt="Banner" style="width: 50%; height: 30vh;">'; echo '<img src="'.$pelicula['baner'].'" alt="Banner" style="width: 50%; height: 30vh;">'; ?>
</center>
<div style="display: flex; justify-content: space-between;">

<div style="width: 45%; padding-right: 10px;">
    <div style="border: 1px; padding: 10px; display: flex;">
        <div style="width: 35%; padding-right: 10px;">
            <?php echo '<img src="'.$pelicula['cartel'].'" style="width: 60%; height: auto;">'; ?>
        </div>
        <div style="width: 65%; padding-left: 2px;">
            
                <h1><?php echo $pelicula['titulo']; ?></h1>
                <p><?php echo $pelicula['descripcion']; ?></p>
                <p><b>Género:</b> <?php echo $pelicula['genero']; ?></p>
                <p><b>Año:</b> <?php echo $pelicula['Año']; ?></p>
                <p><b>Autor:</b> <?php echo $pelicula['autor']; ?></p>
                <center>
                <p><h3>Calificación media: <?php echo round($media, 2); ?>★ </h3></p>
                <div class="star-rating">
                    <span class="star" id="star1" onclick="setRating(1)">★</span>
                    <span class="star" id="star2" onclick="setRating(2)">★</span>
                    <span class="star" id="star3" onclick="setRating(3)">★</span>
                    <span class="star" id="star4" onclick="setRating(4)">★</span>
                    <span class="star" id="star5" onclick="setRating(5)">★</span>
                </div>
                <script>
                function setRating(rating) {
                    let id_pelicula = <?php echo $id_pelicula; ?>;
                    let usuario = '<?php echo $usuario; ?>';

                    // Comprobar si el usuario está registrado
                    if (!usuario) {
                        alert('Debe estar registrado para poder calificar');
                        window.location.href = 'login.html';
                        return;
                    }

                    // Marcar la estrella seleccionada
                    for (let i = 1; i <= 5; i++) {
                        let star = document.getElementById('star' + i);
                        star.classList.remove('checked');
                        if (i <= rating) {
                            star.classList.add('checked');
                        }
                    }

                    // Enviar la calificación al servidor
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'guardar_calificacion.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('id_pelicula=' + id_pelicula + '&usuario=' + usuario + '&calificacion=' + rating);

                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            alert('Calificación guardada con éxito');
                        } else {
                            alert('Error al guardar la calificación');
                        }
                    };
                }
            </script>
            </center>
        </div>
    </div>
    <br><br><br>
    <center>
    <form action="" method="post">
        <input type="hidden" name="precio_alquilar" value="<?php echo $pelicula['precio_alquilar']; ?>">
        <input type="hidden" name="id_pelicula" value="<?php echo $id_pelicula; ?>">
        <button type="button" onclick="alert('Para comprar este producto debe estar registrado'); window.location.href='login.html'">Alquilar por <?php echo $pelicula['precio_alquilar']; ?>€</button>

        <input type="hidden" name="precio_comprar" value="<?php echo $pelicula['precio_comprar']; ?>">
        <input type="hidden" name="id_pelicula" value="<?php echo $id_pelicula; ?>">
        <button type="button" onclick="alert('Para comprar este producto debe estar registrado'); window.location.href='login.html'">Comprar por <?php echo $pelicula['precio_comprar']; ?>€</button>
    </form>
    </center>
</div>

<div style="width: 45%; padding-left: 10px;">
    <center><h2>Trailer</center>
        <div style="display: flex; justify-content: center;">
            <video width="100%" height="auto" controls>
                <source src="<?php echo $pelicula['trailer']; ?>" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div><br><br>
</div>
</div>
<script src="script/script.js"></script>

    <?php endif; ?>
</body>
</html>
