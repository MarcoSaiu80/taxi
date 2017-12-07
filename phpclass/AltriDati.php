<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Indirizzo
 *
 * @author Saiu
 */
require_once 'SaiuTable.php';
class AltriDati extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("altridati");
        $this->tabella= array("numero"=>"","vettore"=>"","tipo"=>"","capoopposto"=>"","cap"=>"","nazione"=>"","frazione"=>"");
       parent::__construct($id);
}



    }
