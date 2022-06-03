<?php 
include("Plantillas/encabezado.php"); 
include("Conexion/Conexion.php");


/*if(!$_SESSION['PERMISO']){
   header("Location: Login.php");
}*/

$id = "";
$nombre = "";
$apellido = "";
$fnacimiento = "";
$detalle = "";




if($_SERVER["REQUEST_METHOD"] === "POST" AND isset($_POST) AND $_POST["Enviar"] ==="Actualizar"){

    $id = $_POST['id'];

    $sql = "select * from clientes where idc = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $id = $row['idc'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $fnacimiento = $row['fnacimiento'];
    $detalle = $row['detalle'];
    
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="Conexion/ClientesLogica.php" method="POST" enctype="multipart/form-data">
                <label class="form-label">Formulario Clientes</label>
                <br>
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <label class="form-label">Ingrese el nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" value="<?php echo $nombre ?>"/>
                <label class="form-label">Ingrese el apellido</label>
                <input type="text" name="apellido" class="form-control" placeholder="Ingrese su apellido" value="<?php echo $apellido ?>"/>
                <label class="form-label">Ingrese la fecha de nacimiento</label>
                <input type="date" name="fecha" class="form-control" value="<?php echo $fnacimiento ?>"/>
                <label class="form-label">Ingrese una descripcion</label>
                <input type="text" name="detalle" class="form-control" placeholder="Ingrese la descripcion"value="<?php echo $detalle ?>"/>
                <br>
                <button type="submit" class="btn btn-primary" name="Enviar" value="Guardar">Guardar</button>
            </form>
        </div>
    </div>
</div>
<?php include("Plantillas/pie.php") ?>