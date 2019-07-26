<?php
    require("consulta.php");
    $nombre = $_POST['nombre'];
    $email = strtolower($_POST['email']);
    $area = $_POST['area'];
    $password1 = $_POST['contrasenna'];
    $password2 = $_POST['contrasenna2'];
    $area = $_POST['area'];
    if(strripos($_POST['apellido'], " ") != false){
        list($apellidoPaterno,$apellidoMaterno) = explode(' ',$_POST['apellido']);
        if(preg_match("/[a-zA-Z]/", $nombre) && preg_match("/[a-zA-Z]/", $apellidoPaterno) && preg_match("/[a-zA-Z]/", $apellidoMaterno) && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email) && preg_match("/^([a-zA-Z0-9\._-])+/", $password1)){
            $sql = new consulta();
            $sql->setSql("SELECT * FROM usuario WHERE CorreoElectronico = '".$email."'");
            $resultado = $sql->runQuery();
            $usuario_encontrado = 0;
            while($user = mysqli_fetch_array($resultado)){
                $usuario_encontrado += 1;
            }
            if($usuario_encontrado == 0){
                $sqlRegistro = "INSERT INTO usuario (`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`CorreoElectronico`,`Password`,`AreaConocimiento`) VALUES ('".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$email."','".$password1."','".$area."')";
                registro($sqlRegistro);
            }else{
                echo "<script>alert('Datos de registro no validos');window.location.href='/Transcript/';</script>";
            }

        }else{
            echo "<script>alert('Datos de registro no validos');window.location.href='/Transcript/';</script>";
        }
    }else{
        if(preg_match("/[a-zA-Z]/", $nombre) && preg_match("/[a-zA-Z]/", $_POST['apellido']) && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email) && preg_match("/^([a-zA-Z0-9\._-])+/", $password1)){
            $sql = new consulta();
            $sql->setSql("SELECT * FROM usuario WHERE CorreoElectronico = '".$email."'");
            $resultado = $sql->runQuery();
            $usuario_encontrado = 0;
            while($user = mysqli_fetch_array($resultado)){
                $usuario_encontrado += 1;
            }
            if($usuario_encontrado == 0){
                $sqlRegistro = "INSERT INTO usuario (`Nombre`,`ApellidoPaterno`,`CorreoElectronico`,`Password`,`AreaConocimiento`) VALUES ('".$nombre."','".$_POST['apellido']."','".$email."','".$password1."','".$area."')";
                registro($sqlRegistro);
            }else{
                echo "<script>alert('Datos de registro no validos');window.location.href='/Transcript/';</script>";
            }
        }else{
            echo "<script>alert('Datos de registro no validos');window.location.href='/Transcript/';</script>";
        }
    }

    function registro($sql){
        require_once("conexion.php");
        require_once("login.php");
        $sqlEjecucion = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
        $_POST['user'] = $_POST['email'];
        $_POST['password'] = $_POST['contrasenna'];
        db();
    }