<?php
   ini_set("file_put_contents", true);
   $hostname="localhost";
   $database="transcript";
   $userBD="root";
   $passwordBD="Recovery";
   $json=array();
   
 	$connection=mysqli_connect($hostname,$userBD,$passwordBD,$database);
    $imagen= $_POST['imagen'];
    $nombre = $_POST['nombre'];
    // RUTA DONDE SE GUARDARAN LAS IMAGENES
    $path = "ImagenesTranscripcion/".$nombre.".jpg";
    $actualpath = "http://localhost/Transcript/php/app/".$path;
#    move_uploaded_file($imagen, $actualpath)
    file_put_contents($path, base64_decode($imagen));
    $bytesArchivo=file_get_contents($path);
    $time=time();
    $date=date("Y-m-d",$time);
    $json['message']='La imagen fue enviada al servidor';
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
/*    $sql="INSERT INTO transcripcion (id, Transcripcion, Titulo, FechaCreacion, UltimaModificacion, RutaImagen) VALUES (NULL, NULL, '{$date}', '{$date}', '{$date}', '{$actualpath}')";
    $stm=$connection->prepare($sql);
    if ($stm->execute()) {
    	$json['message']='La imagen fue enviada al servidor';
    	echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }else{
    	 $json['message']='No se pudo enviar la imagen al servidor. Intente de nuevo por favor';
    	 echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }

/*
    require("../conexion.php");
    require("consulta.php");
    $imagen= $_POST['imagen'];
    $nombre = $_POST['nombre'];
    $idUsuario = $_POST['id'];
    // RUTA DONDE SE GUARDARAN LAS IMAGENES
    $path = "ImagenesTranscripcion/$nombre.jpg";
    $actualpath = "localhost/Transcript/$path";
    file_put_contents($path, base64_decode($imagen));
    $bytesArchivo=file_get_contents($actualpath);
    $time=time();
    $date=date("Y-m-d",$time);
    $sql="INSERT INTO transcripcion (id, Transcripcion, Titulo, FechaCreacion, UltimaModificacion, RutaImagen) VALUES (NULL, NULL, '{$date}', '{$date}', '{$date}', '{$actualpath}')";
    $stm=$conexion->prepare($sql);
    if ($stm->execute()) {
        $json['message']='La imagen fue enviada al servidor';
    	echo json_encode($json,JSON_UNESCAPED_UNICODE);
        //Generación de la relación entre el usuario y la transcripcion
        $sql_ = new consulta();
        $sql->setSql("SELECT MAX(id) FROM transcripcion");
        $idTranscripcion = $sql->runQuery();
        $sql->setSql("INSERT INTO usuario_transcripcion (fkIdUsuario, fkIdTranscripcion) VALUES ('".$idUsuario."','".$idTranscripcion."')");
        //Ejecución de los archivos python 
#        shell_exec("python3 ../python/text_detection.py --image ".$ruta_img." --east frozen_east_text_detection.pb");
#        shell_exec("python3 ../python/ROIs_Text.py");
#        shell_exec("python3 ../python/transcripcion.py --id ".$idTranscripcion."");
        $json['message']='La transcripción se realizo correctamente';
    	echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }else{
    	 $json['message']='No se pudo enviar la imagen al servidor. Intente de nuevo por favor';
    	 echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }*/
?>