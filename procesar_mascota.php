<?php

require_once 'models/Mascota.php';

session_start();

//Verificamos si está logeado
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}

//Si aun no existe el array de mascotas, lo inicializamos como un array vacío
if (!isset($_SESSION['mascotas'])){
    $_SESSION['mascotas'] = [];
}

//Obtenemos los datos que envio el fomrulario
$nombre = trim($_POST['nombre'] ?? '');
$especie = trim($_POST['especie'] ?? '');

//Validación para que el usuario no pueda poner datos vacios
if ($nombre === '' || $especie === '') {
    die("Error: Completa el otro campo por favor. <a href='index.php'>Volver</a>");
}

// $patron = no admitirá ni números ni caracteres especiales 
$patron = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/';

//Validación para que el usuario no pueda poner ni números ni caracteres especiales
if (!preg_match($patron, $nombre)) {
    die("Error: El nombre solo puede contener letras y espacios. <a href='index.php'>Volver</a>");
}

if (!preg_match($patron, $especie)) {
    die("Error: La especie solo puede contener letras y espacios. <a href='index.php'>Volver</a>");
}

//Creamos la mascota 
$mascota = new Mascota($nombre, $especie);

//Guardamos
$_SESSION['mascotas'][$nombre]=$mascota;

//Terminamos el script
header('Location: index.php');
exit;