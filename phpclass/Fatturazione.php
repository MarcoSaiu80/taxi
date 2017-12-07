<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Indirizzo
 *
 * @author Saiu
 */
require_once 'fpdf/fpdf.php';
require_once 'SaiuTable.php';
class Fatturazione extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("fatturazione");
        $this->tabella= array("urlpdf"=>"","numeroricevuta"=>"","ragionesociale"=>"","nome"=>"","cognome"=>"","servizio"=>"","imponibile"=>"","dataimmissione"=>"","totale"=>"","via"=>"","civico"=>"","comune"=>"","provincia"=>"","cap"=>"","nazione"=>"","frazione"=>"","partitaiva"=>"");
       parent::__construct($id);
}
function creaPDF()
    {
        $pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',5);
$pdf->Image('../images/logo.png');
$pdf->SetXY("0","30");
$pdf->Cell(00,10,"RICEVUTA DI PAGAMENTO");
$pdf->SetXY("0","30");
$pdf->Cell(0,20,"Ricevuta n.");
$pdf->SetXY("0","30");
$pdf->Cell(0,30,"Ricevuta numero:");
$pdf->SetXY("0","30");
$pdf->Cell(00,40,"Emessa il: 09/10/2016");
$pdf->SetXY("0","30");
$pdf->Cell(0,90,"Ragione sociale:Nome azienda");
$pdf->SetXY("0","30");
$pdf->Cell(00,110,"Nome: Mario");
$pdf->SetXY("0","30");
$pdf->Cell(00,130,"Cognome: Rossi");
$pdf->SetXY("0","30");
$pdf->Cell(00,150,"Codice fiscale/P.iva: 0121498751 (solo per italia)");
$pdf->SetXY("0","30");
$pdf->Cell(00,170,"Servizio offerto: Transfer");
$pdf->SetXY("0","30");
$pdf->Cell(00,190,"Imponibile: 100 euro");
$pdf->SetXY("0","30");   
$pdf->Cell(00,210,"Totale: 110 euro (Iva al 10%)");
$pdf->SetXY("0","30");
$pdf->MultiCell(00,240,"S.E. Autonoleggio Taxi aeroporto Cagliari TM di Walter Mereu \nPhone:+39 320 921 3333 taxiaeroportocagliari@gmail.com \nServizio di transfer aeroporto Cagliari");

$pdf->Output('F','provando.pdf'); 
    } //fine funzione che crea pdf e lo salva su url pdf


    }
