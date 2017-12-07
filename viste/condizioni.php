<?php
include_once '../inc/header_level2.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Capienza.php';
$primo=rand(1,9);
$secondo=rand(1,9);
$arrayCapienze= Capienza::getAll(Capienza);
/*$segno=rand(1,3);
switch($segno)
{
    case 1: //somma
        $tot=$primo+$secondo;    
        break;
    
    case 2: //sottrazione
        $tot=$primo-$secondo;    
        break;
    
    case 3: //moltiplicazione
        $tot=$primo*$secondo;    
        break;
}
*/
$_SESSION['tot']=$primo*10+$secondo;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['errore']))
    echo $_SESSION['errore'];
?>
<div id="container">
<h1>CONDIZIONI</h1>

<p>La ditta S.E. Autonoleggio Taxi aeroporto cagliari di Walter Mereu svolge servizi di Transfer dall' aeroporto di Cagliari verso tutte le strutture ricettive alberghiere della Sardegna.</p>

<p>Per informazioni e pronotazioni vi consigliamo di contattarci prima delle 12 o dopo le 18 per ottenere una risposta immediata.</p>
<p>Le modalità di esecuzione del servizio sono le seguenti:</p>
<h1>IN ARRIVO</h1>
<p>L’ operatore vi accoglierà  nell’ area arrivi dell’ aeroporto di Cagliari con un Cartello recante il vostro Cognome.
Il trasferimento verrà svolto da personale qualificato e professionale che sarà pronto ad accogliere ogni vostra esigenza.
Tutti i veicoli sono dotati di seggiolini  cat. 0, 0+ 1 ,2 ,3.</p>
<p>La nostra ditta prevede due modalità di pagamento:
<ul type=”disc”>
	<li><b>con carta di credito mediante dispositivo paypal</b></li>
	<li><b>in contanti direttamente in loco</b></li>
</ul></p>
<p>La cancellazione della prenotazione sino a 24 ore dal servizio non prevede penali ma il pagamento degli oneri della transazione bancaria, entro le 24 ore dal servizio una penale del 20% per chi paga con carta e del 30% del prezzo relativo al servizio, per chi paga in loco, nel caso di mancata comunicazione della disdetta la penale sarà del 70% della tariffa relativa al servizio sia per chi paga con carta di credito che in loco, per quanto riguarda il rimborso dell'importo vi verranno addebitate le spese dell'operazione che posso variare a seconda dell'istituto bancario.</p>
<p>I clienti avranno un numero di telefono attivo da utilizzare per le urgenze legate al servizio prenotato.</p>
<h1>IN PARTENZA</h1>
<p>Il personale conosce tutte le strutture e località, è consapevole dei tempi di viaggio e gli orari di maggior traffico pertanto saprà indicarvi l’orario esatto di partenza per svolgere le attività aeroportuali e di check-in con tranquillità.</p>

</div>

<?php
    include_once '../inc/footer.php';