<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Capienza
 *
 * @author marco
 */
require_once 'SaiuTable.php';
class Capienza extends SaiuTable {
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("capienza");
        $this->tabella= array("nome"=>"","max"=>"","intervallo"=>"","nomecar"=>"","min"=>"");
       parent::__construct($id);
}
    //put your code here
}
