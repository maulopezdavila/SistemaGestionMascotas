<?php

session_start();

//Si ya está logeado lo manda al index
if (!empty($_SESSION['auth']['logged_in'])) {
    header('Location: index.php');
    exit;
}

//Muestra un mensaje de error si falla algo
$error = $_GET['error'] ?? '';


?>

<!-- Formulario del login -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="estilos.css">
</head>

<body>
<div class="login-container">
<h1>Login</h1>

<?php if ($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>

<form action="procesar_login.php" method="POST">
  <input name="usuario" placeholder="usuario">
  <input name="password" type="password" placeholder="contraseña">
  <input type="submit" value="Entrar">
</form>

</div>
</body>
</html>
