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
    <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
    <title>Transcript</title>
</head>

<body class="body" onload="selectArea()">
    <?php
        session_start();
        if(isset($_SESSION['id'])){
            header('Location: home.php');
        }
    ?>
<script>
    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        console.log('response: '+ Object.getOwnPropertyNames(response));
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            login(response.authResponse.accessToken);
        } else {
            // The person is not logged into your app or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    function checkLoginStateRegistro(){
        $("#area-Facebook").modal("show");
    }

    function registro(){
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function () {
        FB.init({
            appId: '2464888593735937',
            cookie: true,  // enable cookies to allow the server to access 
            // the session
            xfbml: true,  // parse social plugins on this page
            version: 'v3.3' // The Graph API version to use for the call
        });

        // Now that we've initialized the JavaScript SDK, we call 
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });

    };

    // Load the SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        
        FB.api('/me', {fields: 'name, email' }, function (response) {
            console.log('Successful login for: ' + Object.values(response));
            colsole.log('Propiedades: '+ Object.getOwnPropertyNames(response));
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
        });
    
       
    }
    function login(token){
            FB.api('/me', {fields: 'name, email' }, function (response) {
                var xhttp = new XMLHttpRequest();
                
                xhttp.open("POST","/Transcript/php/login.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("name="+response.name+"&id="+response.id+"&email="+response.email+"&token="+token);
                xhttp.onreadystatechange = function(){
                    if(xhttp.readyState == 4 && xhttp.status == 200){
                        alert("Bienvenido: "+response.name);
                        console.log("name="+response.name+"&id="+response.id+"&email="+response.email+"&token="+token);
                        window.location.href="http://localhost/Transcript/home.php";
                    }
                };
        });
    }


</script>
  

    <!-- Modal para Registrarse-->
    <div class="modal fade" id="registro" align="center">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <br>
                <h4>Registro de Usuario</h4>
                <fb:login-button 
                                data-button-type = "continue_with"
                                class = "fb-login-button"
                                data-size = "large"
                                data-use-continue-as = "true"
                                scope="public_profile,email"
                                onlogin="checkLoginState();">
                            </fb:login-button>   
                
                <div class="container"><hr>
                    <form action="php/singup.php" method="post" name="registro-form">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required><br>
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos" required><br>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Correo Electr&oacute;nico" required><br>
                        <select class="form-control" name="area" id="area" required onclik="validarAreaRegistro()">
                            <option value="seleccionar" size>Seleccione una Opción</option>
                            <option value="Antropolog&iacute;a" size>Antropolog&iacute;a</option>
                            <option value="Antropolog&iacute;a F&iacute;sica" size>Antropolog&iacute;a F&iacute;sica</option>
                            <option value="Artes y Letras" size>Artes y Letras</option>
                            <option value="Bibliotecolog&iacute;a" size>Bibliotecolog&iacute;a</option>
                            <option value="Filosof&iacute;a" size>Filosof&iacute;a</option>
                            <option value="Historia" size>Historia</option>
                            <option value="Historia del Arte" size>Historia del Arte</option>
                            <option value="Bibliotecolog&iacute;a" size>Ling&uuml;&iacute;stica</option>
                            <option value="Otra" size>Otra</option>
                        </select><br>
                        <input type="password" class="form-control" name="contrasenna" id="contrasenna" placeholder="Contrase&ntilde;a" required><br>
                        <input type="password" class="form-control" name="contrasenna2" id="contrasenna2" placeholder="Validar Contrase&ntilde;a" onkeyup="verificarPassword()" required><br>
                        <button class="button-color" type="submit" id="btn-registro" onclick="validarAreaRegistro()">Registrarme</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Recuperar Contraseña-->
    <div class="modal fade" id="recuperar" align="center">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                        <br>
                        <h4>Recuperar Contrase&ntilde;a</h4>
                        <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="recuperar-body">
                    <input type="text" class="form-control" name="recuperarEmail" id="recuperarEmail"
                        placeholder="Correo Electr&oacute;nico" required><br>
                    <input type="hidden" name="opcion" value="1">
                    <button class="button button-color" onclick="recuperarContrasenia()">Recuperar Contrase&ntilde;a</button><br><br>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirmacion Recuperar Contraseña-->
    <div class="modal fade" id="mensaje_email" align="center">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <br>
                    <h4>Recuperar Contrase&ntilde;a</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="mensaje_email-body"></div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="container centrar">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" align="center">
                        <br>
                        <h4>Iniciar Sesi&oacute;n</h4>
                        <div class="modal-body">
                            <fb:login-button 
                                data-button-type = "continue_with"
                                class = "fb-login-button"
                                data-size = "large"
                                data-use-continue-as = "true"
                                scope="public_profile,email"
                                onlogin="checkLoginState();">
                            </fb:login-button>   
                            <hr>
                            <div id="InicioSesion">
                                <form action="php/login.php" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="text" class="form-control" name="user" id="usuario"
                                                placeholder="Correo Electr&oacute;nico" size required><br>
                                            <input type="password" class="form-control" name="password" id="pass"
                                                placeholder="Contrase&ntilde;a" size required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10" align="center">
                                            <br><button class="button-color" type="submit">Iniciar
                                                Sesi&oacute;n</button><br><br>
                                            <a class="enlace" href="#" data-toggle='modal' data-tooltip='tooltip'
                                                data-placement='bottom'
                                                title='Click Aqui Para Recuperar tu Contrase&ntilde;a'
                                                data-target='#recuperar'>Recuperar Contrase&ntilde;a</a><br><br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <center><a href="#" data-toggle='modal' data-tooltip='tooltip' data-placement='bottom'
                        title='Click Aqui Para Registrarte' data-target='#registro'>
                        <font color="white">¿No tienes Cuenta? Registrate aqui</font>
                    </a><br><br></center>
            </div>

        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="containner columnaR">
                <center><img src="img/Logo.png" width="25%" height="25%"></center><br><br>
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slider/1.png" alt="Los Angeles" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/2.png" alt="Chicago" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/3.png" alt="New York" width="100%">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>


            </div>
        </div>
    </div>
</body>

</html>