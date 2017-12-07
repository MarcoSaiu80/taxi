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
		case "condizioni.php":
		case "passeggeri.php":
    $arrayLivello1["moduloPreventivo.php"]="Prenota";
    $arrayLivello1["azienda.php"]="L'Azienda";
    $arrayLivello1["flotta.php"]="La Flotta";
    $arrayLivello1["contatti.php"]="Contatti";
    $arrayLivello2["azienda.php"]="chi siamo";
    $arrayLivello2["passeggeri.php"]="hanno viaggiato con noi";
    $arrayLivello2["condizioni.php"]="condizioni";
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
<div id="menu2" class="level2" align="center">
<ul  style="color: rgba(13, 53, 89, 0.9); font-size:20px;"> 
<p>
<?php
$i=0;
foreach ($arrayLivello2 as $key => $value) {
    if($i==0)
    {
        echo "<li class='horizontal first'><a href=".$key.">".$value."</a></li>";
        $i++;
    }
    else
        echo "<li class='horizontal'><a href=".$key.">".$value."</a></li>";
}
?>
</ul>
</p>
</div>
</div>
<!-- FINE HEADER -->

<div id="content"><p></p></div>
<div id="corpo">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>