<?php
    include "consulta.php";
    require("libraries/fpdf/fpdf.php");
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("d/M/Y");
    $id = $_POST['idTranscripcion'];
    $sqlRequest = new consulta();
    $sqlRequest->querySelect("*","transcripcion","id = '".$id."'");
    $resultado = $sqlRequest->runQuery();
    $titulo = "";
    $contenido = "";
    while($transcripcion = mysqli_fetch_array($resultado)){
        $titulo = utf8_decode($transcripcion['Titulo']);
        $contenido = utf8_decode($transcripcion['Transcripcion']);
    }
    $autor = $_POST['autor'];
    $area = $_POST['area'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->setFont('Times','B',12);
    $pdf->Cell(0,10,'',0,2,'R');
    $pdf->Cell(0,10,'Zacatecas, Zac., '.$fecha,0,2,'R');
    $pdf->Ln();
    $pdf->Cell(0,10,"Area de Conocimiento: ".$area,0,2,'L');
    $pdf->Cell(0,10,'Autor: '.$autor,0,2,'L');
    $pdf->Ln();
    $pdf->SetFont('Times');  
    $pdf->Cell(0,10,$titulo,0,2,'C');  
    $pdf->MultiCell(0,6,utf8_decode($contenido),'J');
    $pdf->Output();