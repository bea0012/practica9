    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // verifica si se ha enviado el formulario
        
        $username = $_POST["username"]; //recupera los valores del formulario
        $password = $_POST["password"];
    
        
        if ($username == "usuario" && $password == "1234") { // verifica las credenciales 
            header("Location: inicio.php"); // si son credenciales válidas, redirige a la página de inicio.php
            exit();
        } else {
            
            $error_message = "Usuario o contraseña incorrectos"; // muestra un mensaje de error si las credenciales son incorrectas
        }
    }

    if (isset($error_message)) { // muestra el mensaje de error si existe
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Document</title>
            <link rel='stylesheet' type='text/css' href='styles/login.css'>
        </head>
        <body>
            <div class='titulo'>
            <h2>Iniciar sesión</h2>
            </div>
        
            <form action='login.php' method='post'>
                <p style='color: red;'>" . $error_message . "</p>
        
                <label for='username'>Usuario:</label>
                <input type='text' id='username' name='username' required>
        
                <br>
        
                <label for='password'>Contraseña:</label>
                <input type='password' id='password' name='password' required>
        
                <br>
        
                <input type='submit' value='Iniciar sesión'>
            </form>
        
        </body>
        </html>";
    }
    ?>
