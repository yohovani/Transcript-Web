<?php
    require("../conexion.php");
	$json=array();
	
		if(isset($_GET["mail"]) && isset($_GET["password"])){
			$mail=$_GET['mail'];
			$password=$_GET['password'];
			mysqli_set_charset($conexion, "utf8");
			$query="SELECT * FROM usuario WHERE CorreoElectronico='{$mail}' AND Password='{$password}'";
			$result=mysqli_query($conexion,$query);
			
			if($query){
				if($datos=mysqli_fetch_array($result)){
					$row=mysqli_fetch_array($result);
					$json['datosUsuario'][]=$datos;
					$json['message']='¡Bienvenido ';
				}else{
					$json['message']='No se encontro el usuario o los datos son incorrectos';
				}
				mysqli_close($conexion);
				echo json_encode($json,JSON_UNESCAPED_UNICODE);

			}	
			else{
				$json['message']='No se encontro el usuario o los datos son incorrectos';
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
		}
		else {
			$json['message']='No se encontro el usuario o los datos son incorrectos';
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