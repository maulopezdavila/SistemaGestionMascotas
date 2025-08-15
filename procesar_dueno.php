<?php
//Traemos los archivos que ocupamos
require_once 'models/Dueno.php';
require_once 'models/Mascota.php';

//Iniciamos la sesión
session_start();

//Verificamos si está logeado
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}

//Obtenemos lo que escribió el usuario en el fomulario
$nombre = trim($_POST['nombre'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$nombreMascota = trim($_POST['mascota'] ?? '');

// Validación para que el usuario no deje campos vacios
if ($nombre === '' || $telefono === '' || $nombreMascota === '') {
    die("Error: Por favor completa los campos faltantes. <a href='index.php'>Volver</a>");
}

//Patron que admitirá $nombre y $nombreMascota
$patronNyM = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/';
//Patron que admitirá telefono
$patronTelefono = '/^[0-9]+$/';

//Validaciones para nombre y el nombre de la mascota
if (!preg_match($patronNyM, $nombre)) {
    die("Error: El nombre solo puede contener letras y espacios. <a href='index.php'>Volver</a>");
}

if (!preg_match($patronNyM, $nombreMascota)) {
    die("Error: El nombre de la mascota solo puede contener letras y espacios. <a href='index.php'>Volver</a>");
}

//Validación para el telefono
if (!preg_match($patronTelefono, $telefono)) {
    die("Error: El telefono solo puede contener digitos. <a href='index.php'>Volver</a>");
}

//Creamos al dueño de la mascota
$dueno = new Dueno($nombre, $telefono);

//Si existe la mascota en el registro, le agregamos el dueño.
if(isset($_SESSION['mascotas'][$nombreMascota])){
    $_SESSION['mascotas'][$nombreMascota] -> agregarDueno($dueno);
}

//Terminamos el script
header('Location: index.php');
exit;