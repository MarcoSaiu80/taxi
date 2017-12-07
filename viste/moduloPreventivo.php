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
<div id="modulo_prenotazione">
<div id="prenotazione">
        <form autocomplete="off" id="formpreventivo" name="formpreventivo" onsubmit="return controllaform(this)" action="../actions/preventivo.php" method="get">
            <table>
                
                <tr>
                    <td colspan="3">Da<br>
                        <input ondblclick="location.reload()" name="_da" id="_da" class="preventivo_input" onkeyup="scegliCitta('preventivo_dx_da',this.value)" placeholder="Da:">
                        <input name="da" id="da" type="hidden">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Data Andata<br>
                       
                       <!-- questo solo se siamo su firefox -->
                        <?php
                        if(strstr($_SERVER['HTTP_USER_AGENT'],"Firefox"))
                        {
                             echo '<input name="datada" type="text" id="datada" style="width:200px" placeholder="aaaa/mm/gg" required />';
                        ?>
                        <?php
                        }
                        else
                        {
                            ?>
                            <input type="date" name="datada" id="datada" class="preventivo_input"  onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="aaaa/mm/gg" required >
                            <?php
                        }
                        ?>
                     </td>
                </tr>
                <tr>
                    <td colspan="3">A<br>
                        <input ondblclick="location.reload()" name="_a" id="_a" class="preventivo_input" onkeyup="scegliCitta('preventivo_dx_a',this.value)" placeholder="A:">
                        <input name="a" id="a" type="hidden"><input name="stagione" id="stagione" type="hidden" value="1">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Numero di persone <br>
                        <select name="idcapienza" required id="idcapienza" class="preventivo_input" onchange="calcolaPreventivo()" >
                            <option value="">Numero di persone</option>
                            <?php
                            foreach ($arrayCapienze as $key => $value) {
                                echo "<option value='".$value->getId()."'>".$value->get('nome')." [".$value->get('nomecar')."]</option>";
                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>
  
                <tr>
                    <td colspan="3">
                        a/r<input type="checkbox" value="si" name="ar" id="ar" onclick="andataritorno(this)">
                    </td>
                </tr>
               
                <tr>
                    <td colspan="3">Data ritorno<br>
                      <?php
                        if(strstr($_SERVER['HTTP_USER_AGENT'],"Firefox"))
                        {
                             echo '<input name="dataa" type="text" id="dataa" style="width:200px;disabled:true" disabled placeholder="aaaa/mm/gg" />';
                        ?>
                        <?php
                        }
                        else
                        {
                            ?>
                        <input type="date" name="dataa" id="dataa" class="preventivo_input"  onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="aaaa/mm/gg" required disabled>
                            <?php
                        }
                        ?>
                    </td>
                
                </tr>
                 
                <tr>
                    <td>Seggiolini:</td>
					<td colspan="2">	<input required id="seggiolini" name="seggiolini" type="number" min="0" max="5" size="2" value="0" placeholder='0' onchange="calcolaPreventivo()">
                    </td>
				</tr>
				<tr>
                    <td>Alzatine:</td>
					<td colspan="2"><input required type="number" onchange="calcolaPreventivo()" name="alzatine" id="alzatine" min="0" max="5" size="2" value="0" placeholder='0'><input type="hidden" id="preventivo" name="preventivo">
                    </td>
                </tr>
				
                <tr>
                    <td colspan="3">
                        <input type="button" id="calcolapreventivo" value="Calcola Preventivo" onclick="calcolaPreventivo()"><input type="button" value="Reset" onclick="location.reload()"></td></tr>
                <tr><td><input placeholder="inserisci email per ricevere il preventivo..."  type="email" name="email" id="email" style="display: none"><input style="display: none" placeholder="costo..." readonly id="cifra" name="cifra">
                    </td>
                </tr>
				<tr>
				<td colspan="3">
				Riscrivi i seguenti numeri in cifre
				</td>
				</tr>
                <tr>
                    <td colspan="3">
                         <input style="width: 40px;height: 40px;"  type="image" src="../img/capcha<?php echo $primo ?>">
                <?php
                if(isset($_SESSION['errore'])){
    echo "<script>alert('".$_SESSION['errore']."')</script>";
    unset($_SESSION['errore']);
    
}
              /*  switch ($segno) {
                    case 1:
                        ?>
                <img style="width: 40px;height: 40px;" src="../img/piu.png">
                        <?php

                        break;
                    case 2:
                        ?>
                <img style="width: 40px;height: 40px;" src="../img/meno.png">
                        <?php

                        break;
                case 3:
                        ?>
                <img style="width: 40px;height: 40px;" src="../img/per.png">
                        <?php

                        break;

                    default:
                        break;
                }*/
                ?>
                <input type="image" style="width: 40px;height: 40px;" src="../img/capcha<?php echo $secondo ?>">
                    <!--img src="../img/uguale.png" style="width: 40px;height: 40px;"-->
                        <input required name="tot" type="number" id="tot" size="3" class="preventivo_input" ></p>
                    </td>
                </tr>
                <tr><td colspan="3">
                <input type="submit" id="sottometti" value="">
                    </td>
                </tr>
                
            </table>
        </form>
        
        
        
    </div>
    <div id="preventivo_dx_a"></div>
    <div id="preventivo_dx_da"></div>
</div>
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

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu opera in collaborazione con numerose Aziende cagliaritane. Una tra le più importanti è la <a href="http://www.aservicestudio.com/" target="_blank">"Aservice Studio S.r.l." </a> Azienda leader nell'organizzazione di eventi e meeting sia regionali che nazionali. </p>

<h1>I SERVIZI PIU' RICHIESTI</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari congiunge tra loro le più importanti mete turistiche e commerciali della Sardegna. Di seguito i collegamenti più richiesti dai nostri utenti:</p>
<p>Da Aeroporto Cagliari a Villasimius - Da Aeroporto Cagliari a Costa Rei - Da Aeroporto Cagliari a Chia - Da Aeroporto Cagliari a Santa Margherita di Pula - Da Aeroporto Cagliari a Porto Pino - Da Aeroporto Cagliari a Narbolia Is Arenas - Da Aeroporto Cagliari ad Arbatax - Da Aeroporto Cagliari a Hotel Tanka Village - Da Aeroporto Cagliari a Hotel Forte Village - Da Aeroporto Cagliari a Hotel Timi Ama - Da Aeroporto Cagliari a Cala Serena Village - Da Aeroporto Cagliari a Bravo Club Porto Pino - Da Aeroporto Cagliari a Imbarco Portovesme</p>
</p>
</div>

<?php
    include_once '../inc/footer.php';