<?php
   $hostname="localhost";
   $database="transcript";
   $userBD="root";
   $passwordBD="Recovery";
   $json=array();
   
 	$connection=mysqli_connect($hostname,$userBD,$passwordBD,$database);

    $imagen= $_POST['imagen'];
    $nombre = $_POST['nombre'];

    // RUTA DONDE SE GUARDARAN LAS IMAGENES
    $path = "ImagenesTranscripcion/$nombre.jpg";
    $actualpath = "http://192.168.43.145/Transcript/php/app/$path";
    file_put_contents($path, base64_decode($imagen));
    $bytesArchivo=file_get_contents($path);

    $time=time();
    $date=date("Y-m-d",$time);

    $sql="INSERT INTO transcripcion (id, Transcripcion, Titulo, FechaCreacion, UltimaModificacion, RutaImagen) VALUES (NULL, NULL, '{$date}', '{$date}', '{$date}', '{$actualpath}')";
    $stm=$connection->prepare($sql);
    if ($stm->execute()) {
      include "../conexion.php";
      //Selección del id de la ultima transcripción registrada
      $resultado = mysqli_query($conexion,"SELECT MAX(id) as id FROM transcripcion") or die(mysqli_error($conexion));
      $idTranscripcion = mysqli_fetch_array($resultado);
      //Asignación de la transcripción al usuario
      $relacion = mysqli_query($conexion, "INSERT INTO usuario_transcripcion (fkIdUsuario, fkIdTranscripcion) VALUES ('".$_POST['id']."','".$idTranscripcion[0]."')");
#     exec("php7 transcripcion.php");
      //Ejecución del modulo de transcripción
        //Ejecución de la detección de palabras
        shell_exec("python3 ./../../python/text_detection.py --image ".$path." --id ".$idTranscripcion[0]." --east ./../../python/frozen_east_text_detection.pb");
        //Ejecución de la detección de letras por palabra
      shell_exec("python3 ./../../python/ROIs_Text.py --id ".$idTranscripcion[0]."");
        //Ejecución de la transcripción
      exec("python3 ./../../python/transcripcion.py --id ".$idTranscripcion[0]."");
        //Mensaje a la aplicaición que indica que la transcripción ya fue realizada
      $json['message']='La imagen fue enviada al servidor';  
      echo json_encode($json,JSON_UNESCAPED_UNICODE);
    	
    	echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }else{
    	 $json['message']='No se pudo enviar la imagen al servidor. Intente de nuevo por favor';
    	 echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }
?>