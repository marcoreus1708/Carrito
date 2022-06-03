<?php 
include("Plantillas/encabezado.php");
include("Conexion/Conexion.php");

$_SESSION["PERMISO"] = false;
$_SESSION["NOMBRE"] = "";
$_SESSION["APELLIDO"] = "";

if($_SERVER['REQUEST_METHOD'] === "POST" AND isset($_POST)){
    $usr = $_POST["usr"];
    $pwd = $_POST["pwd"];
    $sql = "select * from usuarios where usuario = '$usr' and clave = '$pwd';";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $_SESSION["PERMISO"] = true;
        $_SESSION["NOMBRE"] = $row["nombre"];
        $_SESSION["APELLIDO"] = $row["apellido"];
        echo "<script>
        alert('Bienvenido');
        window.location.href = 'Admin.php';
        </script>";
    }else{
        echo "<script>alert('Intente nuevamente');</script>";
    }
}



?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form method="POST">
                <label class="form-label">Bienvenido</label>
                <br>
                <label class="form-label">Ingrese su usuario</label>
                <input type="text" name="usr" class="form-control" placeholder="Ingrese su Usuario"/>
                <label class="form-label">Ingrese su clave</label>
                <input type="password" name="pwd" class="form-control" placeholder="Ingrese su Clave"/>
                <br>
                <input type="submit" name="enviar" class="btn btn-primary" value="Enviar"/>
            </form>
        </div>
    </div>
</div>

<?php include("Plantillas/pie.php") ?>