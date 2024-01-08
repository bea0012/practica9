<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="styles/inicio.css">

</head>
<body>
    <h2>Bienvenido a la página de inicio</h2>

    <form action="datos.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>
        <label for="profesion">Profesión:</label>
        <input type="text" id="profesion" name="profesion" required>
        <br>
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" required>
        <br>
        <input type="submit" value="Guardar">
    </form>

    <br>

    <h3>Datos guardados:</h3>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Profesión</th>
            <th>País</th>
            <th>Registro</th>
            <th></th>
            <th></th>
        </tr>

    <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "servidor";

        $conn = new mysqli($servername, $username, $password, $database); // crea la conexión

        if ($conn->connect_error) { // verifica la conexión
            die("Conexión fallida: " . $conn->connect_error);
        }

        // consulta para obtener los datos de la base de datos
        $sqlConsulta = "SELECT id, nombre, apellido, profesion, pais, registro FROM tabla1";
        $stmt = $conn->prepare($sqlConsulta);
        $stmt->execute();
        $resultConsulta = $stmt->get_result();
        
        if ($resultConsulta->num_rows > 0) { //con el resultado de la consulta crea una linea con los datos que se introducen para mostrarlos
            while ($row = $resultConsulta->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["profesion"] . "</td>";
                echo "<td>" . $row["pais"] . "</td>";
                echo "<td>" . $row["registro"] . "</td>";
                echo "<td><a href='eliminar.php?id=" . $row["id"] . "'>Eliminar</a></td>";
                echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay datos guardados.</td></tr>"; //si no hay datos en la base de datos se muestra el mensaje de no hay datos guardados
        }
    ?>

    </table>
    <br>
    <a href="logout.php">Cerrar sesión</a> <!-- te manda al log out que te manda al login-->

</body>
</html>

<?php
    $stmt->close(); // cierra el statement
    $conn->close(); //cierra la conexión
?>
