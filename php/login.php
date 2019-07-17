<?php
    if(isset($_POST['user']) && isset($_POST['password'])){
        db();
    }else{
        facebook();
    }

    function db(){
        require('conexion.php');
        $name = $_POST['user'];
        $password = $_POST['password'];
        if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $name) && preg_match("/^([a-zA-Z0-9\._-])+/", $password)){
            $usuario_encontrado = 0;
            $sqlBuscarUsuario = "SELECT * FROM usuario WHERE `CorreoElectronico` = '".$name."' AND `Password` = '".$password."'";
            $sqlEjecucion = mysqli_query($conexion,$sqlBuscarUsuario) or die(mysqli_error($conexion));
            while($resultadoBusquedaUsuario = mysqli_fetch_array($sqlEjecucion)){
                $id = $resultadoBusquedaUsuario['id'];
                $nombre = $resultadoBusquedaUsuario['Nombre'];
                $apellidos = $resultadoBusquedaUsuario['ApellidoPaterno']." ".$resultadoBusquedaUsuario['ApellidoMaterno'];
                $contrasenna = $resultadoBusquedaUsuario['Password'];
                $area = $resultadoBusquedaUsuario['AreaConocimiento'];
                $usuario_encontrado += 1;
            }
            if($usuario_encontrado == 1){
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $nombre." ".$apellidos;
                $_SESSION['password'] = $contrasenna;
                $_SESSION['area'] = $area;
                header( 'Location: /Transcript/home.php');
            }
        }else{
            echo "<script>alert('Credenciales Erroneas');window.location.href='/Transcript/';</script>";
        }
    }

    function facebook(){
       /* session_start();
        $fb = new Facebook\Facebook([
            'app_id' => '2464888593735937', // Replace {app-id} with your app id
            'app_secret' => '{app-secret}',
            'default_graph_version' => 'v3.2',
            ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('fb-callback.php', $permissions);
        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';*/
    }