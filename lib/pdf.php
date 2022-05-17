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

$pdf->SetFont('Arial','B',14);
$pdf->Cell (0,5,utf8_decode('DESPRENDIBLE DE NOMINA'),0,1,'L');
$pdf->SetFont('Arial','',14);

$pdf->Ln();
$pdf->Ln();

$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_completo']),1,1,'L');
$pdf->Cell (35,10,'Cargo',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['cargo']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['salario']),1,1,'L');

$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,6,utf8_decode('Cordialmente,'),0,1,'L');

$pdf->Ln();

$pdf->Cell (0,5,utf8_decode('___________________'),0,1,'L');


$pdf->Cell (0,5,utf8_decode('PEPITO PEREZ'),0,1,'L');
$pdf->Cell (0,5,utf8_decode('C.C. 111.111.11.11'),0,1,'L');

$pdf->Cell (0,5,utf8_decode('___________________'),0,1,'R');
$pdf->Cell (0,5,utf8_decode('EMPLEADO'),0,1,'R');
$pdf->Cell (0,5,utf8_decode('C.C. '),0,1,'R');




$pdf->output();