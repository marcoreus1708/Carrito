<?php 
include("Plantillas/encabezado.php"); 
include("Conexion/Conexion.php");


/*if(!$_SESSION['PERMISO']){
    header("Location: Login.php");
}*/

$id = "";
$nombre = "";
$marca = "";
$detalle = "";
$precio = "";
$stock = "";
$foto = "";



if($_SERVER["REQUEST_METHOD"] === "POST" AND isset($_POST) AND $_POST["Enviar"] ==="Actualizar"){

    $id = $_POST['id'];

    $sql = "select * from productos where idp = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $id = $row['idp'];
    $nombre = $row['nombre'];
    $marca = $row['marca'];
    $detalle = $row['detalle'];
    $precio = $row['precio'];
    $stock = $row['stock'];
    $foto = $row['foto'];
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="Conexion/ProductosLogica.php" method="POST" enctype="multipart/form-data">
                <label class="form-label">Formulario Productos</label>
                <br>
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <label class="form-label">Ingrese el nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" value="<?php echo $nombre ?>"/>
                <label class="form-label">Ingrese la marca</label>
                <input type="text" name="marca" class="form-control" placeholder="Ingrese la marca" value="<?php echo $marca ?>"/>
                <label class="form-label">Ingrese el detalle</label>
                <input type="text" name="detalle" class="form-control"  placeholder="Ingrese el detalle" value="<?php echo $detalle ?>"/>
                <label class="form-label">Ingrese el precio</label>
                <input type="num" name="precio" class="form-control" placeholder="Ingrese el precio"value="<?php echo $precio ?>"/>
                <label class="form-label">Ingrese el importe</label>
                <input type="num" name="stock" class="form-control" placeholder="Ingrese el importe"value="<?php echo $stock ?>"/>
                <label class="form-label">Seleccione una foto</label>
                <h3><?php echo "Foto: $foto"?></h3>
                <input type="file" name="foto" class="form-control"/>
                <br>
                <button type="submit" class="btn btn-primary" name="Enviar" value="Guardar">Guardar</button>
            </form>
        </div>
    </div>
</div>
<?php include("Plantillas/pie.php") ?>