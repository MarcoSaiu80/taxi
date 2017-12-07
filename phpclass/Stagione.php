<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AltriCosti
 *
 * @author user
 */
require_once 'Connessione.php';
require_once 'SaiuTable.php';
require_once 'SaiuDate.php';
class Stagione extends SaiuTable {

    function __construct($id="") {
        
        $this->setNometabella("stagione");
        $this->tabella= array("nome"=>"","inizio"=>"","fine"=>"");
       parent::__construct($id);
}

public static function getSeasonFromDate($saiuDateAAAAMMGG)
{
    $s= new SaiuDate($saiuDateAAAAMMGG);
    $s->setYear("0000");
    $sql="select id from stagione where inizio<=".$s->toAAAAMMGGHHmmSS()." and fine>=".$s->toAAAAMMGGHHmmSS();
  //  echo $sql;
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        $stagione= new Stagione($r['id']);
        return $stagione;
                
    }
    else return false;
}

    }

