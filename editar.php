<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="styles/inicio.css">
</head>
<body>
    <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "servidor";

        $conn = new mysqli($servername, $username, $password, $database);  // crea la conexión conexión

        
        if ($conn->connect_error) { // verifica si la conexión es correcta
            die("Conexión fallida: " . $conn->connect_error);
        }

        $id = $_GET["id"]; // obtiene el ID de la URL

        $sqlConsulta = "SELECT id, nombre, apellido, profesion, pais FROM tabla1 WHERE id = $id"; // consulta para obtener los datos del registro específico
        $stmt = $conn->prepare($sqlConsulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultConsulta = $stmt->get_result();

        if ($resultConsulta->num_rows > 0) { // verifica si se encontró el registro
            $row = $resultConsulta->fetch_assoc();
    ?>
    
            <h2>Editar Información</h2> <!--creo el formulario donde cambiare los datos de la fila seleccionada con x id-->
            <form action="guardar_edicion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id=
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $row["apellido"]; ?>" required>
                <br>
                <label for="profesion">Profesión:</label>
                <input type="text" id="profesion" name="profesion" value="<?php echo $row["profesion"]; ?>" required>
                <br>
                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" value="<?php echo $row["pais"]; ?>" required>
                <br>
                <input type="submit" value="Guardar Cambios">
            </form>
    <?php
        } else {
            echo "<p>No se encontró el registro con el ID proporcionado.</p>"; //error por si no se encuentra el id
        }

        $stmt->close(); // cierra el statement
        $conn->close(); //cierra la conexión
    ?>
</body>
</html>
