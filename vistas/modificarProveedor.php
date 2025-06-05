<?php
 include('../conexion/conectar.php');
 include('../modelo/modeloProveedor.php');
?>
<?php
$obj = new proveedor();
if($_POST){
        $obj->id_proveedor = $_POST['id_proveedor'];
        $obj->nombre = $_POST['nombre'];
        $obj->NIT = $_POST['NIT'];
        $obj->ciudad = $_POST['ciudad'];
        $obj->direccion = $_POST['direccion'];
}
?>
<?php
$llave = $_GET['key'];
$c = new conexion();
$cone = $c->conectando();
$sql = "select * from proveedor where id_proveedor = '$llave'";
$resultado = mysqli_query($cone,$sql);
$arreglo = mysqli_fetch_row($resultado);
    $obj->id_proveedor = $arreglo[0];
    $obj->nombre = $arreglo[1];
    $obj->NIT = $arreglo[2];
    $obj->ciudad = $arreglo[3];
    $obj->direccion = $arreglo[4];
?>


<!DOCTYPE html> 
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="idth=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../vistas/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vistas/css1/font-awesome.min.css">
    </head>

    <br>
    <body>
        <center>
            <form action="" name="proveedor" method="POST">
                <table border="1">
                        <tr>
                            <td colspan="2"><center><b>Modificar Proveedor</b></center></td>
                        </tr>
                        <tr>
                            <td>Código Proveedor</td>
                            <td><input size="40" type="number" name="id_proveedor" id="id_proveedor" value="<?php echo $obj->id_proveedor?>" placeholder="Ingrese código"></td>
                        </tr>
                        <tr>
                            <td>Nombre Proveedor</td>
                            <td><input size="20" type="text" name="nombre" id="nombre" value="<?php echo $obj->nombre?>" placeholder="Ingrese nombre"></td>
                        </tr>
                        <tr>
                            <td>NIT</td>
                            <td><input size="20" type="text" name="NIT" id="NIT" value="<?php echo $obj->NIT?>" placeholder="Ingrese NIT"></td>
                        </tr>
                        <tr>
                            <td>Ciudad</td>
                            <td><input size="20" type="text" name="ciudad" id="ciudad" value="<?php echo $obj->ciudad?>" placeholder="Ingrese ciudad"></td>
                        </tr>
                        <tr>
                            <td>Dirección</td>
                            <td><input size="20" type="text" name="direccion" id="direccion" value="<?php echo $obj->direccion?>" placeholder="Ingrese dirección"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" name="modifica">Modificar</button>
                                    <a href="consultarProveedor.php">
                                             <button type="button" name="salir">Salir</button>
                                    </a>
                                </center>
                            </td>
                        </tr>
                </table>
            </form>
        </center>  
    </body> 
</html>