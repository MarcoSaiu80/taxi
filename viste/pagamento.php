<?php
session_start();
$_SESSION['idprenotazione']=$_REQUEST['idprenotazione'];

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/Pagamento.php';
include_once '../inc/header.php';
$r= Utils::readRequest();
$prenotazione= new Prenotazione($r['idprenotazione']);
if($prenotazione->get('idutente')!="")  //prenotazione esisteva
{
$utente= new Utente($prenotazione->get('idutente'));
$pagamento=new Pagamento($prenotazione->get('pagamento'));
$pagamento->set("stato", "non pagato");
//richiede + che altro idprenotazione

?>
<body onbeforeunload="cancellaprenotazione('<?php echo $r['idprenotazione']?>')"  onunload="cancellaprenotazione('<?php echo $r['idprenotazione']?>')">
<div id="container">
        <h2>Riepilogo della Prenotazione</h2>
        <h1><b>Nome</b>:<?php echo $utente->get('nome')?></h1>
        <h1><b>Cognome</b>:<?php echo $utente->get('cognome')?></h1>
        

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="formpaypal" id="formpaypal" onsubmit="return controllaform(this)">
    <table>
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="taxiaeroportocagliari@gmail.com">
        <input type="hidden" name="item_name" value="Pagamento prenotazione Taxy Aeroporto Cagliari #<?php echo $prenotazione->getId()?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="tax" value="0">
        <input type="hidden" id="item_number" name="item_number" value="<?php echo $prenotazione->getId()?>" >
        <input type="hidden" name="rm" value="0">
        <input type="hidden" id="amount" name="amount" value="<?php echo $pagamento->get('cifra')?>">
        <!--input type="submit" style="background-image:url('../img/pay_with_paypal_button.png');width:150px;height: 27px; " name="sottometti" id="sottometti" value="" onclick="pagamento(<?php echo $pagamento->getId()?>,paypal)"-->
        
        <p><input type="button" style="" name="pagadopo" id="pagadopo" value="Paga in loco" onclick="pagamento('<?php echo $pagamento->getId()?>','dopo')" text="Paga Dopo">
        <!--input type="button" name="sottometti" id="sottometti" value="Paga con Paypal" onclick="pagamento('<?php echo $pagamento->getId()?>','paypal')"--></p>
        
        </td></tr>
    </table>
    
    
</form>
</div>

<?php
} 
else //errore di richiamo della prenotazione
{
    echo "errore";
}    
    


include_once '../inc/footer.php';
?>

