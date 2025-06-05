<?php
 include('../conexion/conectar.php');
 include("../modelo/modeloUsuario.php");
?>
<?php
$obj = new usuario();
if($_POST){
    $obj->id_usuario = $_POST['id_usuario'];
    $obj->id_nivel = $_POST['id_nivel'];
    $obj->nombre_usuario = $_POST['nombre_usuario'];
    $obj->clave = $_POST['clave'];
}


$c = new conexion();
$cone = $c->conectando();
$p = "select * from nivel";
$res = mysqli_query($cone,$p);
$arreglo = mysqli_fetch_assoc($res);


?>

<!Doctype html> 
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="idth=device-width, initial-scale=1, shrink-to-fit=no"> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css2/strength.css">	
    </head>

    <br>
    <body>
        <center>
            <form action="" name="usuario" method="POST">
                <table border="1">
                        <tr>
                            <td colspan="2"><center><b>Agregar Usuario</b></center></td>
                        </tr>
                        <tr>
                            <td>Código Usuario</td>
                            <td><input size="25" type="number" name="id_usuario" id="id_usuario" placeholder="Ingrese código" required></td>
                        </tr>
                        <tr>
                            <td>Rol</td>
                            <td>
                            <select name="id_nivel" id="$obj->id_nivel" required>
                                    <option>[Seleccione el rol]
                                        <?php
                                            do{
                                                $codigo = $arreglo['id_nivel'];
                                                $nombre = $arreglo['nombre_nivel'];
                                                if($codigo == $obj->id_nivel){
                                                    echo "<option value=$codigo=>$nombre";
                                                }else{
                                                    echo "<option value=$codigo>$nombre";
                                                }
                                            }while($arreglo = mysqli_fetch_assoc($res));

									        $row = mysqli_num_rows($res);
									        $rows=0;
									        if($rows>0)
									                {
										            mysqli_data_seek($arreglo ,0);
										            $arreglo = mysqli_fetch_assoc($res);
									                }
                                        ?>
                                    </option>    
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Username</td>
                            <td><input size="25" type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese username" required></td>
                        </tr>
                        <tr>
                            <td>Clave</td>
                            <form action="login.php" method="POST" accept-charset="utf-8">
                            <td><input id="myPassword" type="password" name="clave" size="10" required minlength="6" placeholder="Ingrese clave" required></td>
                            </form>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" name="guarda">Guardar</button>
                                    <a href="consultarUsuario.php">
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