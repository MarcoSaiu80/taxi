<?php
session_start();
if($_REQUEST['out']!="")
{
    session_destroy();
}
//if($_SESSION['superid']!="" )
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    ?>
<form   action="../actions/login.php" method="post">
    <input name="email" id="email" placeholder="email user" required>
    <br>
    <input type="password" name="psw" id="psw" required placeholder="password">
    <br>
    <input type="submit">
</form>