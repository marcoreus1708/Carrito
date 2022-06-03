<?php

include("Plantillas/encabezado.php");
include("Admin/Conexion/Conexion.php");

session_start();
$validar = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usr = $_POST["usr"];
    $pwd = $_POST["pwd"];

    $sql = "select * from clientes where usr = '$usr' and pwd = '$pwd';";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $idf = 0;
        $row = $result->fetch_assoc();
        $subTotal = $_SESSION['VALORES']['SUBTOTAL'];
        $IVA = $_SESSION['VALORES']['IVA'];
        $aPagar = $_SESSION['VALORES']['APAGAR'];
        $idc = $row['idc'];
        $sql = "insert into facturas values (null,CURDATE(),$subTotal,$IVA,$aPagar,$idc)";

        if($conn->query($sql)){
           $idf =  $conn->insert_id;
        }else{
            $validar = false;
        }

        foreach($_SESSION["Carrito"] as $elemento){
            $idp = $elemento["id"];
            $precio = $elemento["precio"];
            $cantidad = $elemento["cantidad"];
            $importe = $elemento["importe"];

            $sql = "insert into detalles value (null,$cantidad,$precio,$importe,$idp,$idf);";
            if(!$conn->query($sql)){
                $validar= false;
            }

        }

        if($validar){
        //session_destroy();
        //echo "<script>alert('Bienvenido, compra realizada');</script>";
        $aPagar = $_SESSION['VALORES']['APAGAR'];
        echo "<script>
        alert('Bienvenido, compra realizada');
        window.location.href = 'pdf.php';
        </script>";
    }else{
        echo "<script>alert('Bienvenido,error al comprar');</script>";
    }

  }else{
    echo "<script>alert('Datos incorrectos, intenta Nuevamente');</script>";
  }
}

?>

<div class="container">
    <div class="row">
        <div class="container">
            <form method="POST">
            <fieldset class="form-group row">
            <legend class="col-form-legend col-sm-1-12">Bienvenido, ingrese sus datos para poder continuar</legend>
            </fieldset>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-1-12 col-form-label">Ingrese su usuario</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="usr" id="inputName" placeholder="">
                    </div>
                    <div class="form-group row">
                    <label for="inputName" class="col-sm-1-12 col-form-label">Ingrese su clave</label>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="pwd" id="inputName" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include("Plantillas/pie.php");

?>