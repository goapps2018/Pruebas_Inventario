<?php
 include('../conexion/conectar.php');
?>

<?php 
session_start();

    $varsesion = $_SESSION['nombre_usuario'];
    $c = new conexion();
    $cone = $c->conectando();	
    $sql1 = "select nivel.id_nivel from usuario INNER JOIN nivel on usuario.id_nivel = nivel.id_nivel where usuario.nombre_usuario = '$varsesion' ";
    $rs1 = mysqli_query($cone,$sql1);
    $arreglo1 = mysqli_fetch_row($rs1);
    
    if( $arreglo1[0]!=1 and $arreglo1[0]!=2){
        
        echo 'UD NO TIENE AUTORIZACION';
    
    die();
    }
    if($varsesion=="")
    {
        header("location:login.php");
    }
?>

<?php
if($_POST){
            $obj->id_clasificacion = $_POST['id_clasificacion'];
            
}
?>
<?php
$correrPagina = $_SERVER["PHP_SELF"]; 
$maximoDatos = 7;
$paginaNumero = 0;

if(isset($_GET['paginaNumero'])){
   $paginaNumero = $_GET['paginaNumero'];
}
$inicia = $paginaNumero * $maximoDatos;

?>

<?php
if(isset($_POST['consulta'])){
   
    $c = new conexion();
    $cone = $c->conectando();
    $sql = "select * from clasificacion where id_clasificacion like '%$obj->id_clasificacion%'";
    $limite =sprintf("%s limit %d, %d",$sql, $inicia, $maximoDatos);
    $resultado = mysqli_query($cone,$limite);
    $arreglo = mysqli_fetch_row($resultado);
}
else{
    $c = new conexion();
    $cone = $c->conectando();
    $sql = "select * from clasificacion";
    $limite =sprintf("%s limit %d, %d",$sql, $inicia, $maximoDatos);
    $resultado = mysqli_query($cone,$limite);
    $arreglo = mysqli_fetch_row($resultado);
}
?>
<?php
if(isset($_GET['totalArreglo'])){
	$totalArreglo = $_GET['totalArreglo'];
	
}
	else{
		$lista = mysqli_query($cone,$sql);
		$totalArreglo = mysqli_num_rows($lista);
	}
$totalPagina = ceil($totalArreglo/$maximoDatos)-1;

?>
<?php
$cargarPagina = "";
if(!empty($_SERVER['QUERY_STRING'])){ 
	$parametro1 = explode("&", $_SERVER['QUERY_STRING']); 
	$nuevoParametro = array();
	foreach($parametro1 as $parametro2){
			if(stristr($parametro2, "paginaNumero")==false && stristr($parametro2, "totalArreglo")==false){ 
				 array_push($nuevoParametro, $parametro2);
			}
	}
	if(count($nuevoParametro)!=0){
		$cargarPagina = "&". htmlentities(implode("&", $nuevoParametro));
	}
}
$cargarPagina = sprintf("&totalArreglo=%d%s", $totalArreglo, $cargarPagina);
?>

<!Doctype html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="html, css, bootstrap y php">
    <link rel="stylesheet" href="../vistas/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vistas/css1/font-awesome.min.css">
    </head>

    <body>
        <center>
          <br>   
            <h3 class="font-weight-normal"><b>Clasificación</b></h3> 
            <hr>
            <form name="clasificacion" action="" method="POST">
            <table >
                 <tr>
                    <td>
                             <a href="agregarClasificacion.php"><button type="button" class="btn btn-primary btn-sm "><i class="fa fa-file-text-o" aria-hidden="true"></i>Agregar</button></a>
                    </td>
                </tr>
                 <tr>
		                <th><label for="id_clasificacion">Buscar</label></th>
		                <th><input style="font-size:14px" type="text" id="id_clasificacion" name="id_clasificacion"placeholder="Ingrese el código de la clasificación a consultar" size="50" >
                            <button type="submit" name="consulta" class="btn btn-warning btn-sm"><i class="fa fa-search" aria-hidden="true"></i>Consultar</button>
		                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-undo" aria-hidden="true"></i>Refrescar</button>
		                </th>
		                <th><a href="../menu/home.html"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i>Salir</button></a> </th>
                </tr>

            </table> 
            </center>
            <br>  
            <center>
                <table class="table table-dark table-striped table-hover" style="width:95%" >
                        <caption><small>Lista Clasificación</small></caption>  
                        <thead class="bg-danger">
                            <tr>
                                <th scope="col" style="width:10%">Código Clasificación</th>
                                <th scope="col" style="width:10%">Clasificación</th>
                                <th scope="col" style="width:10%">Modificar</th>
                                <th scope="col" style="width:10%">Eliminar </th>
                                
                            </tr>
                        </thead>
                        <?php
                            do{
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $arreglo[0] ?></td>
                                <td><?php echo $arreglo[1] ?></td>
                                <td class="letra">
                                    <a href="<?php if($arreglo[0] <> ""){
                                            echo "modificarClasificacion.php?key=".urlencode($arreglo[0]);
                                    }else{
                                        echo"<script> alert('Debe de consultar primero')</sccript>";
                                    }
                                    
                                    ?>">
                                    <button name="modi" type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modificar</button>
                                    </a> 
                                </td>
                                <td class="letra">
                                <a href="<?php if($arreglo[0]<>""){
                                            echo "eliminarClasificacion.php?key=".urlencode($arreglo[0]);
                                    }else{
                                        echo"<script> alert('Debe de consultar primero')</sccript>";
                                    }
                                

                                ?>">
                                    <button name="elim" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</button>
                                </a> 
                                </td>
                            </tr>
                        </tbody>
                        <?php
                            }while($arreglo = mysqli_fetch_row($resultado));
                        ?>
                </table> 
                <h6><?php printf("Total de Registros Encontrados %d", $totalArreglo) ?></h6>
                <table border=0>
  	           
                <tr>
                <td> 
                    <?php  
                        if($paginaNumero > 0){
                    ?> 
                     <a href="<?php printf("%s?paginaNumero=%d%s",$correrPagina,0,$cargarPagina) ?>" id="paginador"> < Inicio </a> <?php }?>
                </td>
                <td>
                    <?php  
                    if($paginaNumero > 0){
                ?> 
                    <a href="<?php printf("%s?paginaNumero=%d%s",$correrPagina, max(0,$paginaNumero-1),$cargarPagina) ?>" id="paginador" > << Anterior </a> <?php }?></td>
                <td>
                    <?php 
                    if($paginaNumero < $totalPagina ){
                    ?>
                     <a href="<?php printf("%s?paginaNumero=%d%s",$correrPagina, min($totalPagina,$paginaNumero+1),$cargarPagina) ?>" id="paginador"> Siguiente >>  </a> <?php }?></td>
                <td>
                <?php 
                    if($paginaNumero < $totalPagina ){
                ?> 
                <a href="<?php printf("%s?paginaNumero=%d%s",$correrPagina, $totalPagina,$cargarPagina) ?>" id="paginador"> Ultima ></a> <?php } ?></td>
            
                </tr>
				</table>            
                </center>
                 </div>
              </div>
            </div>
         </form>
    </body> 
</html>