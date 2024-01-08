<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "servidor";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verifica si se ha enviado el ID para eliminar
if (isset($_GET['id'])) {
    $idEliminar = $_GET['id'];

    // Elimina el registro de la base de datos
    $sqlEliminar = "DELETE FROM tabla1 WHERE id = $idEliminar";

    if ($conn->query($sqlEliminar) !== TRUE) {
        echo "Error al eliminar el registro: " . $conn->error;
    } else {
        header("Location: inicio.php");
        exit();
    }
} else {
    echo "ID no proporcionado para eliminar.";
}

$conn->close();
?>
