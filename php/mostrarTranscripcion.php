<?php
    require_once("conexion.php");
    $id = $_POST['id'];
    $sqlSeleccionarTranscripcion = "SELECT * FROM transcripcion WHERE id = '".$id."'";
    $sqlEjecucion = mysqli_query($conexion,$sqlSeleccionarTranscripcion) or die(mysqli_error($conexion));
    while($transcripcion = mysqli_fetch_array($sqlEjecucion)){
        echo "<div class='form-horizontal'>
                <div class='form-group'>
                    <label class='control-label col-sm-2'>Titulo</label>
                    <input type='hidden' name='idTranscripcionEditar' id='idTranscripcionEditar' value='".$transcripcion['id']."'>
                    <div class='col-sm-12'><input type='text' name='editarTitulo' id='editarTitulo' class='form-control' value='".utf8_decode($transcripcion['Titulo'])."'></div>      
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-2'>Contenido</label>
                    <div class='col-sm-12'><textarea name='editarTranscipcion' id='editarTranscripcion' class='form-control' rows='5' >".utf8_decode($transcripcion['Transcripcion'])."</textarea></div>   
                </div> 
                <div class='form-group' align='center'>
                    <button class='btn btn-secondary' data-dismiss='modal' >Cancelar</button>
                    <button class='button-color' onclick='editarTranscripcion()'>Aceptar</button>
                </div> 
            </div>";
    }
    
    