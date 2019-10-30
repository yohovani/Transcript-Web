<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require("../conexion.php");

	$json=array();
	if (isset($_GET["mail"])) {
		$mail=utf8_decode($_GET['mail']);

		mysqli_set_charset($conexion, "utf8");
			

			$query="SELECT * FROM usuario WHERE CorreoElectronico='{$mail}'"or die(mysqli_error($conexion));
			$result=mysqli_query($conexion,$query);

			$count=mysqli_num_rows($result);
			$row=mysqli_fetch_array($result);

			if ($count>0) {
				$user=utf8_decode($row['Nombre']);
				$pass=$row['Password'];
				try{
					$email = new PHPMailer(true);
					$email->SMTPDebug=0;
					$email->IsSMTP(); // telling the class to use SMTP
					$email->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	    			$email->SMTPAuth = true; // enable SMTP authentication
	    			$email->Username = "gsilva.bryan@gmail.com"; // GMAIL username
	    			$email->Password = ""; // GMAIL password
	    			$email->SMTPSecure = "tls"; // sets the prefix to the servier
	    			$email->Port = 587; // set the SMTP port for the GMAIL server

	    			$email->setFrom('gsilva.bryan@gmail.com',"Transcript");
	    			$email->addAddress($mail,$mail);

	    			$email->isHTML(true);
	    			$email->Subject=utf8_decode('Olvido de contraseña');
	    			$email->Body=utf8_decode('Hola '.$user. ' tu contraseña es '.$pass);

	    			$email->send();

	    			$json['message']='El correo electrónico con su contraseña ha sido enviado correctamente';
	    			echo json_encode($json,JSON_UNESCAPED_UNICODE);
	    			mysqli_close($conexion);
				}catch (Exception $e){
					$json['message']="El correo electrónico no ha podido ser enviado correctamente";
					echo json_encode($json,JSON_UNESCAPED_UNICODE);
				}
			}else{
				$json['message']="El correo electrónico no ha podido ser enviado correctamente";
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			}
	}else{
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