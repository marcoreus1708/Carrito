<?php 
include("Plantillas/encabezado.php");
include("Conexion/Conexion.php");


if($_SESSION['PERMISO']){
    $sql = "Select * from clientes;";
    $result = $conn->query($sql);;
}else{
    header("Location: Login.php");
}


?>
<div class="container">
    <div class="row">
        <table border="1" class="table table-striped table-inverse table-bordered ">
        <label  class="text-center p-3" class="form-label">CLIENTES</label>
            <thead class="thead-inverse ">
                <tr class="table-success">
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>FECHA DE NACIMIENTO</th>
                    <th>DETALLE</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php while($r = $result->fetch_assoc()){?>
                    <tr>
                        <td><?php echo $r['idc']; ?></td>
                        <td><?php echo $r['nombre']; ?></td>
                        <td><?php echo $r['apellido']; ?></td>
                        <td><?php echo $r['fnacimiento']; ?></td>
                        <td><?php echo $r['detalle']; ?></td>
                       
                        <td>
                            <form action="Conexion/ClientesLogica.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $r['idc']; ?>">
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form action="Formulario.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $r['idc']; ?>">
                                <button type="submit" class="btn btn-primary"  name="Enviar" value="Actualizar">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    $conn->close();
                    ?>
                </tbody>
        </table>
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
            <a class="btn btn-success" href="Formulario.php">Nuevo Cliente</a>
        </div>
    </div>
</div>

<?php include("Plantillas/pie.php") ?>