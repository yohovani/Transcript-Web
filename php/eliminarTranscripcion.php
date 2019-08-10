<?php
    if($_POST['opcion'] == '1'){
        mostrarModal();
    }else{
        eliminarTrancripcion();
    }

    function mostrarModal(){
        require_once("consulta.php");
        $sql = new consulta();
        $sql->setSql("SELECT * FROM transcripcion WHERE id = '".$_POST['id']."'");
        $resultado = $sql->runQuery();
        $titulo;
        $id;
        while($transcripcion = mysqli_fetch_array($resultado)){
            $titulo = $transcripcion['Titulo'];
        }
        echo "<label class='control-label col-sm-12'>¿En verdad desea eliminar la transcripci&oacute;n: ".utf8_decode($titulo)." ?</label>  
                <form class='form-horizontal'>
                    <div class='form-group' align='center'>
                        <button type='button' class='btn btn-danger' onclick='eliminarTranscripcion(".$_POST['id'].")'><img src='fonts/delete.svg' >&nbsp;Eliminar</button></td>
                        <button class='btn btn-secondary' data-dismiss='modal'><img src='fonts/cancel.svg' >&nbsp;Cancelar</button>
                    </div> 
                 </form>";
    }

    function eliminarTrancripcion(){
        session_start();
        require_once("consulta.php");
        echo "Id Usuario: ".$_SESSION['id']." -> Id Transcripcion: ".$_POST['id'];
        if(isset($_POST['id']) && isset($_SESSION['id'])){
            $sql = new consulta();
            //Elimianar la relacion
            $sql->setSql("DELETE FROM usuario_transcripcion WHERE fkIdUsuario = '".$_SESSION['id']."' AND fkIdTranscripcion = '".$_POST['id']."'");
            $sql->runQuery();
            //Eliminar la Transcripcion
            $sql->setSql("DELETE FROM transcripcion WHERE id = '".$_POST['id']."'");
            $sql->runQuery();
            echo "<div class='alert alert-success' role='alert' align='center'>
                    <h4 class='alert-heading'>La transcripci&oacute;n se ha eliminado de manera correcta</h4>
                    <button class='button-color' data-dismiss='modal'>Aceptar</button>
                </div>";
        }
    }
?>