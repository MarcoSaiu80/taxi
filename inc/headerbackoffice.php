<?php
session_start();
require_once '../phpclass/Utils.php';
if($_SESSION['user']=="")
    Utils::redirect("login.php");
?>
<html>
    <head>
        
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <script src="../js/taxy.js"></script>
    </head>
    <body>
        <p> <?php echo "ciao ".$_SESSION['user'] ?><a href="login.php?out=si">Logout</a></p>

