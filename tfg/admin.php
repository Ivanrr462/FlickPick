<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$consulta_vendidas = "SELECT COUNT(*) as total FROM peliculas_adquiridas WHERE modo = 'c'";
$resultado_vendidas = $conn->query($consulta_vendidas);
$fila_vendidas = $resultado_vendidas->fetch_assoc();
$total_vendidas = $fila_vendidas['total'];

$consulta_alquiladas = "SELECT COUNT(*) as total FROM peliculas_adquiridas WHERE modo = 'a'";
$resultado_alquiladas = $conn->query($consulta_alquiladas);
$fila_alquiladas = $resultado_alquiladas->fetch_assoc();
$total_alquiladas = $fila_alquiladas['total'];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #myChart {
            width: 50%;  /* Cambia esto al tamaño que desees */
            height: 50%; /* Cambia esto al tamaño que desees */
            margin: auto;
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
                <li><a href="http://192.168.1.127">AWX</a></li>
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
    <div style="margin-top: 20px; padding: 10px;">
        <h2>Estadísticas de las peliculas</h2>
        <canvas id="myChart"></canvas>
    </div>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Vendidas', 'Alquiladas'],
            datasets: [{
                label: '# de Películas',
                data: [<?php echo $total_vendidas; ?>, <?php echo $total_alquiladas; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    </center><br><br>
    <?php
    $conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }
    echo "<h3>Peliculas añadidas recientemente</h3>";
    $consulta2 = "SELECT * FROM peliculas order by id desc limit 7";
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
            echo '</tr>'; 
        }
    }
    
    echo '</table><br><br>';
    ?>
</body>
</html>