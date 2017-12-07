<?php
// PAGINA DI RITORNO DAL PAGAMENTO
require_once '../phpclass/Prenotazione.php';
//require_once '../phpclass/Utente.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/SaiuDate.php';
require_once '../phpclass/Utente.php';

require_once '../phpclass/Email.php';
require_once '../phpclass/SaiuMailer.php';
include_once '../inc/header.php';
//require_once '../phpclass/TestiEmail.php';
/* 
* A QUESTA PAGINA SI PUO' ARRIVARE SIA DAL MODULO DI PAYPAL CHE DA QUELLO DI PAGO DOPO
 * 
 *  */

if($_REQUEST['metodo']=='pagadopo')
{
    //echo "il metodo è pagadopo e il pagamento è ".$_REQUEST['idp'];
    $pagamento=new Pagamento($_REQUEST['idp']);
    $prenotazione=Prenotazione::getAll(Prenotazione," where pagamento=".$pagamento->getId());
    $utente=new Utente($prenotazione[0]->get('idutente'));
    //echo " la prenotazione è la ".$prenotazione[0]->getId();
    
    //caso nel quale si è deciso di pagare dopo
    $e= Email::getFromNameAndLanguage('prenotazioneeffettuataamministratore', 'it');
    $arraydati[]="";
    
    $arraydati["idprenotazione"]=$prenotazione[0]->getId();
    SaiuMailer::sendEmail("", $e->get('oggetto'), $e->getTesto($arraydati));
    //mail al cliente
    $e= Email::getFromNameAndLanguage('prenotazioneeffettuatacliente', 'it');
    $arraydati[]="";
    $arraydati["idprenotazione"]=$prenotazione[0]->getId();
    SaiuMailer::sendEmail($utente->get('email'), $e->get('oggetto'), $e->getTesto($arraydati));
    
    
    
}
else //caso del pagamento paypal
{

if(isset($_REQUEST['item_number'])){
$prenotazione=new Prenotazione($_REQUEST['item_number']);
$pagamento=new Pagamento($prenotazione->get('pagamento'));
$pagamento->set('data',  SaiuDate::today());
$pagamento->set('modalita',"paypal");
//$pagamento->set('cifra',$_REQUEST['amt']); 
$pagamento->save();
$prenotazione->set('idpagamento', $pagamento->getId());
$prenotazione->save();
$utente=new Utente($prenotazione->get('idutente'));
//invia le mail

$e= Email::getFromNameAndLanguage('prenotazioneeffettuataamministratore', 'it');
$arraydati[]="";
$arraydati["idprenotazione"]=$prenotazione[0]->getId();
SaiuMailer::sendEmail("", $e->get('oggetto'), $e->getTesto($arraydati));
//mail al cliente
$e= Email::getFromNameAndLanguage('prenotazioneeffettuatacliente', 'it');
$arraydati[]="";
$arraydati["idprenotazione"]=$prenotazione[0]->getId();
SaiuMailer::sendEmail($utente->get('email'), $e->get('oggetto'), $e->getTesto($arraydati));

//aggiungi il pdf della fattura


    

}       
               
}
            
?>
<div id="container">
<h1>PRENOTAZIONE INVIATA CON SUCCESSO</h1>

<p>Gentile cliente, la ringraziamo per aver scelto la S.E. Autonoleggio Taxi Aeroporto Cagliari,</p>



</div>
<?php

include_once '../inc/footer.php';