<?php
include("Plantillas/Encabezado.php");
include("Admin/Conexion/Conexion.php");
$sql = "select * from productos where stock > 3;";
$result = $conn->query($sql);

?>

<div class="container">
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-3">
                <div class="card text-black">
                    <img class="card-img-top" src="img/Productos/<?php echo $row['foto'] ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $row['nombre'] ?></h4>
                        <p class="card-text">Detalle: <?php echo $row['detalle'] ?></p>
                        <h4 class="card-text"><?php echo $row['precio'] ?></h4>
                        <br>
                        <form action="Carritologica.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['idp']?>" />
                            <button type="submit" class="btn btn-primary" name="Operacion" value="Add">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php }
        $conn->close(); ?>
    </div>
</div>