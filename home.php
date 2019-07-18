<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
    <title>Transcript</title>
</head>

<body onload="listarTranscripciones()">
    <?php
        session_start();
        if(!isset($_SESSION['nombre'])){
            header( 'Location: index.html');
        }
    ?>
    <!-- Barra de Navegación-->
    <nav class="navbar navbar-expand-lg nav">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <img class="navbar-brand" src="img/Logo.png" width="1.5%" height="1.5%">&nbsp;
        <a class="navbar-brand">
            <font color=white><?php if(!isset($_SESSION['nombre'])){echo "Visitante";}else{echo $_SESSION['nombre'];}?></font>
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a class="nav-brand" href="#" data-toggle='modal' data-tooltip='tooltip'
                data-placement='bottom' title='Cambiar Contrase&ntilde;a'
                data-target='#cambiar-password'>
                    <font color=white>Cambiar Contrase&ntilde;a&nbsp;&nbsp;&nbsp;</font>
                </a>
                <a class="nav-brand" href="php/logout.php">
                    <font color=white>Cerrar Sesión</font>
                </a>
            </div>
        </div>
    </nav><br>
    <!-- Tabla con transcripciones -->
    <div class="container">
        <table class="table table-hover table-striped ">
            <thead class="tabla">
                <tr>
                    <th scope="col">
                        <font color=white>Id</font>
                    </th>
                    <th scope="col">
                        <font color=white>Titulo</font>
                    </th>
                    <th scope="col">
                        <font color=white>Fecha de Creaci&oacute;n</font>
                    </th>
                    <th scope="col">
                        <font color=white>Ultima Modificaci&oacute;n</font>
                    </th>
                    <th scope="col">
                        <font color=white>Acciones</font>
                    </th>
                </tr>
            </thead>
            <tbody id="lista_transcripciones">
            </tbody>
        </table>
    </div>
    <!-- Modal de edición -->
    <div class="modal fade" name="edicion" id="edicion">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><img src='fonts/edit.svg'>Editar</button>&nbsp;</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div id="verTranscripcion"></div>
            </div>
        </div>
    </div>
    <!-- Modal de eliminar -->
    <div class="modal fade" name="eliminar" id="eliminar">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img src="fonts/warning.svg"><h4>&nbsp;Eliminar</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div id="eliminarModal"></div>
                
            </div>
        </div>
    </div>
    <!-- Modal de Cambiar Contraseña -->
    <div class="modal fade" name="cambiar-password" id="cambiar-password">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>&nbsp;Cambiar Contrase&ntilde;a</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="form-horizontal">
                    <div class="form-group" align="center">
                        <div class="col-sm-12">
                            <br><input type="password" name="password-actual" id="password-actual" class="form-control" placeholder="Contrase&ntilde;a Actual" onkeyup="validacionContrasennaActual()">
                            <?php echo "<input type='hidden' value='".$_SESSION['password']."' id='contrasennaActual' name='contrasennaActual' >"; ?>
                            <p><font color=gray>___________________________________________</font></p>
                            <input type="password" name="newPassword1" id="newPassword1" class="form-control" placeholder="Nueva Contrase&ntilde;a" onkeyup="validacionCambioContrasenna()" disabled>
                            <br><input type="password" name="newPassword2" id="newPassword2" class="form-control" placeholder="Validar Contrase&ntilde;a" onkeyup="validacionCambioContrasenna()" disabled><br>
                            <div class="alert alert-danger ocultar" role="alert" id="pass-dont-match">Las Contrase&ntilde;as no coinciden!</div>
                            <div class="alert alert-warning ocultar" role="alert" id="pass-length">La Contrase&ntilde;a debe contener al menos 8 caracteres!</div>
                        </div><br>
                        <button class="button-color" onclick="cambiarContrasenna()" id="btn-password" disabled>Cambiar Contrase&ntilde;a</button>       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Verificacion de cambios -->
    <div class="modal fade" name="mensaje" id="mensaje">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>&nbsp;Los cambios se guardaron correctemente</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Se realizo una actualizaci&oacute;n!</h4>
                    <p>Los datos se actualizaron correctemente, es posible que debas actualizar la p&aacute;gina para visualizar los cambios.</p>
                    <center><button class='btn btn-success' data-dismiss='modal'>Aceptar</button></center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>