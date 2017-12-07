<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author marco
 */
require_once 'Connessione.php';
class Utils {
    //put your code here
 public static   function redirect($url,$secondi=0)
{
    /*if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {*/  
        echo '<script type="text/javascript">';
        echo 'top.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="'.$secondi.';url='.$url.'" />';
        echo '</noscript>';  
    //}
}

public static function destroySession()
{
    session_start();
// Desetta tutte le variabili di sessione.
session_unset();
// Infine , distrugge la sessione.
session_destroy();
}

public static function readRequest()
{
    
foreach($_REQUEST as $key => $val)
{
    $r[$key]=$val;
}
return $r;
}

public static function uploadFile($fileNelRequest,$nomeFinale="",$uploadFolder="",$arrayEstensioni="",$dimensioneMax="")
{
     $cfg=parse_ini_file(dirname(__FILE__)."/cfg.ini",true);
     if($nomeFinale=="")
         $nomeFinale=$fileNelRequest['name'];
     if($uploadFolder=="")
         $uploadFolder=$cfg[upload][folder];
     if($arrayEstensioni=="")
         $arrayEstensioni=split("_",$cfg[upload][estensioni]);
     if($dimensioneMax=="")
         $dimensioneMax=$cfg[upload][dimmax];
     
     
     //INIZIO DELL'UPLOAD
     
 $errore="";    
/*if (isset($fileNelRequest['tmp_name']))
{*/
$fileName=$fileNelRequest['name'];   
echo "<br>Nuovo Upload:<br>filename=".$fileName;
$estensione = strtolower(substr($fileName, strrpos($fileName, "."), strlen($fileName)-strrpos($fileName, ".")));    
echo "<br>estensione:".$estensione."<br>estensioni ammesse:";
$array_estensioni_ammesse=$arrayEstensioni;
print_r($array_estensioni_ammesse);
$uploaddir = $_SERVER["DOCUMENT_ROOT"] . $uploadFolder;
echo "<br>Directory di upload:".$uploaddir."<br>";
$uploadfile = $nomeFinale;
$uploadfile=trim($uploadfile);
if(!in_array($estensione,$array_estensioni_ammesse))
                {
		$errore.="Upload file non ammesso. Estensioni ammesse: ".implode(", ",$array_estensioni_ammesse)."";
//		echo $errore;
                
                }
else{ //echo "per ora va bene";             
$dimensione_massima=$dimensioneMax; //dimensione massima consentita per file in byte -> 1024 byte = 1 Kb
$dimensione_massima_Kb=$dimensione_massima/1024;
if($fileNelRequest['size']>$dimensione_massima)
    {
    $errore.= "<br>IL FILE SELEZIONATO PER L'UPLOAD SUPERA LA DIMENSIONE MASSIMA DI $dimensione_massima_Kb Kb";
    //	echo $errore;
    
    }         
  }
//fine controlle estensione e dimensione                

if ($errore=="" && move_uploaded_file($fileNelRequest['tmp_name'], $uploadFolder.$uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
    $errore.="<br>PROBLEMA NELL'UPLOAD DEL FILE";
    	//echo $errore;
}

if($errore=='')
    //return $cfg[upload][return2].$uploadfile;
    return $uploadFolder.$uploadfile;
else
    {
    echo "<br>Riscontrato errore:".$errore;
    $_SESSION['pgmessaggio']=$errore;
    return "";
    }
     
     //FINE UPLOAD
     
     
     


}

public static function codeString($string)
{/*
$string = str_replace("è", "e'", $string);
$string = str_replace("� ", "a", $string);
$string = str_replace("ò", "o", $string);
$string = str_replace("ì", "i", $string);
$string = str_replace("ù", "u", $string);
$string = ereg_replace("[^A-Za-z0-9 ]", "", $string );
*/
//$string=htmlentities($string, ENT_QUOTES, 'UTF-8');
$string=htmlentities($string);
return $string;
}

public static function decodeString($string)
{
    return html_entity_decode($string);
}


/**
 * 
 * @param type $param
 * restutuisce false nel caso in cui js non sia abilitato facendo uso della session
 */
/*public static function checkJS() {
    <script>
}*/

public static function getJsonFromSql($sql)
{
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

public static function getBase()
{
    return "http://www.taxiaeroportocagliari.com/";
}
        

}

