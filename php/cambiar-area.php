<?php
    session_start();
    require("consulta.php");
    $sql = new consulta();
    $area = $_POST['area'];
    if(isset($area)){
        $sql->setSql("UPDATE usuario SET AreaConocimiento = '".$_POST['area']."' WHERE id = '".$_SESSION['id']."'");
        $sql->runQuery();
        
        echo "<div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Se ha cambiado el area de conocimiento!</h4>
                <p>Se ha cambiado correctamente su area de conocimiento de ".$_SESSION['area']." a ".$area.".</p>
                <hr>
                <p class='mb-0'><center><button class='btn btn-success' data-dismiss='alert'>Aceptar</button></center></p>
              </div>";
              $_SESSION['area'] = $area;
    }else{
        echo "<div class='alert alert-warning' role='alert'>
                <h4 class='alert-heading'>Se ha cambiado el area de conocimiento!</h4>
                <p>Ocurri&oacute; un error al cambiar su area de conocimiento.</p>
                <hr>
                <p class='mb-0'><center><button class='btn btn-success' data-dismiss='alert'>Aceptar</button></center></p>
              </div>";
    }
    
?>