<?php
class usuario{
                public $id_usuario;
                public $id_nivel;
                public $nombre_usuario;
                public $clave;


                function agregar(){
                                    $c = new conexion();
                                    $cone = $c->conectando();
                                    $sql = "select * from usuario where id_usuario = '$this->id_usuario'";
                                    $resultado = mysqli_query($cone,$sql);
                                    if(mysqli_fetch_row($resultado)){
                                        echo"<script> alert('El usuario ya existe en el sistema');</script>";

                                    }else{
                                        $insertar ="insert into usuario values('$this->id_usuario','$this->id_nivel','$this->nombre_usuario','$this->clave')";
                                        mysqli_query($cone,$insertar);
                                        echo"<script> alert('El usuario fue creado en el sistema');</script>";

                                    }

                }
                function modificar(){
                                    $c = new conexion();
                                    $cone = $c->conectando();
                                    $sql = "select * from usuario where id_usuario = '$this->id_usuario'";
                                    $resultado = mysqli_query($cone,$sql);
                                    if(!mysqli_fetch_row($resultado)){
                                        echo"<script> alert('El usuario ya existe en el sistema');</script>";
                                    
                                    }else{
                                        $update = "update usuario set id_usuario = '$this->id_usuario',
                                                                      id_nivel = '$this->id_nivel',
                                                                      nombre_usuario = '$this->nombre_usuario',
                                                                      clave = '$this->clave'
                                                                      where id_usuario = '$this->id_usuario';
                                                                        ";
                                        mysqli_query($cone,$update);
                                        echo"<script> alert('El usuario fue modificado en el sistema');</script>";
                                    }

                }
                function eliminar(){
                                    $c = new conexion();
                                    $cone = $c->conectando();
                                    $delete = "delete from usuario where id_usuario ='$this->id_usuario'; ";
                                    if(mysqli_query($cone,$delete)){
                                            echo"<script> alert('El usuario fue eliminado del sistema');</script>";
                                    }else{
                                        echo"<script> alert('El usuario no se puede eliminar porque tiene registros relacionados en el sistema');</script>";
                                    }       

                }

}
?>