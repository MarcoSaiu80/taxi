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
class Utente extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("utente");
        $this->tabella= array("nome"=>"","cognome"=>"","indirizzoresidenza"=>"","idfatturazione"=>"","tipo"=>"","livello"=>"","codicefiscale"=>"","urlfoto"=>"","email"=>"","telefono"=>"","password"=>"");
       parent::__construct($id);
}

public static function getFromEmail($email) {
    $risp=Utente::getAll(Utente, " where email='".$email."'");
    if($risp!==false)
    {
        return $risp[0];
    }
    else
    {
        $u= new Utente();
        $u->set('email', $email);
        $u->save();
        return $u;
    }
    
}

public static function getAdmin($email,$psw)
{
    $risp=Utente::getAll(Utente, " where password='".$psw."' and email='".$email."' and tipo<>''");

    if($risp!==false)
    {
        return $risp[0];
    }
    else return false;
}

}