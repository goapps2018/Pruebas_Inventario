<?php
 include('../conexion/conectar.php');
 include("../modelo/clasificacionModelo.php");
?>
<?php
$obj = new clasificacion();
if($_POST){
    $obj->id_clasificacion = $_POST['id_clasificacion'];
    $obj->clasificacion = $_POST['clasificacion'];
   
}
?>
<?php
$llave = $_GET['key'];
$c = new conexion();
$cone = $c->conectando();
$sql = "select * from clasificacion where id_clasificacion = '$llave'";
$resultado = mysqli_query($cone,$sql);
$arreglo = mysqli_fetch_row($resultado);
    $obj->id_clasificacion = $arreglo[0];
    $obj->clasificacion = $arreglo[1];
    
?>

<!Doctype html> 
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="idth=device-width, initial-scale=1, shrink-to-fit=no"> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
    </head>

    <br>
    <body>
        <center>
            <form action="" name="clasificación" method="POST">
                <table border="1">
                        <tr>
                            <td colspan="2"><center><b>Modificar Clasificación</b></center></td>
                        </tr>
                        <tr>
                            <td>Código Clasificación</td>
                            <td><input size="40" type="number" name="id_clasificacion" id="id_clasificacion" value="<?php echo $obj->id_clasificacion?>" placeholder="Ingrese código"></td>
                        </tr>
                        <tr>
                            <td>Clasificación</td>
                            <td><input size="20" type="text" name="clasificacion" id="clasificacion" value="<?php echo $obj->clasificacion?>" placeholder="Ingrese clasificación"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" name="modifica">Modificar</button>
                                    <a href="consultarClasificacion.php">
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