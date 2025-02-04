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
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        #promo-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            margin: 20px 0;
        }

        #promo-form h4 {
            color: #333;
        }

        #promo-form label {
            font-weight: bold;
            display: block;
            margin-top: 20px;
        }

        #promo-form input[type="text"], #promo-form select {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 30%;
        }

        #promo-form button, #promo-form input[type="submit"] {
            background-color: #0099ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
        }

        #promo-form button:hover, #promo-form input[type="submit"]:hover {
            background-color: #007acc;
        }
    </style>
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
                <li><div class="dropdown">
                    <img src="imagenes/usuario.png" width="25px" height="25px">
                    <div class="dropdown-content">
                        <p><a href="logout.php">Salir</a></p>
                    </div>
                </div></li>
            </ul>
        </nav>
    </header>
    <center>
    <div class="container">
        <form id="promo-form" action="codigo_promo.php" method="post" enctype="multipart/form-data">
            <h4>Crear nuevo codigo promocional:</h4>
            <label for="titulo">Código:</label>
            <input type="text" id="codigo" name="titulo" required>
            <button type="button" onclick="generarCodigo()">Generar Código</button>
            <label for="desc">Valor:</label>
            <select name="desc">
                <option value="5">5€</option>
                <option value="10">10€</option>
                <option value="15">15€</option>
                <option value="20">20€</option>
                <option value="25">25€</option>
                <option value="50">50€</option>
                <option value="100">100€</option>
            </select><br>
            <input type="submit" value="Generar código" name="submit">
        </form>
    </div>

    <script>
        function generarCodigo() {
            document.getElementById('codigo').value = Math.random().toString(36).substring(2, 9);
        }
    </script>
</body>
</html>