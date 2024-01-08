<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "servidor";

$conn = new mysqli($servername, $username, $password, $database); // crea la conexión


if ($conn->connect_error) { // verifica si la conexión es correcta
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$profesion = $_POST["profesion"];
$pais = $_POST["pais"];

// actualiza los datos en la base de datos
$sql = "UPDATE tabla1 SET nombre='$nombre', apellido='$apellido', profesion='$profesion', pais='$pais' WHERE id=$id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $apellido, $profesion, $pais, $id);

if ($stmt->execute()) { // si el statement se ejecuta te redirige a inicio.php
    header("Location: inicio.php");
} else {
    echo "Error al guardar los cambios: " . $stmt->error;
}

$stmt->close(); // cierra el statement
$conn->close(); //cierra la conexión
?>
