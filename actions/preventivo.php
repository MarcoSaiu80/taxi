 <?php
session_start();
require_once '../phpclass/Utils.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/SaiuMailer.php';
require_once '../phpclass/Pickup.php';
require_once '../phpclass/SaiuDate.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/Email.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * AZIONI SVOLTE:
 *  CONTROLLA CAPCHA
 *  SALVO INFORMAZIONI
 *  SE IL PREVENTIVO REAL TIME ESISTE ALLORA PASSO ALLA PAGINA PRENOTAZIONE.PHP
 */


if($_SESSION['tot']==$_REQUEST['tot']) // quindi è andata bene
{
    $r=  Utils::readRequest();
    //echo "da e a:".$r['da']." ".$r['a']."<br>";
     $tratta=Tratta::getTrattaFromAndTo($r['da'], $r['a']);  
            
            $prenotazione= new Prenotazione();
            $dropdowna=new Pickup();
            $dropdowna->save();
            $dropdownr=new Pickup();
            $dropdownr->save();
            //aggiungi date
            $pickupa=new Pickup($prenotazione->get('pickupa'));
            $pickupa->set('data',  SaiuDate::getAAAAMMGGfromAAAA_MM_GG($_REQUEST['datada']));
            $pickupr=new Pickup($prenotazione->get('pickupr'));
            $pickupr->set('data',isset($_REQUEST['dataa']) ? SaiuDate::getAAAAMMGGfromAAAA_MM_GG($_REQUEST['dataa']) : "");
            $pickupr->save();
            $pickupa->save();
            $utente=  Utente::getFromEmail($r['email']);
            
            $utente->save();
            
            $prenotazione->set('pickupa', $pickupa->getId());
            $prenotazione->set('pickupr', $pickupr->getId());
            $prenotazione->set('dropdowna', $dropdowna->getId());
            $prenotazione->set('dropdownr', $dropdownr->getId());
            $prenotazione->set('idtratta', $tratta->getId());
            $prenotazione->loadFromRequest($r);
            $pagamento=new Pagamento($prenotazione->get('pagamento'));
            $pagamento->set('stato','non pagato');
            $pagamento->set('cifra',$r['cifra']);
            $pagamento->save();
            $prenotazione->set('pagamento',$pagamento->getId());
            $prenotazione->set('idutente',$utente->getId());
            $prenotazione->save();
            $_SESSION['idprenotazione']=$prenotazione->getId();
    switch ($_REQUEST['preventivo']) { //caso nel quale non esistesse il prezzo
        case 'SI':
        case 'si':
        case 'Si':    
           
            ///invio delle mail
            $e=  Email::getFromNameAndLanguage("preventivorichiesto", "it");
            /*
             * $e= Email::getFromNameAndLanguage('preventivoinserito', 'it');
            $arraydati['idutente']=$utente->getId();
            $arraydati['idprenotazione']=$prenotazione->getId();
            SaiuMailer::sendEmail($utente->get('email'),$e->get('oggetto'),$e->getTesto($arraydati));
            
             */
            $arraydati="";
            SaiuMailer::sendEmail("",$e->get('oggetto'),$e->getTesto($arraydati));
           // SaiuMailer::sendEmail("", "inserita richiesta preventivo", "inserita richiesta preventivo, preventivo numero:".$prenotazione->getId()."<br>Clicca <a href='http://www.taxiaeroportocagliari.com/test2/back/tratte.php'>qua</a> per inserire i dettagli della tratta:");
            echo "email inviata";
            Utils::redirect("../viste/mailinviate.php");
            
            break;
        case 'NO':
        case 'No':
        case 'no':
            
       Utils::redirect("../viste/prenotazione.php");
        break;    
        default:
            break;
    }
}
else{
    echo "niente";
    $_SESSION['errore']='Codice non corretto';
    Utils::redirect($_SERVER['HTTP_REFERER'],0);
}