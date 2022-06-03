<?php

$serverName  = "localhost";
$username="root";
$password ="";
$dbName="carrito";

$conn= new mysqli($serverName,$username,$password,$dbName);

//verificar si la conexion 
if($conn->connect_error){
    die("Error al conectar:".$conn->connect_error);
}
//echo ("Conexion exitosa");


