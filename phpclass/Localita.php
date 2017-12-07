<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Localita
 *
 * @author user
 */
require_once 'SaiuTable.php';
class Localita extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("localita");
        $this->tabella= array("nome"=>"","provincia"=>"","cap"=>"","codice"=>"","solodestinazione"=>"");
       parent::__construct($id);
}

public static function getName($id) {
    $l= new Localita($id);
    return $l->get('nome');
    
}


}
