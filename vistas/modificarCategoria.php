<?php
 include ('../conexion/conectar.php');
 include ('../modelo/CategoriaModelo.php');
?>
<?php
$obj = new categoria();
if($_POST){
    $obj->id_categoria = $_POST['id_categoria'];
    $obj->categoria = $_POST['categoria'];
}
?>
<?php
$llave = $_GET['key'];
$c = new conexion();
$cone = $c->conectando();
$sql = "select * from categoria where id_categoria = '$llave'";
$resultado = mysqli_query($cone,$sql);
$arreglo = mysqli_fetch_row($resultado);
    $obj->id_categoria = $arreglo[0];
    $obj->categoria = $arreglo[1];
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
            <form action="" name="categoria" method="POST">
                <table border="1">
                        <tr>
                            <td colspan="2"><center><b>Modificar Categoría</b></center></td>
                        </tr>
                        <tr>
                            <td>Código Categoría</td>
                            <td><input size="36" type="number" name="id_categoria" id="id_categoria" value="<?php echo $obj->id_categoria?>" placeholder="Ingrese código"></td>
                        </tr>
                            <td>Categoría</td>
                            <td><input size="20" type="text" name="categoria" id="categoria" value="<?php echo $obj->categoria?>" placeholder="Ingrese categoría"></td>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" name="modifica">Modificar</button>
                                    <a href="consultarCategoria.php">
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