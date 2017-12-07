<?php
require_once '../phpclass/Email.php';
require_once '../phpclass/SaiuMailer.php';
require_once '../phpclass/Utils.php';
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($_SESSION['tot']!=$_REQUEST['tot'])
{
$_SESSION['messaggio']="Numero errato!";    
}
else{
$email= Email::getFromNameAndLanguage("contatto", "it");
$r= Utils::readRequest();
SaiuMailer::sendEmail("", $email->get('oggetto') , $email->getTesto($r));


//poi mandi al cliente

$email= Email::getFromNameAndLanguage("contattocliente", "it");
$r= Utils::readRequest();
SaiuMailer::sendEmail($r['email'], $email->get('oggetto') , $email->getTesto($r));

$_SESSION['messaggio']="Messaggio inviato correttamente";
}
Utils::redirect('../viste/contatti.php');