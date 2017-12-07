<?php
session_start();
$nome = basename($_SERVER['PHP_SELF']);
switch (basename($_SERVER['PHP_SELF']))
{
    case "moduloPreventivo.php":
    case "azienda.php":
    case "flotta.php":
    case "contatti.php":
    case "grazie.php":
    case "mailinviate.php":    
    case "prenotazione.php":
    case "pagamento.php":
    $arrayLivello1["moduloPreventivo.php"]="Prenota";
    $arrayLivello1["azienda.php"]="L'Azienda";
    $arrayLivello1["flotta.php"]="La Flotta";
    $arrayLivello1["contatti.php"]="Contatti";
    $arrayLivello2["#"]="uno";
    $arrayLivello2["#2"]="due";
    $arrayLivello2["#3"]="tre";
    break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiAeroportoCagliari | Servizio Transfer Aeroportauli</title>
<meta name="keywords" content="like home" />
<meta name="description" content="Taxi Aeroporto Cagliari - Servizi di transfer in tutta la sardegna +39 320 921 333" />
<!--link rel="stylesheet" type="text/css" media="all" href="../css/fonts/stylesheet.css" />
<link rel="stylesheet" type="text/css" media="all" href="../css/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="../js/calendar.js"></script>
<script type="text/javascript" src="../js/calendar-it.js"></script>
<script type="text/javascript" src="../js/cale.js"></script-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    
    <!-- Load jQuery JS -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Load jQuery UI Main JS  -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
    /*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
$(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datada" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true, //this option for allowing user to select from year range
      dateFormat: 'yy-mm-dd'
    });
    $( "#dataa" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true, //this option for allowing user to select from year range
      dateFormat: 'yy-mm-dd'
    });
  }

);
    
    </script>    
<link href="favicon.ico" rel="shortcut icon" type="../image/vnd.microsoft.icon" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/taxy.js"></script>

</head>

<body>
<div id="background" >	

<!-- INIZIO HEADER -->
<div id="header">
<div id="logo" align="center"><img src="../images/logo.png"><a href="tel:+39 320 921 3333"><img src="../images/phone.png"></a>
</div>
<div id="menu1" class="level1" align="center" >
<h1 style="color:white; font-size:24px;"> 
<ul> 
<?php
$i=0;
foreach ($arrayLivello1 as $key => $value) {
    if($i==0)
    {
        $i++;
        echo "<li class='horizontal first'><a href=".$key.">".$value."</a></li>";
    }
    else
    echo "<li class='horizontal'><a href=".$key.">".$value."</a></li>";
}
?>
    
</ul>
</h1>
</div>

</div>
<!-- FINE HEADER -->

<div id="content"><p></p></div>
<div id="corpo">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>