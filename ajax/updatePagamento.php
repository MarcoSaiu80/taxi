<?php
require_once '../phpclass/Costo.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/SaiuMailer.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/Email.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/Fatturazione.php';

//qua bisogna salvare la questione inerente alla fatturazione//

try{
$r= Utils::readRequest();
$pagamento=new Pagamento($r['idpagamento']);
$pagamento->set('modalita',$r['metodo']);
$pagamento->set('stato','in pagamento');

if($r['metodo']=='paypal'){ //solo nel caso di paypal bisogna creare il pdf
        $fatturazione=new Fatturazione($pagamento->get('idfatturazione'));
        //qua salvi tutti i dati di fatturazione
        $prenotazione= new Prenotazione($r['idprenotazione']);
        $utente= new Utente($prenotazione->get("idutente"));
        $fatturazione->set('indirizzo',$utente->get('indirizzoresidenza'));
        $fatturazione->set('nome',$utente->get('nome'));
        $fatturazione->set('cognome',$utente->get('cognome'));
        $fatturazione->save();
        $fatturazione->set('numeroricevuta',$fatturazione->getId());
        $fatturazione->set('imponibile','');

        //crea il pdf tramite ajax/creaPdf passandogli id fatturazione
        
        $fatturazione->creaPDF();
        $fatturazione->save();
        
                          }


$pagamento->set('idfatturazione',$fatturazione->getId());


$pagamento->save();
echo "ok";

}
 catch (Exception $e)
 {
     echo $e->getMessage();
 }
