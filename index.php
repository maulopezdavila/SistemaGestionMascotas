<?php

//PROBRAR USE
require_once 'models/Mascota.php';
require_once 'models/Dueno.php';
require_once 'models/VisitaMedica.php';

session_start();

// Si no está logueado, redirige al login
if (empty($_SESSION['auth']['logged_in'])) {
    header('Location: login.php');
    exit;
}

?>

<!---->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Veterinaria</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="script.js"></script>
</head>
<body>
<div class="container">
<h1>Sistema de Gestión de Mascotas</h1>

<p>Usuario: <?php echo htmlspecialchars($_SESSION['auth']['user'] ?? ''); ?> — <a href="logout.php">Cerrar sesión</a></p>

<!-- Buscar Mascota -->
<h2>Buscar Mascota</h2>
<form action="buscar_mascota.php" method="GET">
    <label for="nombre">Nombre de la mascota:</label>
    <input type="text" id="nombre" name="nombre"><br>
    <input type="submit" value="Buscar">
</form>

<!-- Formulario para registrar a una mascota -->
<h2>Registrar Mascota</h2>
<div class="panel-content">
<form action="procesar_mascota.php" method="POST">
    <label for="nombre_m">Nombre:</label>
    <input type="text" id="nombre_m" name="nombre"><br>
    <label for="especie">Especie:</label>
    <input type="text" id="especie" name="especie"><br>
    <input type="submit" value="Registrar Mascota">
</form>
</div>

<!-- Formulario para registrar a un dueño -->
<h2>Registrar Dueño</h2>
<div class="panel-content">
<form action="procesar_dueno.php" method="POST">
    <label for="nombre_d">Nombre:</label>
    <input type="text" id="nombre_d" name="nombre"><br>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono"><br>
    <label for="mascota_d">Mascota (nombre):</label>
    <input type="text" id="mascota_d" name="mascota"><br>
    <input type="submit" value="Registrar Dueño">
</form>
</div>

<!-- Formulario para registrar una visita médica -->
<h2>Registrar Visita Médica</h2>
<div class="panel-content">
<form action="procesar_visita.php" method="POST">
    <label for="mascota_v">Mascota (nombre):</label>
    <input type="text" id="mascota_v" name="mascota"><br>
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha"><br>
    <label for="diagnostico">Diagnóstico:</label>
    <input type="text" id="diagnostico" name="diagnostico"><br>
    <label for="tratamiento">Tratamiento:</label>
    <input type="text" id="tratamiento" name="tratamiento"><br>
    <input type="submit" value="Registrar Visita">
</form>
</div>


<!-- Tabla con la iformación de las mascotas -->
<h2>Listado de Mascotas</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Especie</th>
        <th>Dueños</th>
        <th>Última Visita</th>
    </tr>

    <!-- Script que actualiza la información -->
    <?php
    
    //Detecta que el array ['mascotas'] ya exista
    if(isset($_SESSION['mascotas'])){

        //Recorre cada elemento de ['mascotas] y cada $mascota es un objeto que se va a listar
        foreach ($_SESSION['mascotas'] as $mascota){

            // Devuelve el nombre del dueño
            $duenos = array_map(function($d){
                return $d->getNombre();
            }, $mascota->getDuenos()); //Le asigna a la mascota el dueño correspondiente
            //AQUI HAY UN ERROR Y NI DIOS SABE PORQUE 
            
            //Devuelve las visitas de la mascota
            $visitas = $mascota->getVisitas();

            //Si hay visitas devuelve la ultima visita
            if(!empty($visitas)){
                $ultimaVisita = end($visitas) -> fecha;
            } else{ //De lo contrario dice que no se ha hecho ninguna visita
                $ultimaVisita = 'Ninguna';
            }

            //Imprime la tabla
            echo "<tr>";
            echo "<td>" . $mascota->getNombre()  . "</td>";
            echo "<td>" . $mascota->getEspecie()  . "</td>";
            echo "<td>" . implode(', ', $duenos) . "</td>";
            echo "<td>" . $ultimaVisita         . "</td>";
            echo "</tr>";
        }
    }

    
    ?>

</table>

<!-- botón para exportar CSV -->
<form action="exportar_csv.php" method="POST">
    <br>
    <input type="submit" value="Exportar a CSV">
    
</form>

</div>
</body>
</html>
