<?php

include("Plantillas/Encabezado.php");
session_start();
//print_r($_SESSION["Carrito"]);a
?>
<div class="container">
    <div class="row">
        <table border="1" class="table table-striped table-inverse table-bordered">
        <label  class="text-center p-3" class="form-label">CARRITO</label>
            <thead>
                <tr class="table-success">
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($_SESSION["Carrito"] as $elemento){
                    //print_r($elemento);
                    //echo "<br>";
                    ?>
                <tr>
                    <td><?php echo $elemento["id"]?></td>
                    <td><?php echo $elemento["nombre"]?></td>
                    <td><?php echo $elemento["precio"]?></td>
                    <td><input type="number" onchange="actualizar(<?php echo $elemento['id']?>,this.value);" value="<?php echo $elemento["cantidad"]?>"/></td>
                    <td><?php echo $elemento["importe"]?></td>
                    <td>
                        <form action="Carritologica.php" method="POST">
                            <input type="hidden" value="<?php echo $elemento["id"]?>" name="id"/>
                            <button type="submit" class="btn btn-danger" value="Delete" name="Operacion">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr><th colspan="4">SubTotal</th><th><?php echo  $_SESSION['VALORES']['SUBTOTAL'] ?></th></tr>
                <tr><th colspan="4">IVA</th><th><?php echo  $_SESSION['VALORES']['IVA'] ?></th></tr>
                <tr><th colspan="4">Total</th><th><?php echo  $_SESSION['VALORES']['APAGAR'] ?></th></tr>
            </tfoot>
        </table>
        <div class="col-md-8">
        </div>
        <div class="col-md-3">
            <a class="btn btn-success" href="Pagar.php">Pagar</a>
        </div>
            
    </div>
</div>
<script>
    function actualizar(id,cantidad){
        

        let xhr = new XMLHttpRequest();
        xhr.open('GET','Carritologica.php?id='+id+"&Operacion=Actualizar&cantidad="+cantidad,false);
        xhr.send();

      

        location.reload();
    }

</script>


<?php
include("Plantillas/Pie.php");
?>