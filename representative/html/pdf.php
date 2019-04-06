<?php
require('pdf/fpdf.php');

$name=$_POST['name'];
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,"Hello ".$name."!",1,0);
$pdf->Image('images/1.jpg',10,25);
$pdf->Output();
?>

