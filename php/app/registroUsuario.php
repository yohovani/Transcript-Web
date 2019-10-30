<?php
	require("../conexion.php");

	$json=array();
	
		if(isset($_GET["Nombre"]) && isset($_GET["ApePater"]) && isset($_GET["ApeMater"]) && isset($_GET["CorreoElectronico"]) && isset($_GET["Password"]) && isset($_GET["AreaCono"]))
			{

			$name=utf8_decode($_GET['Nombre']);
			$ap=utf8_decode($_GET['ApePater']);
			$am=utf8_decode($_GET['ApeMater']);	
			$mail=utf8_decode($_GET['CorreoElectronico']);
			$password=utf8_decode($_GET['Password']);
			$area=utf8_decode($_GET['AreaCono']);
			

			$queryRepeated="SELECT * FROM usuario WHERE CorreoElectronico='{$mail}'";
			$resultRepeated=mysqli_query($conexion,$queryRepeated);
			
			if (mysqli_num_rows($resultRepeated)>0) {
				$json['message']='No se puede registrar el usuario ya existe';
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			}else{
				$query="INSERT INTO usuario (id, Nombre, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Password, AreaConocimiento) 
					VALUES (NULL, '{$name}', '{$ap}', '{$am}', '{$mail}', '{$password}', '{$area}')";
				$result=mysqli_query($conexion,$query);
				if($query){
					$json['message']='Se registro exitosamente al usuario: ';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);
					mysqli_close($conexion);
				}	
				else{
					$json['message']='No se pudo registrar verifique el formulario';
					echo json_encode($json);
				}
			}
		}
		else {
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