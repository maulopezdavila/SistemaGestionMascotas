<?php

//Llamamos los archivos que ocupamos 
require_once 'models/Mascota.php';
require_once 'models/VisitaMedica.php';

//Iniciamos la sesión
session_start();

//Verificamos si está logeado
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}

//Obtenemos los datos que escribió el usuario en el formulario
$nombreMascota = trim($_POST['mascota'] ?? '');
$fecha = trim($_POST['fecha'] ?? '');
$diagnostico = trim($_POST['diagnostico'] ?? '');
$tratamiento = trim($_POST['tratamiento'] ?? '');


//Validación para que el usuario no deje campos vacios
if ($nombreMascota === '' || $fecha === '' || $diagnostico === '' || $tratamiento === '') {
    die("Error: Todos los campos de la visita son obligatorios. <a href='index.php'>Volver</a>");
}

//Patron que admitirá el nombre de la mascota  
$patronNM = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';

//Patron que admitirán fecha
$dt = DateTime::createFromFormat('Y-m-d', $fecha);
$fechaValida = $dt && $dt->format('Y-m-d') === $fecha;

//Para que solo pueda admitir fechas validas
if(!$fechaValida){
    die("Error: La fecha indicada no es valida. <a href='index.php'>Volver</a>");
}

//Satinizar diagnostico
$diagnostico = strip_tags($diagnostico);
$diagnostico = preg_replace('/[\x00-\x1F\x7F]/u', '', $diagnostico);
if(mb_strlen($diagnostico) > 2000){
    die("Error: No se admiten tantos caracteres. <a href='index.php'>Volver</a>");
}

//Satinizar tratamiento
$tratamiento = strip_tags($tratamiento);
$tratamiento = preg_replace('/[\x00-\x1F\x7F]/u', '', $tratamiento);
if(mb_strlen($tratamiento) > 2000){
    die("Error: No se admiten tantos caracteres. <a href='index.php'>Volver</a>");
}

//Creamos la visita
$visita = new VisitaMedica($fecha, $diagnostico, $tratamiento);

//Si ya existe la mascota le agregamos la visita
if(isset($_SESSION['mascotas'][$nombreMascota])){
    $_SESSION['mascotas'][$nombreMascota] -> agregarVisita($visita);
}

//Terminamos el script
header('Location: index.php');
exit;

