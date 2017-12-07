<?php
include_once '../inc/header.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Capienza.php';
session_start();
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
if($_SESSION['messaggio']!="")
{
    echo "<script>alert('".$_SESSION['messaggio']."');</script>";
    $_SESSION['messaggio']="";
}
if(isset($_SESSION['errore']))
    echo $_SESSION['errore'];
?>



<div id="container">
<h1>Contatti</h1>

<p>La S.E. Autonoleggio Taxi Aeroporto Cagliari di Walter Mereu opera da anni nel settore dei trasporti congiungendo le più importanti località turistiche e non della Sardegna grazie ad un parco auto assortito ed un personale altamente specializzato. </p>

<p><b>S.E. Autonoleggio Taxi aeroporto Cagliari TM di Walter Mereu</b></p>
<p><b>Taxi aeroporto Cagliari</b></p>
<p><b>C.F. MREWTR82H14G113D</b></p>
<p><b>P.IVA 03130240926</b></p>
<p><b>Ditta iscritta presso la Camera di Commercio di Cagliari nell'Albo Artigiani</b></p>
<p><b>Phone +39 320 921 3333</b></p>
<p><b>Mail: taxiaeroportocagliari@gmail.com</b></p>
<p><b>Servizio di transfer aeroporto Cagliari</b></p>


<p> 


<h1>Inviaci un messaggio, verrai ricontattato!</h1>
<form id="modulocontatti" action="../actions/inviamailcontatto.php" method="post">
    <table class="input_contatti">
        <tr><td>
                <input placeholder="Nome e Cognome" name="nomecognome" required id="nomecognome" onchange="controllaform(this)"></td>
        </tr>
        <tr>
            <td><input placeholder="Indirizzo Email" required name="email" id="email" type="email" onchange="controllaform(this)"></td>
        </tr>
        <tr>
            <td><textarea id="messaggio" name="messaggio" cols="50" rows="10" required placeholder="Inserisci qua il tuo messaggio"></textarea></td>
        </tr>
         <tr>
                    <td>
                         <input style="width: 40px;height: 40px;"  type="image" src="../img/capcha<?php echo $primo ?>">
                         <input style="width: 40px;height: 40px;"  type="image" src="../img/capcha<?php echo $secondo ?>"><p><input type="number" name="tot" id="tot" placeholder="scrivi i numeri qua affianco"></p></td>
        </tr>
        
        <tr>
            <td><input type="submit" value="invia il messaggio"></td>
        </tr>
        
        
    </table>
    
    
</form>
</p>


</div>

<?php
    include_once '../inc/footer.php';