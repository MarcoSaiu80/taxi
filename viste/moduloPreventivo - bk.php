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
                    <td>
                        <input ondblclick="location.reload()" name="_da" id="_da" onkeyup="scegliCitta('preventivo_dx_da',this.value)" placeholder="partenza...">
                        <input name="da" id="da" type="hidden">
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="date" name="datada" id="datada" placeholder="data andata aaaa/mm/gg" required>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <input ondblclick="location.reload()" name="_a" id="_a" onkeyup="scegliCitta('preventivo_dx_a',this.value)" placeholder="arrivo...">
                        <input name="a" id="a" type="hidden"><input name="stagione" id="stagione" type="hidden" value="1">
                    </td>
                </tr>
                <tr>
                    <td>
                        a/r<input type="checkbox" value="si" name="ar" id="ar" onclick="andataritorno(this)">
                    </td>
                </tr>
               
                <tr>
                    <td>
                        <input type="date" name="dataa" id="dataa" placeholder="data ritorno aaaa/mm/gg" disabled>
                    </td>
                
                </tr>
                 
                <tr>
                    <td>
                        <select name="idcapienza" required id="idcapienza" onchange="calcolaPreventivo()" >
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
                    <td>
                        Seggiolini:<input required id="seggiolini" name="seggiolini" type="number" min="0" max="5" size="2" value="0" placeholder='0' onchange="calcolaPreventivo()">
                    </td>
                <tr>
                <tr>
                    <td>
                        Alzatine:<input required type="number" onchange="calcolaPreventivo()" name="alzatine" id="alzatine" min="0" max="5" size="2" value="0" placeholder='0'><input type="hidden" id="preventivo" name="preventivo">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" id="calcolapreventivo" value="Calcola Preventivo" onclick="calcolaPreventivo()"><input type="button" value="Reset" onclick="location.reload()"></td></tr>
                <tr><td><input placeholder="inserisci email per ricevere il preventivo..."  type="email" name="email" id="email" style="display: none"><input style="display: none" placeholder="costo..." readonly id="cifra" name="cifra">
                    </td>
                </tr>
                <tr>
                    <td>
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
                        <input required name="tot" type="number" id="tot" size="3"></p>
                    </td>
                </tr>
                <tr><td>
                <input type="submit" id="sottometti" value="">
                    </td>
                </tr>
                
            </table>
        </form>
        
        
        
    </div>
    <div id="preventivo_dx_a"></div>
    <div id="preventivo_dx_da"></div>
</div>

<?php
    include_once '../inc/footer.php';