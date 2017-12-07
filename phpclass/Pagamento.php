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
class Pagamento extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("pagamento");
        $this->tabella= array("data"=>"","cifra"=>"","stato"=>"","note"=>"","modalita"=>"","idfatturazione"=>"");
       parent::__construct($id);
}



    }
