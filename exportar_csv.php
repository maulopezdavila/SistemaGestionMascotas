<?php

//Cargamos lo que ocupamos
require_once 'models/Mascota.php';
require_once 'models/Dueno.php';
require_once 'models/VisitaMedica.php';


session_start();

//Verificamos si está logeado
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}


//Obtenemos las mascotas
$mascotas = $_SESSION['mascotas'] ?? [];

//Preparamos al navegador
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename = "mascotas.csv"');

//Protocolo
$output = fopen('php://output', 'w');

//Pone la primera fila
fputcsv($output, ['Nombre ', 'Espcecie ', 'Dueños ', 'Ultima Visita']);

//Recorre cada mascota
foreach($mascotas as $mascota){

    //Le asigna a cada mascota un dueño
    $duenos = implode(',',  array_map(function($d){
        return $d -> getNombre();
    }, $mascota -> getDuenos()));

    //Toma las visitas de la mascota
    $visitas = $mascota -> getVisitas();

    //Toma la ultima visita de la mascota
    if(!empty($visitas)){
        $ultima = end($visitas) ->fecha;
    } else {
        $ultima = 'Ninguna'; //Si no tiene imprime este mensaje 
    }


    //Le imprimimos los datos a la mascota 
    fputcsv ($output, [$mascota -> getNombre(), $mascota -> getEspecie(), $duenos, $ultima]);
}

//Cerramos el archivo
fclose($output);

exit;