<?php 
include("Plantillas/encabezado.php");
include("Conexion/Conexion.php");



    $sql = "Select * from productos;";
    $result = $conn->query($sql);;



?>
<div class="container">
    <div class="row">
        <table border="1" class="table table-striped table-inverse table-bordered ">
        <label  class="text-center p-3" class="form-label">PRODUCTOS</label>
            <thead class="thead-inverse ">
                <tr class="table-success">
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
                    <th>DETALLE</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php while($r = $result->fetch_assoc()){?>
                    <tr>
                        <td><?php echo $r['idp']; ?></td>
                        <td><?php echo $r['nombre']; ?></td>
                        <td><?php echo $r['marca']; ?></td>
                        <td><?php echo $r['detalle']; ?></td>
                        <td><?php echo $r['precio']; ?></td>
                        <td><?php echo $r['stock']; ?></td>
                        
                       
                        <td>
                            <form action="Conexion/ClientesLogica.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $r['idp']; ?>">
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form action="FormularioProduc.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $r['idp']; ?>">
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
            <a class="btn btn-success" href="FormularioProduc.php">Nuevo Producto</a>
        </div>
    </div>
</div>

<?php include("Plantillas/pie.php") ?>