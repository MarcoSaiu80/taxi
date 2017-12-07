<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../phpclass/Utils.php';
require_once '../phpclass/Stagione.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Capienza.php';
require_once '../phpclass/Localita.php';
require_once '../phpclass/Costo.php';
try{
$r=Utils::readRequest();
$tratta= new Tratta();
$tratta->set('da',$r['da']);
$tratta->set('a',$r['a']);
$tratta->set('tempo_rotta',$r['temporotta']);
$tratta->save();
$arrayStagioni=  Stagione::getAll(Stagione);
$arrayCapienze= Capienza::getAll(Capienza);

foreach ($arrayStagioni as $stagione) {
        foreach ($arrayCapienze as $capienza) {
            $costo= new Costo();
            $costo->set('idtratta',$tratta->getId());
            $costo->set('idstagione',$stagione->getId());
            $costo->set('idcapienza',$capienza->getId());
            $costo->set('prezzo',$r['prezzo_'.$stagione->getId().'_'.$capienza->getId()]);
            $costo->save();
            
}}

} catch (Exception $e)
{
    $_SESSION['messaggio']=$e->getMessage();
    echo $e->getMessage();
    Utils::redirect("../back/nuovaTariffa.php");
}
    $_SESSION['messaggio']="tratta inserita correttamente";
//



Utils::redirect("../back/nuovaTariffa.php");