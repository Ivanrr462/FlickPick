<?php
session_start();
$usuario = "";

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}

$conn = mysqli_connect("flickpick_bdd:3306", "root", "", "FlickPick");

if (!$conn) {
    die("error en la conexion");
}

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
    <link rel="stylesheet" href="styles/forms.css">
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
                            <td><a href="genero.php?genero=Romance">Romance</a></td>
                            <td><a href="genero.php?genero=Accion">Acción</a></td>
                            <td><a href="genero.php?genero=Terror">Terror</a></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="genero.php?genero=Aventura">Aventura</a></td>
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
            <b>FORMULARIO DE PAGO</b>
        </center>
        <center>
        <table>
            <form name="forml" action="anadir_saldo.php" method="post">
                <tr><td><b>NOMBRE COMPLETO:</td><td><input type="text" name="nom" id="nom" required></td><td></td></tr>
                <tr><td><b>DOMICILIO:</td><td><input type="text" name="domicilio" id="domicilio" required></td><td></td></tr>
                <tr><td><b>PROVINCIA:</b></td><td><label for="Provincias"></label><select name="Provincias" id="Provincias">
                    <option value=""></option>
                    <option value="Álava">Álava</option>
                    <option value="Albacete">Albacete</option>
                    <option value="Alicante">Alicante</option>
                    <option value="Almería">Almería</option>
                    <option value="Asturias">Asturias</option>
                    <option value="Ávila">Ávila</option>
                    <option value="Badajoz">Badajoz</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Burgos">Burgos</option>
                    <option value="Cáceres">Cáceres</option>
                    <option value="Cádiz">Cádiz</option>
                    <option value="Cantabria">Cantabria</option>
                    <option value="Castellón">Castellón</option>
                    <option value="Ciudad Real">Ciudad Real</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Cuenca">Cuenca</option>
                    <option value="Gerona">Gerona</option>
                    <option value="Granada">Granada</option>
                    <option value="Guadalajara">Guadalajara</option>
                    <option value="Guipúzcoa">Guipúzcoa</option>
                    <option value="Huelva">Huelva</option>
                    <option value="Huesca">Huesca</option>
                    <option value="Jaén">Jaén</option>
                    <option value="La Coruña">La Coruña</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="Las Palmas">Las Palmas</option>
                    <option value="León">León</option>
                    <option value="Lérida">Lérida</option>
                    <option value="Lugo">Lugo</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Málaga">Málaga</option>
                    <option value="Murcia">Murcia</option>
                    <option value="Navarra">Navarra</option>
                    <option value="Orense">Orense</option>
                    <option value="Palencia">Palencia</option>
                    <option value="Pontevedra">Pontevedra</option>
                    <option value="Salamanca">Salamanca</option>
                    <option value="Segovia">Segovia</option>
                    <option value="Sevilla">Sevilla</option>
                    <option value="Soria">Soria</option>
                    <option value="Tarragona">Tarragona</option>
                    <option value="Tenerife">Tenerife</option>
                    <option value="Teruel">Teruel</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Valladolid">Valladolid</option>
                    <option value="Vizcaya">Vizcaya</option>
                    <option value="Zamora">Zamora</option>
                    <option value="Zaragoza">Zaragoza</option>
                </select></td></tr>
                <tr><td><b>ELIGE UN MÉTODO DE PAGO</td></tr>
                <tr><td><input type="radio" id="tarjeta" name="pago" value="Tarjeta" onclick="mostrar('tarjeta')"><label for="tarjeta"> Tarjeta</label></td></tr>
                <tr id="datosTarjeta1" style="display:none;">
                    <td><label for="numeroTarjeta">Número de tarjeta: </label></td><td><input type="text" id="numeroTarjeta" name="numeroTarjeta"></td>
                </tr>
                <tr id="datosTarjeta2" style="display:none;">
                    <td><label for="fechaCaducidad">Fecha de Caducidad: </label></td><td><input type="month" id="fechaCaducidad" name="fechaCaducidad"></td>
                </tr>
                <tr id="datosTarjeta3" style="display:none;">
                    <td><label for="cvc">CVC:  </label></td><td><input type="number" id="cvc" name="cvc"></td>
                </tr>
                <tr id="datosTarjeta4" style="display:none;">
                    <td><label for="valor">Valor:  </label></td><td><input type="number" id="valor" name="valor"></td>
                </tr>
                <tr><td><input type="radio" id="codigo" name="pago" value="Código Promocional" onclick="mostrar('codigo')"><label for="codigo"> Código Promocional</label></td></tr>
                <tr id="datosCodigo" style="display:none;">
                    <td><label for="codigoPromocional">Código promocional:</label></td><td><input type="text" id="codigoPromocional" name="codigoPromocional"></td>
                </tr>


            <script>
            function mostrar(opcion) {
                var i;
                for (i = 1; i <= 4; i++) {
                    if (opcion == 'tarjeta') {
                        document.getElementById('datosTarjeta' + i).style.display = '';
                    } else {
                        document.getElementById('datosTarjeta' + i).style.display = 'none';
                    }
                    }
                    if (opcion == 'codigo') {
                        document.getElementById('datosCodigo').style.display = '';
                    } else {
                        document.getElementById('datosCodigo').style.display = 'none';
                    }
                }

            </script>
                <tr><td width="40%">CONDICIONES</td><td></td></tr>
                <tr><td colspan="2" align="center"><textarea rows="15" cols="100">
**Términos y Condiciones del Servicio de Videoclub Online**

1. **Aceptación de los Términos**: Al utilizar nuestro servicio de Videoclub Online, aceptas estos términos y condiciones en su totalidad. Si no estás de acuerdo con estos términos y condiciones o cualquier parte de estos términos y condiciones, no debes utilizar este servicio.

2. **Edad mínima**: Debes tener al menos 18 años para utilizar nuestro servicio. Al utilizar nuestro servicio y al aceptar estos términos y condiciones, garantizas y declaras que tienes al menos 18 años.

3. **Licencia para usar el servicio**: Te proporcionamos una licencia para ver las películas y series disponibles en nuestro servicio para uso personal y no comercial.

4. **Restricciones de uso**: No está permitido el uso de nuestro servicio de ninguna manera que cause, o pueda causar, daño al servicio o deterioro de la disponibilidad o accesibilidad del servicio.

5. **Pagos**: Todos los pagos son finales y no reembolsables después de la compra, a menos que lo exija la ley aplicable en tu jurisdicción.

6. **Cambios en el servicio**: Nos reservamos el derecho de modificar o descontinuar, temporal o permanentemente, el servicio con o sin previo aviso.

7. **Limitación de responsabilidad**: En ningún caso seremos responsables ante ti o cualquier tercero por cualquier daño indirecto, consecuente, ejemplar, incidental, especial o punitivo.

Al hacer clic en "Aceptar", reconoces que has leído y comprendido los términos y condiciones anteriores.
                </textarea></td><td></td></tr>
                <tr><td colspan="2"><center><input type="checkbox" id="cbox1" required>Acepto las condiciones</center></td><td></td></tr>
                <tr><td colspan="2"><center><input type="submit" value="Enviar"/></center></td><td></td></tr>
            </form>
        </table>
        </center>
    </body>

</html>