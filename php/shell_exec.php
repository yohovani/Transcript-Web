<?php
    require("consulta.php");
    $sql = new consulta();

    shell_exec("python3 ../python/text_detection.py --image ".$ruta_img." --east frozen_east_text_detection.pb");
    shell_exec("python3 ../python/ROIs_Text.py");
    shell_exec();