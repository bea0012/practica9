<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "servidor";

try {
    // Crear conexión utilizando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    // Habilitar el manejo de errores de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recuperar los valores del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $profesion = $_POST["profesion"];
    $pais = $_POST["pais"];

    // Preparar la consulta SQL utilizando prepared statements
    $stmt = $conn->prepare("INSERT INTO tabla1 (nombre, apellido, profesion, pais) VALUES (:nombre, :apellido, :profesion, :pais)");
    
    // Bind de parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':profesion', $profesion, PDO::PARAM_STR);
    $stmt->bindParam(':pais', $pais, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir a la página de inicio después de guardar los datos
    header("Location: inicio.php");
    exit();
} catch (PDOException $e) {
    // Manejo de errores de PDO
    echo "Error al guardar los datos: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
    $stmt = null;
}

?>
