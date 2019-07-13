<?php
    class password{
        private $sql;
        
        function __construct(){}

        function getSql(){
            return $this->sql;
        }

        function setSql($sql){
            $this->sql = $sql;
        }

        function runQuery(){
            require_once("conexion.php");
            $resultado = mysqli_query($conexion,$this->sql) or die(mysqli_error($conexion));
            return $resultado;
        }

        function updatePassword($password,$id){
            $this->sql = "UPDATE usuario SET Password = '".$password."' WHERE id = '".$id."'";
            runQuery();
            $this->sql = "SELECT Nombre,CorreoElectronico FROM usuario WHERE id = '".$id."'";
            $correo = runQuery();
            $from = mysqli_fetch_array($resultado);
            $cuerpoCorreo = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link rel="shortcut icon" href="img/Logo.png">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
                <script src="js/scripts.js"></script>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
                <title>Transcript: Cambio de Contrase&ntilde;a</title>
            </head>
            <body>
                <nav class="navbar navbar-expand-lg nav">
                    <img class="navbar-brand" src="img/Logo.png" width="1.5%" height="1.5%">&nbsp;
                    <a class="navbar-brand">
                        <font color=white>Transcript: Cambio de Contrase&ntilde;a</font>
                    </a>
                </nav><br>
                <!-- Modal para Iniciar Sesion Admin-->
                <div class="container" id="collapsibleNavbar3">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Cambio de Contrase&ntilde;a</h4>
                            </div>
                            <div class="modal-body">   
                                <div class="form-group" align="center">
                                    <img class="navbar-brand" src="img/Logo.png" width="25%" height="25%">&nbsp;
                                    
                                    <div class="col-sm-10" align="justify">
                                            <label>'.$from['Nombre'].' el mótivo de este correo es para informarle que su contraseña en Transcript ha sido cambiada. Su contraseña ahora es:'.$password.'</label> 
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <button style="background-color: #283148;border-radius: 5px;border: none;color: white;"><a href="http://localhost/Transcript/" style="color: white">Iniciar Sesi&oacute;n</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
            mail($from['CorreoElectronico'],"Cambio de contraseña en Transcript",$cuerpoCorreo);
        }

        function recoverPassword($correo){
            $this->sql = "SELECT * FROM usuario WHERE CorreoElectronico = '".$correo."'";
            $resultado = $this->runQuery();
            $nombre = "";
            $pass = "";
            while($from = mysqli_fetch_array($resultado)){
                $nombre = $from['Nombre'];
                $pass = $from['Password'];
            };
            $cuerpoCorreo = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link rel="shortcut icon" href="img/Logo.png">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
                <script src="js/scripts.js"></script>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
                <title>Transcript: Cambio de Contrase&ntilde;a</title>
            </head>
            <body>
                <nav class="navbar navbar-expand-lg nav">
                    <img class="navbar-brand" src="img/Logo.png" width="1.5%" height="1.5%">&nbsp;
                    <a class="navbar-brand">
                        <font color=white>Transcript: Recuperaci&oacute;n de Contrase&ntilde;a</font>
                    </a>
                </nav><br>
                <!-- Modal para Iniciar Sesion Admin-->
                <div class="container" id="collapsibleNavbar3">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Recuperaci&oacute;n de Contrase&ntilde;a</h4>
                            </div>
                            <div class="modal-body">   
                                <div class="form-group" align="center">
                                    <img class="navbar-brand" src="img/Logo.png" width="25%" height="25%">&nbsp;
                                    
                                    <div class="col-sm-10" align="justify">
                                            <label><b>'.$nombre.'</b> el mótivo de este correo es debivo a que se solicito recuperar la contrase&ntilde;a en el sistema Transcript.<br><h5> Su contraseña es: '.$pass.'</h5></label> 
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <button style="background-color: #283148;border-radius: 5px;border: none;color: white;"><a href="http://localhost/Transcript/" style="color: white">Iniciar Sesi&oacute;n</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
            mail($correo,"Cambio de contraseña en Transcript",$cuerpoCorreo);
        }
    }

  /*  if(isset($_POST['recuperarEmail'])){
        $p = new password();
        $p->recoverPassword($_POST['recuperarEmail']);
        echo "Mensaje enviado a: ".$_POST['recuperarEmail'];
        //echo "<script>alert('Se envio un Correo El&eacute;ctronico al correo: '".$_POST['recuperarEmail'].");window.location.href='/Transcript/';</script>";
    }else{
        echo ":v";
    }*/
    $p = new password();
    $p->recoverPassword("yohovanivargas@gmail.com");
    echo "Mensaje enviado a: yohovanivargas@gmail.com";

    

?>