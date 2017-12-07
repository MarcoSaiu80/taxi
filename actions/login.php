<?php
session_start();
//session_unset();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../phpclass/Utente.php';
require_once '../phpclass/Utils.php';


$r= Utils::readRequest();


$user= Utente::getAdmin($r['email'], $r['psw']);
if($user!==false)
{
   $_SESSION['user']=$user->get('nome');
   
}
else $_SESSION['user']="";

if($_SESSION['bk']!="")
    Utils::redirect($_SESSION['bk']);
else
    Utils::redirect("../back/");