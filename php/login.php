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
                session_set_cookie_params(3600, "/Transcript");
                header( 'Location: /Transcript/home.php');
            }else{
                echo "<script>alert('Credenciales Erroneas');window.location.href='/Transcript/';</script>";
            }
        }else{
            echo "<script>alert('Credenciales Erroneas');window.location.href='/Transcript/';</script>";
        }
    }

    function facebook(){
        require('conexion.php');
        require_once("consulta.php");
        $sql = new consulta();
        $name = $_POST['name'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        echo $email." , ".$name." , ".$id;
        $sql->setSql("SELECT * FROM usuario WHERE `CorreoElectronico` = '".$email."' AND `Password` = '".$id."'");
        $resultado = $sql->runQuery();
        $usuario_encontrado = 0;
        while($usuario = mysqli_fetch_array($resultado)){
            $idUsuario = $usuario['id'];
            $usuario_encontrado +=1;
        }

        if($usuario_encontrado > 0){
            session_start();
            $_SESSION['id'] = $idUsuario;
            $_SESSION['nombre'] = $name;
            $_SESSION['password'] = $id;
            $_SESSION['area'] = $area;
            header('Location: /Transcript/home.php');
        }else{
            $nombre = explode(' ', $name);
            if($nombre.lenght > 2){
                $sql->setSql("INSERT INTO usuario (`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`CorreoElectronico`,`Password`,`AreaConocimiento`) VALUES ('".$nombre[0]."','".$nombre[1]."','NULL','".$email."','".$id."','Facebook')");
            }else{
                $sql->setSql("INSERT INTO usuario (`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`CorreoElectronico`,`Password`,`AreaConocimiento`) VALUES ('".$nombre[0]."','".$nombre[1]."','".$nombre[2]."','".$email."','".$id."','Facebook')");
            }
            $sql->runQuery();
            $sql->setSql("SELECT * FROM usuario WHERE `CorreoElectronico` = '".$email."' AND `Password` = '".$id."'");
            $resultado = $sql->runQuery();
            $usuario_encontrado = 0;
            while($usuario = mysqli_fetch_array($resultado)){
                $idUsuario = $usuario['id'];
                $usuario_encontrado +=1;
            }

            if($usuario_encontrado > 0){
                session_start();
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $name;
                $_SESSION['password'] = $id;
                $_SESSION['area'] = $area;
                header('Location: /Transcript/home.php');
            }
        }
    }