<?php
use setasign\Fpdi\Fpdi;
require_once File::build_path(array("FPDI-2.3.6","src","Fpdf.php"));
require_once File::build_path(array("FPDI-2.3.6","src","Autoload.php"));


// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile(File::build_path(array("pdf","contrat fa-2.pdf")));
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 10, 10, 100);

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(30, 30);
$pdf->Write(0, 'This is just a simple text');

$pdf->Output('I', 'generated.pdf');
?>
