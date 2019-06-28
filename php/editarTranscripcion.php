<?php
    require_once("conexion.php");
    if(isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['transcripcion'])){
        date_default_timezone_set('America/Mexico_City');
        $modificacion = date("Y:m:d");
        $id = $_POST['id'];
        $titulo = utf8_encode($_POST['titulo']);
        $transcripcion = utf8_encode($_POST['transcripcion']);
        if(preg_match("/^([0-9])/",$id)){
            $sqlEditarTranscripcion = "UPDATE transcripcion SET Titulo = '".$titulo."', Transcripcion = '".$transcripcion."', UltimaModificacion = '".$modificacion."' WHERE id = '".$id."'";
            $sqlEjecucion = mysqli_query($conexion,$sqlEditarTranscripcion) or die(mysqli_error($conexion));
            //Se ejecuta una consulta para mostrar el modal con la información actualizada
            
            echo "<div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4 class='modal-title'><img src='fonts/edit.svg'>Editar</button>&nbsp;</h4>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                        </div>
                        <div id='verTranscripcion'>";
                        require_once("mostrarTranscripcion.php");
                        echo "</div>";
            echo" </div>
                </div>";
                    
            
        }
    }