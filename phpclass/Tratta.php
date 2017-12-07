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
require_once 'Connessione.php';
class Tratta extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("tratta");
        $this->tabella= array("da"=>"","a"=>"","costo"=>"","tempo_rotta"=>"");
       parent::__construct($id);
}

public static function getTrattaFromAndTo($da,$a) {
    $sql="select id from tratta where da='".$da."' and a='".$a."'";
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        $tr= new Tratta($r['id']);
        return $tr;
    }
    else
    {/*
        
    $sql="select id from tratta where da='".$a."' and a='".$da."'";
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        $tr= new Tratta($r['id']);
        return $tr;
    }
    else*/ $tr= new Tratta();
        $tr->set('a',$a);
        $tr->set('da',$da);
        $tr->save();
        return $tr;
    }
    
}

/*

public static function getPrezzo($da,$a)
{
    $sql="select costo from tratta where da='".$da."' and a='".$a."'";
    $c= new Connessione($sql);
    if($c->ci_sono_righe())
    {
        $ro= $c->getResult();
        $r= mysql_fetch_array($ro);
        return $r['costo'];
    }
    else return "";
        
}
*/

}
