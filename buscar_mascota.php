<?php
require_once 'models/Mascota.php';
require_once 'models/Dueno.php';
require_once 'models/VisitaMedica.php';
session_start();

//Verificamos que este logeado
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}

//Obtenemos el nombre que escribió el usuario
$nombre = trim($_GET['nombre'] ?? '');

//Verificación que el usuario no haya dejado la barra de busqueda vacia 
if(trim($nombre) === ''){
    ?>
    <!-- html para la verificación y no que tan feo -->
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar Mascota - Veterinaria</title>
        <link rel="stylesheet" href="estilos.css">
        <script src="script.js"></script>
    </head>

    <body>
        <div class="pet-history">

            <div class="error-message">
                <h1>⚠️ Campo vacío</h1>
                <p>Por favor ingrese el nombre de una mascota.</p>
            </div>

            <div class="back-button">
                <a href="index.php" class="btn btn-primary">← Volver al inicio</a>
            </div>

        </div>
    </body>
    </html>
    <?php

    exit;
}

//Satinizar Busqueda
$nombre = strip_tags($nombre);
$nombre = preg_replace('/[\x00-\x1F\x7F]/u', '', $nombre);
if(mb_strlen($nombre) > 50){
    die("Error: No se admiten tantos caracteres. <a href='index.php'>Volver</a>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Mascota - Veterinaria</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="script.js"></script>
</head>
<body>

    <div class="pet-history">
        
        <?php
        //Verifica si existe una mascota con el nombre que ingreso el usuario
        if(isset($_SESSION['mascotas'][$nombre])){
            $mascota = $_SESSION['mascotas'][$nombre];
        ?>
            <h1>🐾 Historial de <?php echo htmlspecialchars($mascota->getNombre()); ?></h1>
            
            <div class="info-card">
                <h2 class="collapsible">👤 Dueños</h2>

                <div class="panel-content">
                    <?php
                    //Obtenemos los dueños de la mascota
                    $duenos = $mascota->getDuenos();

                    //Mostramos los dueños de la mascota (Si tiene)
                    if(!empty($duenos)){

                        foreach($duenos as $d){
                            echo "<div class='owner-info'>";
                            echo "<strong>Nombre:</strong> " . htmlspecialchars($d->getNombre()) . "<br>"; 
                            echo "<strong>Teléfono:</strong> " . htmlspecialchars($d->getTelefono());
                            echo "</div>";
                        }

                    } else { //Si no tiene dueños mostramos un mensaje
                        echo "<p class='no-data'>Ninguno registrado</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="info-card">
                <h2 class="collapsible">🏥 Visitas Médicas</h2>
                <div class="panel-content">
                    <?php
                    //Obtenemos las visitas de la mascota
                    $visitas = $mascota->getVisitas();

                    //Verificamos si tiene visitas
                    if(!empty($visitas)){

                        foreach($visitas as $visita){
                            echo "<div class='visit-info'>";
                            echo "<strong>Fecha:</strong> " . htmlspecialchars($visita->fecha) . "<br>";
                            echo "<strong>Diagnóstico:</strong> " . htmlspecialchars($visita->diagnostico) . "<br>";
                            echo "<strong>Tratamiento:</strong> " . htmlspecialchars($visita->tratamiento);
                            echo "</div>";
                        }

                    } else { //Si no tiene visitas registradas
                        echo "<p class='no-data'>No hay visitas registradas para esta mascota.</p>";
                    }
                    ?>
                </div>
            </div>

        <?php


        } else { //Si no encontramos a la mascota 
            echo "<div class='error-message'>";
            echo "<h1>❌ Mascota no encontrada</h1>";
            echo "<p>Esta mascota no existe en nuestros registros.</p>";
            echo "</div>";
        }
        ?>
        
        <!-- Botón para regresar el menu -->
        <div class="back-button">
            <a href="index.php" class="btn btn-primary">← Volver al inicio</a>
        </div>

    </div>
</body>
</html>
