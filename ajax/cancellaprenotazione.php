<?php
require_once '../phpclass/Prenotazione.php';
$idp=$_REQUEST['idprenotazione'];
$p= new Prenotazione($idp);
$p->delete();
echo "ok";


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

