<?php 
$servidor="localhost"; // 127.0.0.1
$basaDeDatos="app"; // nombre de la base de datos
$usuario="root"; //nombre de usuario
$contrasena=""; // contraseña

try{
    $conexion = new PDO("mysql:host=$servidor;dbname=$basaDeDatos",$usuario, $contrasena);
}catch(Exception $ex){
    echo $ex->getMessage();
}
?> 