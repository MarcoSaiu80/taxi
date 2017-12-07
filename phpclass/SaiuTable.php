<?php

/**
 * 
 * La classe ereditata deve avere nel costruttore la struttura del tabella, il nome del tabella eppoi la chiamata a questo costruttore
 * 
 */

/**
 * Description of Saiutabella
 *
 * @author marco
 * @data di ultima modifica 20150210
 */
require_once 'Connessione.php';
class SaiuTable {
    //put your code here
    public $tabella;
    public $id="";
    public $nomeTabella="";
    
    public function getNometabella() {
        return $this->nomeTabella;
    }

    protected function setNometabella($nomeTabella) {
        $this->nomeTabella = $nomeTabella;
    }

        public function getId() {
        return $this->id;
    }

   
    public function setId($id) {
        $this->id = $id;
    }

        public function get($var){
        return $this->tabella[$var];
    }  
    public function set($var,$valore){
        if(isset($this->tabella[$var]))
        $this->tabella[$var]=$valore; 
    }
    
    public function save()
    {
        if($this->getId()=="")
            $this->insertIDIntotabella();
        $this->update();
        
    }
    
    public function toString() {
        if($this->getId()!="")
        {
            $stringa="";
            foreach ($this->tabella as $key => $value) {
                
                $stringa.="$key: $value<br>";
                
            }
            return $stringa;
        }
    }
    
    
  
    protected function oneTOmany($obj2) {
        //serve a creare una corrispondenza molti a molti
    }
    
    
    
    private function insertIDIntotabella() {
        $chiave="";
        if($this->getId()=="")
        {
            
            foreach ($this->tabella as $key => $value) {
                $chiave=$key;
                break;
            }    
            
        $sql="insert into ".$this->getNometabella()."  (".$chiave.") values ('alvon')";
        
          
        $c= new Connessione($sql);
        $sql= "select * from ".$this->getNometabella()." where ".$chiave."='alvon'";
       
        $c= new Connessione($sql);
        $res= $c->getResult();
        $ro=  mysql_fetch_array($res);
        $this->setId($ro['id']);
        $sql="UPDATE ".$this->getNometabella()." SET ".$chiave." = '' WHERE id = ".$this->getId();
       // echo "<br>INSERT ID ".$sql;
        $c= new Connessione($sql);
        }
    }
    
    protected function update() {
        $sql = "UPDATE ".$this->getNometabella()." SET ";
        foreach ($this->tabella as $chiave => $valore) {
             $sql.= $chiave." = '".  mysql_escape_string($valore)."',";
        }
        $sql= substr($sql, 0, strlen($sql)-1);
        $sql.= " WHERE id = ".$this->getId();
       // echo "<br>UPDATE ".$sql;
        $c= new Connessione($sql);            
        
        
    }
    protected function load($id)
    {
        $sql="select * from ".$this->getNometabella()." where id=".$id;
       
        $c= new Connessione($sql);
        if($c->ci_sono_righe())
        {
            $r= $c->getResult();
            $ro= mysql_fetch_array($r);
            $this->loadFromRS($ro);
            
        }
        
    }
    protected function loadFromRS($r)
    {
        foreach ($this->tabella as $chiave => $valore) {
            
                $this->set($chiave, $r[$chiave]);
        }
        $this->setId($r['id']);
    }
    
    public function delete() {
          $sql="delete from ".$this->getNometabella()." where id=".$this->getId();  
       //echo $sql;
          $c=new Connessione($sql);
    }
    
    function __construct($id="") {
        //echo "ciao dalla classe interna";
        $sql="show tables like '".$this->nomeTabella."'";
      
        $c= new Connessione($sql);
        if(!$c->ci_sono_righe())
        {   //create table prova (id int NOT NULL AUTO_INCREMENT,PRIMARY KEY (id))
            $sql="create table ".$this->nomeTabella." (id int NOT NULL AUTO_INCREMENT,PRIMARY KEY (id))";
      
            $c= new Connessione($sql);
            //ALTER TABLE `prova` ADD `nome` TEXT NOT NULL ,ADD `cognome` TEXT NOT NULL ,ADD `ciao` TEXT NOT NULL 
        }
        //per ogni chiave del vettore cerchiamo l'esistenza
        foreach ($this->tabella as $key => $value) {
            $sql="SHOW COLUMNS FROM ".$this->nomeTabella." LIKE '".$key."'";

            $c= new Connessione($sql);
            if(!$c->ci_sono_righe())
            {
                $sql="ALTER TABLE ".$this->nomeTabella." ADD ".$key." TEXT";

                $c= new Connessione($sql);
            }
            
        }
        if($id!="")
        {
            $this->load($id);
        }
        
        
    }
    public function getAl($obj,$completaSql="") {
        $sql="select id as id from ".$this->getNometabella()." ".$completaSql;
        
        $daR= array();
        $c= new Connessione($sql);
        if($c->ci_sono_righe())
        {
           
            $ro= $c->getResult();
            
            while($r= mysql_fetch_array($ro))
            {
                $daR[]= new $obj($r['id']);
     
            }
            return $daR;
        }
        else {  
        
            return false;}
        
    }
    
    
    static function getAll($obj,$completaSql="") {
        $p= new $obj();
        return $p->getAl($obj, $completaSql);
    }
    
