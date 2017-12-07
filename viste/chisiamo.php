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
<h1>L'AZIENDA</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu opera da anni nel settore dei trasporti congiungendo le più importanti località turistiche e non della Sardegna grazie ad un parco auto assortito ed un personale altamente specializzato. </p>

<p>La sede legale ed operativa dista a 5 minuti dall'Aeroporto di Cagliari ed effettua variati servizi:

<ul type=”disc”>
	<li><b>Trasferimenti da e verso l'Aeroporto di Cagliari</b></li>
	<li><b>Servizi di trasferimento Congressuali</b></li>
	<li><b>Servizi di trasferimento con Auto di Rappresentanza</b></li>
	<li><b>Servizi di accompagnamento per Matrimoni e celebrazioni</b></li>
</ul></p>
 

<p>La nostra azienda dispone di più unità locali: tre localizzate nella Provincia di Cagliari ed una nella provincia di Oristano. Questo per garantire una maggiore copertura del territorio isolano. </p>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu opera in collaborazione con numerose Aziende cagliaritane. Una tra le più importanti è la "Aservice Studio S.r.l." Azienda leader nell'organizzazione di eventi e meeting sia regionali che nazionali. </p>

<h1>HANNO VIAGGIATO CON NOI</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu annovera tra i suoi clienti numerosi personaggi dello spettacolo e dello sport quali:
<ul type=”disc”>
	<li><b>Marco Travaglio</b> (Giornalista e vice direttore de "Il Fatto Quotidiano") </li>
	<li><b>Beppe Grillo</b> (Comico) </li>
	<li><b>Marco Berry</b> (Conduttore e prestigiatore) </li>
	<li><b>Guido Cerasuolo</b> (Regista cinematografico)</li>
	<li><b>Marco Civoli</b> (Cronista Sportivo)</li>
	<li><b>Massimo Martelli</b> (Regista)</li>
	<li><b>Marta Marzotto</b> (Stilista)</li>
	<li><b>Alex Belli</b> (Attore)</li>
	<li><b>Fabrizio Fontana</b> (Comico)</li>
	<li><b>François Modesto</b> (Calciatore)</li>
</ul></p>

<h1>I SERVIZI PIU' RICHIESTI</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari congiunge tra loro le più importanti mete turistiche e commerciali della Sardegna. Di seguito i collegamenti più richiesti dai nostri utenti:</p>
<p>Da Aeroporto Cagliari a Villasimius - Da Aeroporto Cagliari a Costa Rei - Da Aeroporto Cagliari a Chia - Da Aeroporto Cagliari a Santa Margherita di Pula - Da Aeroporto Cagliari a Porto Pino - Da Aeroporto Cagliari a Narbolia Is Arenas - Da Aeroporto Cagliari ad Arbatax - Da Aeroporto Cagliari a Hotel Tanka Village - Da Aeroporto Cagliari a Hotel Forte Village - Da Aeroporto Cagliari a Hotel Timi Ama - Da Aeroporto Cagliari a Cala Serena Village - Da Aeroporto Cagliari a Bravo Club Porto Pino - Da Aeroporto Cagliari a Imbarco Portovesme</p>
</p>
</div>

<?php
    include_once '../inc/footer.php';