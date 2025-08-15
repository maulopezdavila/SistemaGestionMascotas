<?php
session_start();

//Obtenemos los datos y los limpiamos
$usuario = trim($_POST['usuario'] ?? '');
$password = trim($_POST['password'] ?? '');

//Para que no se acepten datos vacios
if ($usuario === '' || $password === '') {
    header('Location: login.php?error=' . urlencode('Por favor llene todos los campos'));
    exit;
}

//Sanitiza
$usuario = strip_tags($usuario);
$usuario = preg_replace('/[\x00-\x1F\x7F]/u', '', $usuario);

//"Crea" la sesión
$_SESSION['auth'] = [
    'logged_in' => true,
    'user' => $usuario
];

//Redirige al index
header('Location: index.php');

exit;
