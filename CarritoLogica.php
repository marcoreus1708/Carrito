<?php
include("Admin/Conexion/Conexion.php");
include("Plantillas/Encabezado.php");
session_start();
$validar=true;
$subTotal = 0;
$IVA = 0;
$aPagar = 0;

if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST) AND $_POST["Operacion"]== "Add"){
    $id = $_POST["id"];
    $sql= "select * from productos where idp = $id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if(!isset($_SESSION["Carrito"])){
        
        $ProductosArray = array(
            'id'=>$row['idp'],
            'nombre'=>$row['nombre'],
            'precio'=>$row['precio'],
            'cantidad'=>1,
            'importe'=>$row['precio'],       
        );     
    
        $_SESSION["Carrito"][$row['idp']]=$ProductosArray;
        

    }else{
      foreach($_SESSION["Carrito"] as $elemento) {
          
        if($elemento["id"]==$id){
          $_SESSION["Carrito"][$id]["cantidad"]++;
          $_SESSION["Carrito"][$id]["importe"]=$_SESSION["Carrito"][$id]["cantidad"]*$_SESSION["Carrito"][$id]["precio"];
        $validar=false;  
        }
    } 
      
       if($validar){
        $totalElementos = count($_SESSION["Carrito"]);
        $ProductosArray = array(
          'id'=>$row['idp'],
          'nombre'=>$row['nombre'],
          'precio'=>$row['precio'],
          'cantidad'=>1,
          'importe'=>$row['precio'],
      );
      $_SESSION["Carrito"][$id]=$ProductosArray;
      }

       
    }
    header("Location: Carrito.php");

}else if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST) AND $_POST["Operacion"]== "Delete"){
  
 
  $id = $_POST["id"];
  unset($_SESSION["Carrito"][$id]);
  
}else if($_SERVER["REQUEST_METHOD"] == "GET" AND isset($_GET) AND $_GET["Operacion"] =="Actualizar"){
  $id = $_GET["id"];
  $cantidad = $_GET["cantidad"];
  
  $_SESSION["Carrito"][$id]["cantidad"] = $cantidad;
  $_SESSION["Carrito"][$id]["importe"]=$_SESSION["Carrito"][$id]["cantidad"]*$_SESSION["Carrito"][$id]["precio"];
 
}

if(isset($_SESSION["Carrito"])){

foreach($_SESSION["Carrito"] as $elemento) {
$subTotal += $elemento["importe"];
}
$IVA = $subTotal * 0.12;
$aPagar = $subTotal + $IVA;

$_SESSION["VALORES"]["SUBTOTAL"] = $subTotal;
$_SESSION["VALORES"]["IVA"] = $IVA;
$_SESSION["VALORES"]["APAGAR"] = $aPagar;

//echo "Subtotal: $subTotal IVA: $IVA APAGAR: $aPagar";

}

