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
class Prenotazione extends SaiuTable {
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("prenotazione");
        $this->tabella= array("idcapienza"=>"","idtratta"=>"","pickupa"=>"","dropdowna"=>"","dropdownr"=>"","idutente"=>"","preventivo"=>"","pickupr"=>"","ar"=>"","pagamento"=>"","alzatine"=>"","seggiolini"=>"","numeropersone"=>"");
       parent::__construct($id);
}


    //put your code here
}
