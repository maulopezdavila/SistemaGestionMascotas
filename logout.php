<?php

session_start();

//Eliminamos la sesión, aunque solo es realmente el nombre 
unset($_SESSION['auth']);

//Redirige al login
header('Location: login.php');

exit;
