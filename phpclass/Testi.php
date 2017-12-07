<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'SaiuTable.php';
class Testi extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("testi");
        $this->tabella= array("nome"=>"","lingua"=>"","testo"=>"");
       parent::__construct($id);
}



    }