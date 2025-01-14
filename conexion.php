<?php 

$host = 'localhost';
$BaseDeDatos = 'LunovaSolutionsLu';
$user = 'root';
$pass = '';

try{
    $conexion= new PDO("mysql:host=$host;dbname=$BaseDeDatos",$user,$pass);
}catch(Exeption $ex	)
{
    echo  $ex->getMessage();
}
?>