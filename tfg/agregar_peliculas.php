<?php
session_start();
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
    <link rel="stylesheet" href="styles/peliculas.css">
</head>
<body>
<header>
    <nav>
        <div class="junto">
            <a href="admin.php"><img src="imagenes/favicon.png" width="50px" height="50px"></a>
            <h4>FlickPick</h4>
        </div>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="agregar_peliculas.php">Nueva Película</a></li>
            <li><a href="codigos.php">Códigos Promocionales</a></li>
            <li>
                <div class="dropdown">
                    <img src="imagenes/usuario.png" width="25px" height="25px">
                    <div class="dropdown-content">
                        <p><a href="logout.php">Salir</a></p>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>
<center>
<form action="manejador2.php" method="post">
    <h3>Datos de la pelicula</h3>
    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo"><br>
    <label for="descripcion">Descripción:</label><br>
    <input type="text" id="descripcion" name="descripcion"><br>
    <label for="ano">Año:</label><br>
    <input type="text" id="ano" name="ano"><br>
    <label for="descripcion">Genero:</label><br>
    <select name="genero" style="margin: 5px 0px 5px 0px;width:300px;">
        <option value=""></option>
        <option value="Ciencia Ficción">Ciencia Ficcion</option>
        <option value="Fantasia">Fantasia</option>
        <option value="Comedia">Comedia</option>
        <option value="Romance">Romance</option>
        <option value="Accion">Accion</option>
        <option value="Terror">Terror</option>
        <option value="Aventura">Aventura</option>
        </select>
    <label for="autor">Autor:</label><br>
    <input type="text" id="autor" name="autor"><br>
    <label for="precio_alquilar">Precio Alquilar:</label><br>
    <input type="text" id="precio_alquilar" name="precio_alquilar"><br>
    <label for="precio_comprar">Precio Comprar:</label><br>
    <input type="text" id="precio_comprar" name="precio_comprar"><br>
    <input type="submit" value="Submit">
</form>
<form action="manejador1.php" method="post">
    <h3>Ficheros de la pelicula</h3>
    <b>(Recuerda que antes debes ingresar los ficheros en la carpeta uploads y aqui poner la ruta a esa carpeta, asique pon los nombre faciles)</b>
    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo"><br>
    <label for="trailer">Trailer:</label><br>
    <input type="text" id="trailer" name="trailer"><br>
    <label for="video">Video:</label><br>
    <input type="text" id="video" name="video"><br>
    <label for="baner">Baner:</label><br>
    <input type="text" id="baner" name="baner"><br>
    <label for="cartel">Cartel:</label><br>
    <input type="text" id="cartel" name="cartel"><br>
    <input type="submit" value="Submit">
</form>


</center>
</body>
</html>

