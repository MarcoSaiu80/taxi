<?php
require_once '../phpclass/Tratta.php';
try{
$tratta= new Tratta($_REQUEST['idtratta']);
$tratta->delete();
echo "ok";
}
 catch (Exception $e)
 {
     echo $e->getMessage();
 }
        
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

