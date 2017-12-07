<?php
require_once '../phpclass/Costo.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/SaiuMailer.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/Email.php';
require_once '../phpclass/Utente.php';
$r= Utils::readRequest();
$cost=0;
$c= Costo::getAll(Costo, " where idtratta='".$r['idtratta']."' and idcapienza='".$r['idcapienza']."' and idstagione='".$r['idstagione']."'");
if($c===false) //nn esisteva
{
   $costo=new Costo();
   $costo->loadFromRequest($r);
   $costo->save();
   $cost=$costo->get('prezzo');
}
else 
{
    $c[0]->set('prezzo',number_format($r['prezzo'], 2, '.', ''));
    $c[0]->save();
    $cost=$c[0]->get('prezzo');
    //$costo=$c[0];
}    


$arrPrenotazioni=  Prenotazione::getAll(Prenotazione, " where idtratta=".$r['idtratta']." and preventivo='SI' and idcapienza=".$r['idcapienza']."");
if($arrPrenotazioni!==false)
{
    
    foreach ($arrPrenotazioni as $key => $prenotazione) {
            $utente=new Utente($prenotazione->get('idutente'));
            //SaiuMailer::Email($utente->get('email'), "Preventivo Inserito", "il tuo preventivo è stato inserito, clicca <a href='http://www.taxiaeroportocagliari.com/test2/viste/prenotazione.php?get=1&idprenotazione=".$prenotazione->getId()."'>qua</a> per continuare");
            $e= Email::getFromNameAndLanguage('preventivoinserito', 'it');
            $arraydati['idutente']=$utente->getId();
            $arraydati['idprenotazione']=$prenotazione->getId();
            SaiuMailer::sendEmail($utente->get('email'),$e->get('oggetto'),$e->getTesto($arraydati));
            $prenotazione->set('preventivo',"NO");
            $pagamento=new Pagamento($prenotazione->get('pagamento'));
            $pagamento->set('cifra',$cost);
            $pagamento->save();
            $prenotazione->set('pagamento',$pagamento->getId());
            $prenotazione->save();
    }
        
}
