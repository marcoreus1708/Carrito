<?php

include("Conexion.php");
$ruta = "../../img/Productos/";



if(isset($_POST["Enviar"]) && $_POST["Enviar"] === "Guardar"){
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $detalle = $_POST["detalle"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $nombreArchivo = $_FILES["foto"]["name"];

    $ruta = $ruta.basename($_FILES["foto"]["name"]);
    if(!(move_uploaded_file($_FILES["foto"]["tmp_name"],$ruta))){
     echo "Error al subir el archivo";
     return false;
    }

    

    if(empty($id)){
        $sql = "insert into productos(idp,nombre,marca,detalle,precio,stock,foto)
            values(null,'$nombre','$marca','$detalle','$precio','$stock','$nombreArchivo');";
    }else{
        $sql = "update productos set nombre = '$nombre', marca = '$marca', 
        detalle = '$detalle', precio = '$precio', stock = '$stock', foto = '$nombreArchivo' where idp = $id; ";
    }

            
    if($conn->query($sql)){
        echo "Datos guardados correctamente.";
    }else{
        echo "Error al guardar.";
    }

    $conn->close();

}else if(isset($_POST["Enviar"]) && $_POST["Enviar"] === "Eliminar"){
     
    $id = $_POST["id"];
    $sql = "delete from productos where idp = $id";

    if($conn->query($sql)){
        echo "Datos eliminados correctamente.";
    }else{
        echo "Error al eliminar.";
    }

    $conn->close(); 
}