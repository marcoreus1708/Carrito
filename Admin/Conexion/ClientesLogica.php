<?php

include("Conexion.php");




if(isset($_POST["Enviar"]) && $_POST["Enviar"] === "Guardar"){
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha = $_POST["fecha"];
    $detalle = $_POST["detalle"];
    

    

    if(empty($id)){
        $sql = "insert into clientes(idc,nombre,apellido,fnacimiento,detalle)
            values(null,'$nombre','$apellido','$fecha','$detalle');";
    }else{
        $sql = "update clientes set nombre = '$nombre', apellido = '$apellido', 
        fnacimiento = '$fecha', detalle = '$detalle' where idc = $id; ";
    }

            
    if($conn->query($sql)){
        echo "Datos guardados correctamente.";
    }else{
        echo "Error al guardar.";
    }

    $conn->close();

}else if(isset($_POST["Enviar"]) && $_POST["Enviar"] === "Eliminar"){
     
    $id = $_POST["id"];
    $sql = "delete from clientes where idc = $id";

    if($conn->query($sql)){
        echo "Datos eliminados correctamente.";
    }else{
        echo "Error al eliminar.";
    }

    $conn->close(); 
}