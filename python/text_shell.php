<?php
    ini_set("display_errors", true);
    $nombre = $_GET['nombre'];
    $id = $_GET['id'];
    // RUTA DONDE SE GUARDARAN LAS IMAGENES
    $path = "ImagenesTranscripcion/".$nombre.".jpg";
#    echo "cd ./../../python && python3 text_detection.py --image ./../php/app/".$path." --id ".$id." --east frozen_east_text_detection.pb<br>";
    
 #   echo system("pip3 install imutils 2>&1");
$comando = "python3 /var/www/html/Transcript/python/text_detection.py --image /var/www/html/Transcript/php/app/".$path." --id ".$id." --east /var/www/html/Transcript/python/frozen_east_text_detection.pb 2>&1";
    echo $comando."<br>";
    #echo system("pip3 list");
    echo system($comando);

    
    #    echo shell_exec("cd ./../../python && ROIs_Text.py --id ".$id);
#    echo shell_exec("cd ./../../python && transcripcion.py --id ".$id);
    #    echo shell_exec("ls");
#    echo "python3 ./../../python/text_detection.py --image ".$path." --id ".$id." --east ./../../python/frozen_east_text_detection.pb<br>";
    //Ejecución de la detección de palabras
#    echo exec("python3 ./../../python/text_detection.py --image ".$path." --id ".$id." --east ./../../python/frozen_east_text_detection.pb");
    //Ejecución de la detección de letras por palabra
 #   echo "python3 ./../../python/ROIs_Text.py --id ".$id."<br>";
 #   echo exec("python3 ./../../python/ROIs_Text.py --id ".$id."");
    //Ejecución de la transcripción
 #   echo "python3 ./../../python/transcripcion.py --id ".$id."";
 #   echo exec("python3 ./../../python/transcripcion.py --id ".$id."");