    static function getArrayFrom($obj,$nomeProprieta,$valoreProprieta,$completa="") {
        $p= new $obj;
        $sql= "select id from ".$p->getNometabella()." where  ".$nomeProprieta."='".$valoreProprieta."'";
        $sql.=" ".$completa;
        //echo $sql;
        $c= new Connessione($sql);
        if($c->ci_sono_righe())
        {
            $ro= $c->getResult();
            while ($r= mysql_fetch_array($ro))
            {
                $daR[]=new $obj($r['id']);
            }
            return $daR;
        }
        else {
             return false; }
    }
    
    
    public static function esisteValore($obj,$variabile,$valore) {
        $var= new $obj();
        $sql="select id from ".$var->getNomeTabella()." where  ".$variabile."='".$valore."'";
        //echo $sql;
        $c= new Connessione($sql);
        if($c->ci_sono_righe())
        {
            return true;
        }
        else return false;
            
        
    }




    // MOLTI A MOLTI
     /**
     * Funzione da inserire nel costruttore, che stabilisce una corrispondenza molti a molti
     * all'interno del database
     *@param  $obj2 è la tipologia di oggetto con il quale si crea il molti a molti
     * @return true nel caso di operazione effettuata
     * 
     */
    protected function manyTOmany($obj2,$arrayCampiAggiunta="") { //funzione da infilare
        //serve a creare una corrispondenza molti a molti
        //controlla anche il nome inverso perche' nn si sa mai!!!
        $sql="show tables like '".$this->nomeTabella."_".$obj2->getNomeTabella()."'";
        $c= new Connessione($sql);
        if(!$c->ci_sono_righe())
        {
            $sql="show tables like '".$obj2->getNomeTabella()."_".$this->nomeTabella."'";
            if(!$c->ci_sono_righe())
            {
                //caso nel quale non esiste una tabella
                //create taboe $this->nomeTabella."_".$obj2->getNomeTabella()
                $sql="create table ".$this->nomeTabella."_".$obj2->getNomeTabella()." (id int NOT NULL AUTO_INCREMENT,PRIMARY KEY (id))";
                $c= new Connessione($sql);
            }
            else
            {$nomeTabellaMaM=$obj2->getNomeTabella()."_".$this->nomeTabella;}
        }
        else
        {
            //la prima è il nome della tabella MAM
            $nomeTabellaMaM=$this->nomeTabella."_".$obj2->getNomeTabella();
        }
        
        //se nome della tabella inversa esiste allora nome della tabella è quella
        //  senno' do nome questa_quella
        //      controllo esistenza campi e senno' li creo
        //      
        //
        //
        //
        //
        //campi id, id_OBJ1, id_OBJ2 
        
    }
   
    
    protected function setMtM($obj2) {
        
    }
    protected function deleteMtM($obj2) {
        
    }
    /**
     * Stampa una stringa di tutti gli elementi della tabella con 
     */
  
    
    public function loadFromRequest($requestArray,$suffisso="",$debug="")
    {
        foreach ($requestArray as $key => $value) {
            
        if($suffisso!="")
        {
            $pos= strpos($key, $suffisso);
            $senza=  substr($key,0, $pos);
            //echo "senza=".$senza;
        }
        else $senza=$key;
            if(array_key_exists($senza, $this->tabella)){
                    $this->set ($senza, $value);
                    if($debug!="")
                        echo $senza ."=". $value ."<br>";
            }
        }
    }
    

    public static function getJson($obj,$arraycampi="",$completaSql="")
    {
        $cosa="";
        if($arraycampi=="" || count($arraycampi)==0 )
            $cosa=" * ";
        else 
            {
            foreach ($arraycampi as $value) {
                $cosa.=$value.",";
            }
            $cosa=substr($cosa,0,strlen($cosa)-1); //tolgo l'ultima virgola
            }
        $sql=strtolower("select ".$cosa." from ".$obj." ".$completaSql);
        //echo $sql;
        $c= new Connessione($sql);
        if($c->ci_sono_righe())
        {
            $jsonData = array();
            $ro= $c->getResult();
            while($r= mysql_fetch_assoc($ro))
            {
                $jsonData[] = $r;
            }
            return json_encode($jsonData);
        }
        else return "";
        
        
    }
    
   }
