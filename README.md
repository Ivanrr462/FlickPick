# 🎬 FlickPick: Tu Videoclub Online

¡Bienvenido a **FlickPick**!  
Este proyecto es un videoclub online desarrollado como Trabajo de Fin de Grado para Administración de Sistemas Informáticos en Red. FlickPick permite a los usuarios alquilar, comprar, ver y calificar películas, gestionar su perfil y saldo, y mucho más, todo desde una interfaz web moderna y sencilla.

---

## 🚀 ¿Qué es FlickPick?

FlickPick es una plataforma web donde los usuarios pueden:

- **Explorar** un catálogo de películas por género, novedades y mejor valoradas.
- **Alquilar o comprar** películas con saldo virtual.
- **Ver trailers** y películas completas (streaming o descarga según el modo de adquisición).
- **Calificar** películas y ver la media de valoraciones.
- **Gestionar su perfil**: cambiar foto, correo, contraseña y borrar la cuenta.
- **Recargar saldo** mediante tarjeta o códigos promocionales.
- **Administrar** el catálogo y estadísticas (modo admin).

---

## 🗂️ Estructura del Proyecto

- `tfg/`
  - **Frontend y Backend principal**: Archivos PHP, HTML, JS y CSS.
  - **Gestión de usuarios**: Registro, login, perfil, biblioteca, saldo.
  - **Gestión de películas**: Añadir, editar, ver, alquilar, comprar.
  - **Admin**: Panel de control, estadísticas y gestión de códigos promocionales.
  - **Imágenes y vídeos**: Carpeta `fotos_perfil/` y rutas para trailers/carteles.
- `README.md`, `Manual FlickPick.pdf`, `Documentacion Flickpick.pdf`: Documentación y manual de usuario.

---

## 🖥️ Funcionalidades Principales

### 👤 Usuarios

- **Registro/Login**: [registrar.html](tfg/registrar.html), [login.html](tfg/login.html), [registrarse.php](tfg/registrarse.php), [login.php](tfg/login.php)
- **Perfil**: Cambia tu foto ([actualizar_foto_perfil.php](tfg/actualizar_foto_perfil.php)), datos y contraseña ([actualizar_perfil.php](tfg/actualizar_perfil.php)), o elimina tu cuenta ([borrar_cuenta.php](tfg/borrar_cuenta.php))
- **Biblioteca**: Accede a tus películas adquiridas o alquiladas ([biblioteca.php](tfg/biblioteca.php))

### 🎥 Películas

- **Catálogo**: Navega por géneros ([genero.php](tfg/genero.php)), novedades y mejor valoradas ([index.php](tfg/index.php), [peliculas.php](tfg/peliculas.php))
- **Ver película**: Detalles, trailer, valoración y compra/alquiler ([ver_pelicula.php](tfg/ver_pelicula.php))
- **Reproducción/Descarga**: Acceso según modo ([pelicula.php](tfg/pelicula.php))

### 💸 Saldo y Pagos

- **Recarga**: Mediante tarjeta o código promocional ([pago.php](tfg/pago.php), [anadir_saldo.php](tfg/anadir_saldo.php))
- **Códigos promocionales**: Generación y uso ([codigos.php](tfg/codigos.php), [codigo_promo.php](tfg/codigo_promo.php))

### ⭐ Valoraciones

- **Califica películas**: Guarda tu puntuación ([guardar_calificacion.php](tfg/guardar_calificacion.php)), visualiza la media.

### 🛠️ Administración

- **Panel admin**: Estadísticas de ventas/alquileres ([admin.php](tfg/admin.php)), añadir películas ([agregar_peliculas.php](tfg/agregar_peliculas.php)), gestión de archivos ([manejador1.php](tfg/manejador1.php), [manejador2.php](tfg/manejador2.php)), códigos promocionales.

---

## 📦 Instalación y Puesta en Marcha

1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/Ivanrr462/FlickPick.git
   cd FlickPick
   ```
   Si usas XAMPP, copia la carpeta a `C:\xampp\htdocs\FlickPick`.

2. **Configura la base de datos**:
   - Abre phpMyAdmin o tu gestor MySQL favorito.
   - Importa el archivo `database.sql` incluido en el repositorio:
     1. Selecciona "Importar" y sube `database.sql`.
     2. Esto creará la base de datos y todas las tablas necesarias automáticamente.
   - Ajusta los datos de conexión en los archivos PHP si es necesario:
     ```php
     // ...en config.php o similar...
     $host = 'localhost';
     $user = 'root';
     $pass = '';
     $db   = 'FlickPick';
     ```

3. **Sube los archivos multimedia** a las carpetas correspondientes (`uploads/`, `fotos_perfil/`, etc.).
   - Si no existen, créalas:
     ```bash
     mkdir uploads fotos_perfil
     ```
   - Da permisos de escritura si es necesario:
     ```bash
     # En Windows, asegúrate de que el usuario de Apache tenga permisos
     # En Linux:
     chmod 777 uploads fotos_perfil
     ```

4. **Accede a la web** desde tu navegador:
   ```
   http://localhost/FlickPick/
   ```
   ¡Empieza a disfrutar de FlickPick!

---

## 📚 Documentación

- **Manual de usuario**: Manual FlickPick.pdf
- **Documentación técnica**: Documentacion Flickpick.pdf

---

## 📝 Créditos

Desarrollado por [Iván Ríos](https://github.com/Ivanrr462) como TFG para ASIR.  
¡Gracias por probar FlickPick!

---

## 🛡️ Notas de Seguridad

- Este proyecto es académico y no debe usarse en producción sin revisar la seguridad (SQL Injection, XSS, gestión de sesiones, etc.).
- Las contraseñas se almacenan con MD5 (no recomendado en producción).

---

## 📬 Contacto

¿Dudas o sugerencias? Consulta el manual o contacta conmigo.

---

¡Disfruta del cine en casa con FlickPick! 🍿