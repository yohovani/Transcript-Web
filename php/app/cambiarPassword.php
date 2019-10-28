<?php
    require("../conexion.php");
    $json=array();
        if(isset($_GET["mail"]) && isset($_GET["password"]) && isset($_GET["newpassword"])){
            $mail=utf8_decode($_GET['mail']);
            $password=utf8_decode($_GET['password']);
            $newpassword=utf8_decode($_GET['newpassword']);

            mysqli_set_charset($conexion, "utf8");
            $consulta="SELECT * FROM usuario WHERE CorreoElectronico='{$mail}' AND Password='{$password}'";
            $resultadoDos=mysqli_query($conexion,$consulta);

            if (mysqli_num_rows($resultadoDos)>0) {
                $query="UPDATE usuario SET Password='{$newpassword}' WHERE CorreoElectronico='{$mail}' AND Password='{$password}'";
                $result=mysqli_query($conexion,$query);
                if($query){
                   $json['message']='Se cambio la contraseña exitosamente';
                   echo json_encode($json,JSON_UNESCAPED_UNICODE);
                   mysqli_close($conexion);
                }else{
                   $json['message']='No se pudo realizar el cambio de contraseña, verifique los datos';
                   echo json_encode($json,JSON_UNESCAPED_UNICODE);
                }

            }else{
                $json['message']='No se pudo realizar el cambio de contraseña, verifique los datos';
                echo json_encode($json,JSON_UNESCAPED_UNICODE);
            }

        }else {
          $json['message']='No se pudo realizar el cambio de contraseña, verifique los datos';
          $results["id"]='';
          $results["Nombre"]='';
          $results["ApellidoPaterno"]='';
          $results["ApellidoMaterno"]='';
          $results["CorreoElectronico"]='';
          $results["Password"]='';
          $results["AreaConocimiento"]='';
          $json['datosUsuario'][]=$results;
          echo json_encode($json,JSON_UNESCAPED_UNICODE);
        }
?>