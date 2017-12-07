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
class AltriCosti extends SaiuTable {

    function __construct($id="") {
        
        $this->setNometabella("altricosti");
        $this->tabella= array("nome"=>"","costo"=>"");
       parent::__construct($id);
}
public static function getCostoFromName($nome)
{
    $sql="select costo from altricosti where nome='".strtolower($nome)."'";
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        return $r['costo'];
    }
    else return false;
           
}


    }

