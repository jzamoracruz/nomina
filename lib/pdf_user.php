<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT * FROM cliente WHERE id_cliente= '$id'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
    
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$nombre_completo= $reg['nombre_completo'];
$salario= $reg['salario'];
$cargo= $reg['cargo'];
$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","",9);
$pdf->SetFontSize(14);
$pdf->Image('../img/logo.png',40,10,-300);
$pdf->SetFont('Arial','B',14);
$pdf->Cell (0,5,utf8_decode('NOMI'),0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->SetFontSize(12);
$pdf->Cell (0,5,utf8_decode('PEPITO PEREZ'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('NIT. 1.111.11.11.1'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Cr 90 # 35-80 Edificio Santriles'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('TEL. 2804524- 6415897'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell (0,5,utf8_decode('Yo Oscar Osorio, director de NOMI'),0,1,'L');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',14);
$pdf->Cell (0,5,utf8_decode('CERTIFICO:'),0,1,'L');
$pdf->SetFont('Arial','',14);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,6,utf8_decode('Que él(a) señor(a):'.' '.'' .$reg['nombre_completo']. ''.' '.'identificado(a) con cedula de ciudadanía No. 000000000'),0,1,'J');

$pdf->SetFont('Arial','',14);
$pdf->Cell (0,6,utf8_decode('de la ciudad de Bogotá labora en la Empresa desde Marzo 05 de 2021 desempeñando'),0,1,'J');
// $pdf->Cell(0,6,utf8_decode('en el cargo de:'.' '.'' .$reg['cargo']. ''.' '.'con un salario de:'.''.''.),0,1,'J');
$pdf->Cell(0,6,'en el cargo de '.$reg['cargo']. ' con un salario de '.'$'.$reg['salario'],0,1,'J');
$pdf->Ln();
$pdf->Cell (0,6,utf8_decode('Para constancia de lo anterior se firma a los diecisiete (17) días del mes de abril'),0,1,'J');
$pdf->Cell (0,6,utf8_decode('del dos mil doce (2022).'),0,1,'J');


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell (0,6,utf8_decode('Cordialmente,'),0,1,'L');

$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,6,utf8_decode('___________________'),0,1,'L');
$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,5,utf8_decode('PEPITO PEREZ'),0,1,'L');
$pdf->Cell (0,5,utf8_decode('C.C. 111.111.11.11'),0,1,'L');

$pdf->output();