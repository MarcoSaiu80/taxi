<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connessione
 *
 * @author Saiu
 */
class Connessione {
    //put your code here
    public $row;
    public $dbh;
    public $deb = false;
    public function ci_sono_righe()
    {
        return ($this->numeroRighe()>0) ? true : false;
    }
    public function connect() // si connette fisicamente
         {
        $cfg=parse_ini_file(dirname(__FILE__)."/cfg.ini",true);
        $this->dbh=mysql_connect($cfg[db][host],$cfg[db][user],$cfg[db][password]);
        mysql_select_db($cfg[db][dbname],$this->dbh);
        }
    public function getResult()
        {
        return $this->row;
        }
    public function close()
        {
        mysql_close($this->dbh);
        
        }

    public function  __construct($q="",$debug=false)
        {
        $this->deb=$debug;
        if ($this->deb) echo $q;
        $this->connect();
        if($q!="")
            {$this->query($q);
             $this->close();
            }
        }
    public function query($q)
        {
        if ($this->deb) echo $q;
        if(!($this->row=mysql_query($q,$this->dbh))) $this->row=false;
        //return mysql_query($q,$this->dbh);
        }
    public function numeroRighe()
    {if($this->row==false) {return 0;} 
     else{     return mysql_num_rows($this->row);  }
    

    }
    
    
    
}