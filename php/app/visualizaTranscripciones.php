<?php
	require("../conexion.php");
	$json=array();
	
		if(isset($_GET["mail"])){
			$mail=$_GET['mail'];
			
			mysqli_set_charset($conexion, "utf8");
			$query="SELECT * FROM usuario WHERE CorreoElectronico='{$mail}'";
			$result=mysqli_query($conexion,$query);
			$row=mysqli_fetch_array($result);
			$id=$row['id'];

			$queryTranscripciones="SELECT T.id, T.Transcripcion, T.Titulo , T.FechaCreacion, T.UltimaModificacion FROM usuario_transcripcion UT,transcripcion T WHERE UT.fkIdUsuario='{$id}' AND UT.fkIdTranscripcion = T.id";
			//$resultTranscripciones=mysqli_query($conexion,$queryTranscripciones);
			
			if(!$resultTranscripciones=mysqli_query($conexion,$queryTranscripciones)){
				die();
				$json['exito']=0;	
			}else{

				
				while ($datos=mysqli_fetch_array($resultTranscripciones)) {
					$json['datosTranscripcion'][]=$datos;
				}
				$json['exito']=1;
				mysqli_close($conexion);
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			} 
				
		}
		else {
			$results["id"]='';
			$results["Transcripcion"]='';
			$results["Titulo"]='';
			$results["FechaCreacion"]='';
			$results["UltimaModificacion"]='';
			$json['datosUsuario'][]=$results;
			echo json_encode($json,JSON_UNESCAPED_UNICODE);
		}
?>