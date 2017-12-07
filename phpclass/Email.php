<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'SaiuTable.php';
require_once 'Utils.php';
require_once 'Utente.php';
require_once 'Prenotazione.php';
require_once 'Tratta.php';
require_once 'Pagamento.php';
require_once 'SaiuDate.php';
require_once 'Pickup.php';
require_once 'Indirizzo.php';
require_once 'Localita.php';


class Email extends SaiuTable {
    //put your code here
    function __construct($id="") {
        //echo "ciao";
        
        $this->setNometabella("email");
        $this->tabella= array("nome"=>"","lingua"=>"","oggetto"=>"","url"=>"","testo"=>"");
       parent::__construct($id);
}
public function getTesto($arraydati) {
    //recupero del testo:
    $testo="";
        if (!$p_file = fopen(Utils::getBase().$this->get('url'),"r")) {
            echo "Spiacente, non posso aprire il file ";
            } else {
            while(!feof($p_file))
                {
                $linea = fgets($p_file, 255);
                $testo.=$linea;
                    }
            fclose($p_file);
            }
        
    //fine recupero testo
    
    if(array_key_exists("idutente", $arraydati))
    {
        $utente=new Utente($arraydati['idutente']);
        $testo=str_replace("#nome#", $utente->get('nome') , $testo);
        $testo=str_replace("#cognome#", $utente->get('cognome') , $testo);
        
    }
    if(array_key_exists("idprenotazione", $arraydati))
    {
        $prenotazione=new Prenotazione($arraydati['idprenotazione']);
        $tratta=new Tratta($prenotazione->get('idtratta'));
        $utente=new Utente($prenotazione->get('idutente'));
        $testo=str_replace("#nome#", $utente->get('nome') , $testo);
        $pagamento= new Pagamento($prenotazione->get('pagamento'));
        $testo=str_replace("#idprenotazione#", $prenotazione->getId() , $testo);
        $testo=str_replace("#cognome#", $utente->get('cognome') , $testo);
        $pickupa=new Pickup($prenotazione->get('pickupa'));
        $indirizzoPickupa=new Indirizzo($pickupa->get('idindirizzo'));
        $testoPickupA= Localita::getName($tratta->get('da'));
                            //=$indirizzoPickupa->get('Comune');
        $testo=str_replace("#pickupa#", $testoPickupA , $testo);
        $testo=str_replace("#costo#", $pagamento->get('cifra') , $testo);
        $testoDropdownA=Localita::getName($tratta->get('a'));
        
        if($prenotazione->get('ar')!=""){ //c'è un ritorno
            $pickupr=new Pickup($prenotazione->get('pickupr'));
            $indirizzoPickupr=new Indirizzo($pickupr->get('idindirizzo'));
            $testoPickupR=Localita::getName($tratta->get('da'));
            $testoPickupR.=", ".$indirizzoPickupr->get('via');
            
        $testoDropdownR="";
        }
        else
        {
            $testoPickupR="##";
        $testoDropdownR="##";
        
        }
        $dataA=  SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupa->get('data'))." ".SaiuDate::getTimeHH_MM($pickupa->get('data'));
        $testo=str_replace("#giornoa#", $dataA , $testo);
        
        $testo=str_replace("#pickupr#", $testoPickupR , $testo);
        $testo=str_replace("#dropdowna#", $testoDropdownA , $testo);
        $testo=str_replace("#dropdownr#", $testoDropdownR , $testo);
        


    }
    $testo=str_replace("#base#", Utils::getBase(), $testo);
    $testo=str_replace("#messaggio#", $arraydati['messaggio'], $testo);
    $testo=str_replace("#nomecognome#", $arraydati['nomecognome'], $testo);
    $testo=str_replace("#email#", $arraydati['email'], $testo);
    return $testo;
    
    
}
public static function getFromNameAndLanguage($name,$language)
{
    $email=  Email::getAll(Email, " where nome='".$name."' and lingua='".$language."'");
    if($email!=false)
    {
        
       
      return $email[0];
    }
    else return false;
    
    
}


    
    
}