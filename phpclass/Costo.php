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
require_once 'SaiuTable.php';
require_once 'Connessione.php';
class Costo extends SaiuTable {

    function __construct($id="") {
        
        $this->setNometabella("costo");
        $this->tabella= array("idtratta"=>"","idstagione"=>"","idcapienza"=>"","prezzo"=>"");
       parent::__construct($id);
}

public static function getPrezzo($idtratta,$idstagione,$idcapienza) {
    $sql="select prezzo from costo where idtratta='".$idtratta."' and idstagione='".$idstagione."' and idcapienza='".$idcapienza."'";
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        return $r['prezzo'];
    }
    else return false;
}

    }

