<?php
   require("../conexion.php");
   $json=array();

        if(isset($_GET["id"]) && isset($_GET["Transcripcion"]) && isset($_GET["Titulo"])){
            $id=utf8_decode($_GET['id']);
            $transcripcion=utf8_decode($_GET['Transcripcion']);
            $titulo=utf8_decode($_GET['Titulo']);

            mysqli_set_charset($conexion, "utf8");
            $consulta="SELECT * FROM transcripcion WHERE id = '{$id}'";
            $resultadoDos=mysqli_query($conexion,$consulta);

            $row=mysqli_fetch_array($resultadoDos);
            $tituloActual=$row['Titulo'];
            $transcripcionActual=$row['Transcripcion'];
            $time=time();
            $date=date("Y-m-d",$time);

            if (mysqli_num_rows($resultadoDos)>0) {
                if ($titulo==$tituloActual) {
                  if ($transcripcion==$transcripcionActual) {
                    $json['message']='El título y el contenido de la transcripción no ha sido cambiado';
                    echo json_encode($json,JSON_UNESCAPED_UNICODE);
                  }else{
                    $query="UPDATE transcripcion SET Transcripcion ='{$transcripcion}', UltimaModificacion='{$date}' WHERE id='{$id}'";
                    $result=mysqli_query($conexion,$query);
                    if($query){
                      $json['message']='Se guardaron los cambios exitosamente';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                      mysqli_close($conexion);
                    }else{
                      $json['message']='No se pudieron guardar los cambios';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                    }
                  }
                }else{
                  if ($transcripcion==$transcripcionActual) {
                    $query="UPDATE transcripcion SET Titulo ='{$titulo}', UltimaModificacion='{$date}' WHERE id='{$id}'";
                    $result=mysqli_query($conexion,$query);
                    if($query){
                      $json['message']='Se guardaron los cambios exitosamente';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                      mysqli_close($conexion);
                    }else{
                      $json['message']='No se pudieron guardar los cambios';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                    }
                  }else{
                    $query="UPDATE transcripcion SET Transcripcion='{$transcripcion}', Titulo='{$titulo}', UltimaModificacion='{$date}' WHERE id='{$id}'";
                    $result=mysqli_query($conexion,$query);
                    if($query){
                      $json['message']='Se guardaron los cambios exitosamente';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                      mysqli_close($conexion);
                    }else{
                      $json['message']='No se pudieron guardar los cambios';
                      echo json_encode($json,JSON_UNESCAPED_UNICODE);
                    }
                  }
                }

            }else{
                $json['message']='No se pudieron guardar los cambios';
                echo json_encode($json,JSON_UNESCAPED_UNICODE);
            }

        }else {
          $results["id"]='';
          $results["Transcripcion"]='';
          $results["Titulo"]='';
          $results["FechaCreacion"]='';
          $results["UltimaModificacion"]='';
          $json['datosUsuario'][]=$results;
          echo json_encode($json,JSON_UNESCAPED_UNICODE);
        }
?>