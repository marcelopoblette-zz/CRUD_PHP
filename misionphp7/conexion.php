<!-- Conexi??n a la base de datos,
codificaci??n de caracteres,
seleccion de base de datos. -->
<?php

$server = "localhost";
$user =  "root";
$pasword = "";
$bd = "gestion_bodega";
$mysqli =mysqli_connect($server, $user, $pasword, $bd);
$mysqli->set_charset("utf8");
if (!$mysqli) {
    # code...
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuraci�n: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuraci�n: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "�xito: Se realiz� una conexi�n Exitosa a MySQL! <br>Se ha conectado con la Base de Datos! ". PHP_EOL;


?>
