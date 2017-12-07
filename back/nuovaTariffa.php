<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once '../inc/headerbackoffice.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/Stagione.php';
require_once '../phpclass/Capienza.php';

//require_once '../phpclass/Tratte.php';
require_once '../phpclass/Localita.php';


session_start();
$arrayLocalita= Localita::getAll(Localita);

//$arrayTratte=  Tratta::getAll(Tratta," order by id desc");
$arrayStagioni=  Stagione::getAll(Stagione);
$arrayCapienze= Capienza::getAll(Capienza);
//inserimento di una nuova tariffa
if($_SESSION['messaggio']!='')
{
    echo "<script>alert(".$_SESSION['messaggio'].")</script>";
    $_SESSION['messaggio']="";
}
?>

<form action="../actions/salvatratta.php" method="post">
    Da:<select name="da" id="da" required>
        <?php
        foreach ($arrayLocalita as $localita) {
            echo "<option value=".$localita->getId().">".$localita->get('nome')."</option>";
        }
        ?>
    </select>
    A:<select name="a" id="a" placeholder="a" required>
        <?php
        foreach ($arrayLocalita as $localita) {
            echo "<option value=".$localita->getId().">".$localita->get('nome')."</option>";
        }
        ?>
    </select>
    tempo rotta in minuti:<input type="number" name="temporotta" id="temporotta" required><br>
    <?php
        foreach ($arrayStagioni as $stagione) 
        {
            echo "<h1>Stagione:".$stagione->get('nome')."</h1>";
            ?>
            
                <?php
        foreach ($arrayCapienze as $capienza) 
            {
            echo "<b>Capienza:".$capienza->get('nome')."</b>";
            ?>
    Prezzo:<input required name="prezzo_<?php echo $stagione->getId().'_'.$capienza->getId() ?>" id="prezzo_<?php echo $stagione->getId().'_'.$capienza->getId() ?>"><br>
            <?php
            }
        }
       
    ?>
    <input type="submit">
    
</form>


<?php


include_once '../inc/footer.php';

?>