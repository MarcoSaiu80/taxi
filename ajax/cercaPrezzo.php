<?php

require_once '../phpclass/Tratta.php';
require_once '../phpclass/Costo.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/AltriCosti.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$r= Utils::readRequest();
$tratta=  Tratta::getTrattaFromAndTo($r['da'],$r['a']);
$costo=  Costo::getPrezzo($tratta->getId(), $r['stagione'], $r['capienza']);
if($costo!==false)
    {
    
    //aggiungi seggiolini ecc
    
    //fare in modo che il primo seggiolino sia gratis
    $costoseggiolino=AltriCosti::getCostoFromName("seggiolino");
    $alzatina=AltriCosti::getCostoFromName("alzatina");
    $costo+=max($costoseggiolino*($r['seggiolini']-1),0)+$alzatina*$r['alzatine'];
    if($r['ar']=='si')
        $costo=$costo*2;
//echo $costo; = number_format($number, 2, '.', '');
    echo number_format($costo, 2, '.', '');
    }
else echo "";




