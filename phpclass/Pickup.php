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
class Pickup extends SaiuTable {
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("pickup");
        $this->tabella= array("idindirizzo"=>"","numerovolo"=>"","tipo"=>"","vettore"=>"","capoopposto"=>"","data"=>"");
       parent::__construct($id);
}
    //put your code here
}
