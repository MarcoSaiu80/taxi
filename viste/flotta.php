<?php
include_once '../inc/header.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Capienza.php';
$primo=rand(1,9);
$secondo=rand(1,9);
$arrayCapienze= Capienza::getAll(Capienza);
/*$segno=rand(1,3);
switch($segno)
{
    case 1: //somma
        $tot=$primo+$secondo;    
        break;
    
    case 2: //sottrazione
        $tot=$primo-$secondo;    
        break;
    
    case 3: //moltiplicazione
        $tot=$primo*$secondo;    
        break;
}
*/
$_SESSION['tot']=$primo*10+$secondo;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['errore']))
    echo $_SESSION['errore'];
?>
<div id="container">
<h1>LA FLOTTA</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu opera da anni nel settore dei trasporti congiungendo le più importanti località turistiche e non della Sardegna grazie ad un parco auto assortito ed un personale altamente specializzato. </p>

<p>L'Azienda dispone di numerose vetture in grado di soddisfare le differenti esigenze dei viaggiatori.</p>
<p><img src="../img/taxi_aeroporto_cagliari_01.jpg" width="100%"></p>

<h1>Mercedes Classe E: indicato da 1 a 3 persone </h1>

<p><img src="../img/taxi_aeroporto_cagliari_02.jpg" width="100%"></p>
 
<h1>Volkswagen Multivan: indicato da 1 a 5 persone</h1>

<p><img src="../img/taxi_aeroporto_cagliari_04.jpg" width="100%"></p>

<h1>Peugeot Tepee: indicato da 1 a 4 persone</h1>

<p><img src="../img/taxi_aeroporto_cagliari_03.jpg" width="100%"></p>

<h1>Opel Vivaro: indicato da 1 a 8 persone</h1>

<p>Il servizio viene svolto all'interno dell'Aeroporto di Cagliari. I nostri operatori vi accoglieranno con un cartello recante il vostro nominativo per poi accompagnarvi direttamente verso la località prescelta. Il veicolo è totalmente riservato per la persona che prenota il trasferimento.</p>
<p>Su richiesta sarà possibile fornire seggiolini e alzate, nel rispetto delle più recenti normative di legge, appartenenti ai gruppi 0, 0+, 1, 2 e 3.</p> 
<h1>I SERVIZI PIU' RICHIESTI</h1>
<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari congiunge tra loro le più importanti mete turistiche e commerciali della Sardegna. Di seguito i collegamenti più richiesti dai nostri utenti:</p>
<p>Da Aeroporto Cagliari a Villasimius - Da Aeroporto Cagliari a Costa Rei - Da Aeroporto Cagliari a Chia - Da Aeroporto Cagliari a Santa Margherita di Pula - Da Aeroporto Cagliari a Porto Pino - Da Aeroporto Cagliari a Narbolia Is Arenas - Da Aeroporto Cagliari ad Arbatax - Da Aeroporto Cagliari a Hotel Tanka Village - Da Aeroporto Cagliari a Hotel Forte Village - Da Aeroporto Cagliari a Hotel Timi Ama - Da Aeroporto Cagliari a Cala Serena Village - Da Aeroporto Cagliari a Bravo Club Porto Pino - Da Aeroporto Cagliari a Imbarco Portovesme
</p>


</div>

<?php
    include_once '../inc/footer.php';