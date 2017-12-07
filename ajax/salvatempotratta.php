<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../phpclass/Tratta.php';
$tratta=new Tratta($_REQUEST['idtratta']);
$tratta->set('tempo_rotta',$_REQUEST['valore']);
$tratta->save();
echo "ok";