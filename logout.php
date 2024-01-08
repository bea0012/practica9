<?php
session_start();

$_SESSION = array(); // destruye las variables de sesión

session_destroy(); // destruye la sesión

header("Location: login.html"); // redirige a la página de login
exit;
?>
