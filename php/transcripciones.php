<?php
    session_start();
    require_once ('conexion.php');
    echo ":v";
    $idTranscripcionUsuario = 1;
    $sqlTranscripciones = "SELECT t.* from transcripcion t INNER JOIN usuario u INNER JOIN usuario_transcripcion ut ON u.id = ut.fkIdUsuario AND t.id = fkIdTranscripcion WHERE u.id = '".$_SESSION['id']."'";
    $sqlEjecucion = mysqli_query($conexion,$sqlTranscripciones) or die(mysqli_error($conexion));
    while($transcripcion = mysqli_fetch_array($sqlEjecucion)){
        echo "<tr>";
        echo "<th scope='row'>".$idTranscripcionUsuario."</th>";
        echo "<th>".utf8_decode($transcripcion['Titulo'])."</th>";
        echo "<th>".$transcripcion['FechaCreacion']."</th>";
        echo "<th>".$transcripcion['UltimaModificacion']."</th>";
        echo "<td class='form-inline justify-content-center' align='center'><button id='btnEditar' class='btn btn-secondary' data-toggle='modal' data-tooltip='tooltip' data-placement='bottom' title='Editar Transcripci&oacute;n' data-target='#edicion' onclick='verTranscripcion(".$transcripcion['id'].")' id='btnEditar'><img src='fonts/edit.svg'>Editar</button>&nbsp;"; 
            echo "<form action='php/pdf.php' method='post' target='_blank'>";
                echo "<input type='hidden' name='idTranscripcion' id='idTranscripcion' value='".$transcripcion['id']."'>";
                echo "<input type='hidden' name='transcripcion' id='transcripcion' value='".$transcripcion['Transcripcion']."'>";
                echo "<input type='hidden' name='titulo' id='titulo' value='".$transcripcion['Titulo']."'>";
                echo "<input type='hidden' name='autor' id='autor' value='".$_SESSION['nombre']."'>";
                echo "<input type='hidden' name='area' id='area' value='".$_SESSION['area']."'>";
                echo "<button type='submit' class='btn btn-success' ><img src='fonts/download.svg'>Descargar</button>&nbsp;";
            echo "</form>";
            echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-tooltip='tooltip' data-placement='bottom' title='Eliminar Transcripci&oacute;n' data-target='#eliminar' onclick='mostrarInformacionEliminar(".$transcripcion['id'].")'><img src='fonts/delete.svg'>Eliminar</button></td>";
        echo "</tr>";
        $idTranscripcionUsuario += 1;
    }
?>