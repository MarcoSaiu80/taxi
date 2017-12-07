<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../phpclass/Utils.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/Localita.php';
require_once '../phpclass/SaiuDate.php';
require_once '../phpclass/Pickup.php';
require_once '../phpclass/Indirizzo.php';

$idprenotazione=$_REQUEST['idprenotazione'];
$r= Utils::readRequest();
//salva la prenotazione poi manda al pagamento direttamente
$prenotazione=new Prenotazione($r['idprenotazione']);
$prenotazione->set('numeropersone',$r['numeropersone']);
$pickupa=new Pickup($prenotazione->get('pickupa'));
$dropdowna=new Pickup($prenotazione->get('dropdowna'));
$dropdowna->set('data',$pickupa->get('data'));
$indirizzodropdowna=new Indirizzo($dropdowna->get('idindirizzo'));
$indirizzodropdowna->loadFromRequest($r,"dropdowna");
$indirizzodropdowna->save();
$dropdowna->set("idindirizzo", $indirizzodropdowna->getId());

/*data e ora pickupandata
 * 
 */

$dataAndata=new SaiuDate($pickupa->get('data'));
$oraAndata=  explode(":", $r['orapickupa']);
$dataAndata->setHour($oraAndata[0]);
$dataAndata->setMinute($oraAndata[1]);
$pickupa->set('data',$dataAndata->toAAAAMMGGHHmmSS());
$indirizzopickupa=new Indirizzo($pickupa->get('idindirizzo'));
$indirizzopickupa->loadFromRequest($r,"pickupa");
$indirizzopickupa->save();
$pickupa->set('idindirizzo',$indirizzopickupa->getId());
$pickupa->loadFromRequest($r,"pickupa");


//FINE ORARIOPICKUPA

$dropdownr=new Pickup($prenotazione->get('dropdownr'));
$pickupr=new Pickup($prenotazione->get('pickupr'));
$pickupa->save();

//ora dropdown andata
$dataDropdowna=new SaiuDate($pickupa->get('data'));
if($r['oradropdowna']!=""){
    $oradropdowna=  explode(":", $r['oradropdowna']);
    $dataDropdowna->setHour($oradropdowna[0]);
    $dataDropdowna->setMinute($oradropdowna[1]);
    }
$dropdowna->set('data',$dataDropdowna->toAAAAMMGGHHmmSS());    
$dropdowna->loadFromRequest($r, "dropdowna");
$dropdowna->save();
$prenotazione->set('dropdowna',$dropdowna->getId());
//$pickupa->loadFromRequest($r, "pickupa");
//$indirizzopickupa=new Indirizzo($pickupa->get('idindirizzo'));
//$indirizzopickupa->loadFromRequest($r,"pickupa");
//$indirizzopickupa->save();
//$pickupa->set('idindirizzo',$indirizzopickupa->getId());
//$dataPickup= new SaiuDate($pickupa->get('data'));
//$pickupa->save();
if($pickupr->get('data')!="")
{
$dropdownr->loadFromRequest($r, "dropdownr");

$pickupr->loadFromRequest($r, "pickupr");
$indirizzodropdownr=new Indirizzo($dropdownr->get('idindirizzo'));
$indirizzodropdownr->loadFromRequest($r,"dropdownr");
$indirizzodropdownr->save();
$dropdownr->set("idindirizzo", $indirizzodropdownr->getId());
$dropdownr->set('data',$pickupr->get('data'));
/*if($r['oradropdownr'])
$dropdownr->set('data',$dropdownr->get('data').str_replace(":", "", $r['oradropdownr'])."00");*/

$indirizzopickupr=new Indirizzo($pickupr->get('idindirizzo'));
$indirizzopickupr->loadFromRequest($r,"pickupr");
$indirizzopickupr->save();
$pickupr->set('idindirizzo',$indirizzopickupr->getId());
$dropdownr->save();
$prenotazione->set('dropdownr',$dropdownr->getId());
//ora pickupR
$dataAndata=new SaiuDate($pickupr->get('data'));
if($r['orapickupr']!=""){
    $oraAndata=  explode(":", $r['orapickupr']);
    $dataAndata->setHour($oraAndata[0]);
    $dataAndata->setMinute($oraAndata[1]);

}

$pickupr->set('data',$dataAndata->toAAAAMMGGHHmmSS());

//ora dropdownr

$dataAndata=new SaiuDate($pickupr->get('data'));
if($r['oradropdownr']!=""){
    $oraAndata=  explode(":", $r['orapickupr']);
    $dataAndata->setHour($oraAndata[0]);
    $dataAndata->setMinute($oraAndata[1]);

}

$dropdownr->set('data',$dataAndata->toAAAAMMGGHHmmSS());
$dropdownr->save();

//fine ora dropdownr

}
$pickupr->save();

$prenotazione->set('pickupa',$pickupa->getId());
$prenotazione->set('pickupr',$pickupr->getId());
if($prenotazione->get('idutente')=="")
{
    $utente=  Utente::getFromEmail($r['email']);
}
else
    {
$utente= new Utente($prenotazione->get('idutente'));

    }
$utente->loadFromRequest($r);
$indirizzoUtente=new Indirizzo($utente->get('indirizzoresidenza'));
$indirizzoUtente->loadFromRequest($r);
$indirizzoUtente->save();
$utente->set('indirizzoresidenza',$indirizzoUtente->getId());
$utente->save();
$prenotazione->set('idutente',$utente->getId());
$prenotazione->save();
//SALVATAGGIO



//INVIO DELLE MAIL



Utils::redirect("../viste/pagamento.php?idprenotazione=".$prenotazione->getId());