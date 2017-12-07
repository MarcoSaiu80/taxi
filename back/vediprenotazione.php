<?php
session_start();
$_SESSION['bk']=$_SERVER[REQUEST_URI];//'vediprenotazione.php';
include_once '../inc/headerbackoffice.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/SaiuDate.php';
require_once '../phpclass/Localita.php';
require_once '../phpclass/Tratta.php';

require_once '../phpclass/Indirizzo.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/Capienza.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/Pickup.php';
//riceve l'id della prenotazione e chiede di inserire tutti i campi
//$_SESSION['idprenotazione']
$prenotazione=new Prenotazione($_REQUEST['id']);
$tratta=new Tratta($prenotazione->get('idtratta'));
$utente=new Utente($prenotazione->get('idutente'));
$pickupa=new Pickup($prenotazione->get('pickupa'));
$indirizzopickupa=new Indirizzo($pickupa->get('idindirizzo'));
$pickupr=new Pickup($prenotazione->get('pickupr'));
$indirizzopickupr=new Indirizzo($pickupr->get('idindirizzo'));
$indirizzoUtente=new Indirizzo($utente->get('indirizzoresidenza'));
$dropdowna=new Pickup($prenotazione->get('dropdowna'));
$indirizzodropdowna=new Indirizzo($dropdowna->get('idindirizzo'));
$dropdownr=new Pickup($prenotazione->get('dropdownr'));
$indirizzodropdownr=new Indirizzo($dropdownr->get('idindirizzo'));
$capienza= new Capienza($prenotazione->get('idcapienza'));
$minPass=$capienza->get('min');
$maxPass=$capienza->get('max');
$pagamento=new Pagamento($prenotazione->get('pagamento'));

//selezione della tipologia di pickupandata
$andata=Localita::getName($tratta->get('da'));
if(stripos($andata, "aeroporto")!==false)
{   
    $andata="aeroporto";
}
else
    {
    if(stripos($andata, "porto")!==false)
            $andata="porto";
    else $andata="indirizzo";
    
    }
   
$dropandata=Localita::getName($tratta->get('a'));
if(stripos($dropandata, "aeroporto")!==false)
{   
    $dropandata="aeroporto";
}
else
    {
    if(stripos($dropandata, "porto")!==false)
            $dropandata="porto";
    else $dropandata="indirizzo";
    
    }
   
//ANDIAMO SUL RITORNO    
if($prenotazione->get('ar')!="")
{
    
    $ritorno=Localita::getName($tratta->get('a'));
if(stripos($ritorno, "aeroporto")!==false)
{   
    $ritorno="aeroporto";
}
else
    {
    if(stripos($ritorno, "porto")!==false)
            $ritorno="porto";
    else $ritorno="indirizzo";
    
    }

     $dropritorno=Localita::getName($tratta->get('da'));
if(stripos($dropritorno, "aeroporto")!==false)
{   
    $dropritorno="aeroporto";
}
else
    {
    if(stripos($dropritorno, "porto")!==false)
            $dropritorno="porto";
    else $dropritorno="indirizzo";
    
    }
    
    
    
}

//echo "<script>alert('andata:".$andata." e ritorno:".$ritorno."')</script>";
    
?>
<div id="tabella">
    <form id="formprenotazione" action="" onsubmit="controllaform(this)" method="post" >
    <div id="generici">
	<h1>Riepilogo Prenotazione</h1>
    <div>
	<table>
	<tr>
		<td>
        Da<br> <label id="da" name="da"><?php echo Localita::getName($tratta->get('da'))?></label><input type="hidden" name="idprenotazione" value="<?php echo $prenotazione->getId()?>">
		</td>
		<td>
		</td>
		<td>
		A<br><label id="a" name="a" ><?php echo Localita::getName($tratta->get('a'))?></label>
		</td>
	</tr>
	</table>
	</div>
    
    <div>
        <label>a/r</label><input type="checkbox" id="ar" name="ar" <?php if($prenotazione->get('ar')=='si') echo ' checked '?>  required disabled readonly onchange="controllaform(this)">
    </div>
	<div>
	<table>
	<tr>
	<td>
	Alzatine<br><label><?php echo $prenotazione->get('alzatine')?></label>
	</td>
	<td>
	Seggiolini<br><label><?php echo $prenotazione->get('seggiolini')?></label>
	</td>
	</tr>
	<tr>
	<td colspan="3">
	Costo<br>
	<label><?php echo $pagamento->get('cifra')  ?></label>
	</td>
	</tr>
        <tr>
	<td colspan="3">
	Numero di persone<br>
        <label><input onchange="checkminmax(this,<?php echo $minPass?>,<?php echo $maxPass?>)" required placeholder="<?php echo $minPass ?>" type="number" id="numeropersone" name="numeropersone" min="<?php echo $minPass ?>" max="<?php echo $maxPass ?>"></label>
	</td>
	</tr>
	</table>
	</div>
 
    </div>
    <div id="datiresidenza">
    <h1>Dati Personali</h1>
    
    <div>
        <label>Nome</label><input type="text" id="nome" name="nome" value="<?php echo $utente->get('nome')?>"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>Cognome</label><input type="text" id="cognome" name="cognome" value="<?php echo $utente->get('cognome')?>"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>Email</label><input type="email" id="email" name="email"  required onchange="controllaform(this)" value="<?php echo $utente->get('email')?>">
    </div>
    
    
    <div>
        <label>Nazione</label><input type="text"  id="nazione" name="nazione" value="<?php echo $indirizzoUtente->get('nazione')?>"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>N. Cellulare</label><input type="text"  id="telefono" name="telefono" value="<?php echo $utente->get('telefono') ?>"  required onchange="controllaform(this)">
    </div>
  
        
    </div> <!-- FINE DATI RESIDENZA -->
    <div id="datipickupa">
    <?php
    /*
     * SARANNO IN BASE A COSA
     * 
     */
   
    
    ?>    
        
        
        <h1>Andata</h1> 
		Da <?php echo Localita::getName($tratta->get('da')) ?> a <?php echo Localita::getName($tratta->get('a')) ?> - <?php echo SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupa->get('data')) ?>
               
   
    <!--div>
        <label>arrivo in</label><br>
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="nulla" onclick="controllaform(this)" checked>nessun mezzo<br>  
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="aereo" onclick="controllaform(this)">Aereo<br>
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="nave" onclick="controllaform(this)">Nave<br>
    
    </div-->
    <p>Luogo di partenza</p>
    <?php
switch ($andata) {
    case 'aeroporto':
        
              
        ?>
        <div>
            <label id="numerovolopickupalabel">Codice volo o<br>Aeroporto di partenza</label><input id="numerovolopickupa" value="<?php echo $pickupa->get('numerovolo')  ?>" name="numerovolopickupa" required onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettorepickupa" name="vettorepickupa" value="<?php echo $pickupa->get('vettore') ?>" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzopickupa" id="idindirizzopickupa" >
    </div>
    <div>
        <label>Ora di atterraggio</label> <input type="time" input id="orapickupa" value="<?php echo SaiuDate::getTimeHH_MM($pickupa->get('data')) ?>" name="orapickupa" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzopickupa" id="idindirizzopickupa">
    </div>
        <?php    
        break;
    case 'porto':
        
                
        ?>
        <div>
       <label id="numerovolopickupalabel">Codice nave</label><input id="numerovolopickupa" name="numerovolopickupa" value="<?php $pickupa->get('numerovolo') ?> required onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettorepickupa" name="vettorepickupa" value="<?php echo $pickupa->get('vettore') ?>"  required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzopickupa" id="idindirizzopickupa">
    </div>
    <div>
            <label>Orario arrivo</label> <input id="orapickupa" name="orapickupa" value="<?php echo SaiuDate::getTimeHH_MM($pickupa->get('data')) ?>" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzopickupa" id="idindirizzopickupa">
    </div>
        <?php    
        break;
    default: //indirizzo
        
                
        ?>
     <div>
        <label>Ora</label> <input type="time" id="orapickupa" name="orapickupa" value="<?php echo SaiuDate::getTimeHH_MM($pickupa->get('data')) ?>" required onchange="controllaform(this)">
      
    </div>
         <div>
            <label>Indirizzo/Nome Hotel</label>
            <input id="viapickupa" name="viapickupa" required onchange="controllaform(this)" value="<?php echo $indirizzopickupa->get('via') ?>"  placeholder="Idirizzo o nome hotel">
        </div>
        <?php
        break;
}
    ?>
    
   
    <p>Luogo di destinazione</p>
    <?php
switch ($dropandata) {
    case 'aeroporto':
        
              
                
        ?>
        <div>
       <label id="numerovolodropdownalabel">Codice volo</label><input id="numerovolodropdowna" value="<?php echo $dropdowna->get('numerovolo')  ?>" name="numerovolodropdowna" required onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettoredropdowna" name="vettoredropdowna" value="<?php echo $dropdowna->get('vettore')?>"  required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzodropdowna" id="idindirizzodropdowna">
    </div>
    <div>
        <label>Orario arrivo</label> <input id="oradropdowna" name="oradropdowna" value="<?php echo SaiuDate::getTimeHH_MM($dropdowna->get('data'))  ?>" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzodropdowna" id="idindirizzodropdowna">
    </div>
        <?php    
        break;
    case 'porto':
        
              
        ?>
        <div>
       <label id="numerovolodropdownalabel">Codice nave</label><input id="numerovolodropdowna" value="<?php echo $dropdowna->get('numerovolo')  ?>" name="numerovolodropdowna" required onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettoredropdowna" name="vettoredropdowna" value="<?php echo $dropdowna->get('vettore')  ?>" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzodropdowna" id="idindirizzodropdowna">
    </div>
    <div>
            <label>Orario partenza aereo</label> <input id="oradropdowna" name="oradropdowna" required onchange="controllaform(this)" value="<?php echo SaiuDate::getTimeHH_MM($dropdowna->get('data'))  ?>">
       <input type="hidden" name="idindirizzodropdowna" id="idindirizzodropdowna">
    </div>
        <?php    
        break;
    default: //indirizzo
        
                
        ?>
     
         <div>
            <label>Indirizzo/Nome Hotel</label>
            <input id="viadropdowna" name="viadropdowna" required onchange="controllaform(this)" value="<?php echo $indirizzodropdowna->get('via') ?>"  placeholder="Indirizzo o nome hotel">
        </div>
        <?php
        break;
}
    ?>
    
   
    
       
        
      
    </div><!-- FINE DATI PICKUPANDATA -->    
    
    <!--
    ora i dati di ritorno
    
    -->
    <div id="datipickupr" <?php if($pickupr->get('data')=="") echo "style='display:none'"?>>
    <h1>Ritorno</h1>
    
    Da <?php echo Localita::getName($tratta->get('a')) ?> a <?php echo Localita::getName($tratta->get('da')) ?> - <?php echo SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupr->get('data')) ?>
    <p>Indirizzo di partenza</p>
    <?php
        switch ($ritorno) {
            case 'aeroporto':
                
                ?>
     <div>
         <label>Ora</label> <input type="time" id="orapickupr" name="orapickupr" value= "<?php echo SaiuDate::getTimeHH_MM($pickupr->get('data')) ?>" onchange="controllaform(this)">
      
    </div>
                 <div>
        <label id="numerovolopickuprlabel">Codice volo</label> <input id="numerovolopickupr" value="<?php echo $pickupr->get('numerovolo') ?>" name="numerovolopickupr"  onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettorepickupr" name="vettorepickupr" value="<?php echo $pickupr->get('vettore') ?>"  onchange="controllaform(this)">
      
    </div>
                <?php

                break;
            case 'porto':
               
                ?>
                 <div>
        <label>Ora</label> <input type="time" id="orapickupr" name="orapickupr" value= "<?php echo SaiuDate::getTimeHH_MM($pickupr->get('data')) ?>"  onchange="controllaform(this)">
      
    </div>
                 <div>
        <label id="numerovolopickuprlabel">Codice Nave</label> <input id="numerovolopickupr" value="<?php echo $pickupr->get('numerovolo') ?>"  name="numerovolopickupr"  onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettorepickupr" name="vettorepickupr" value="<?php echo $pickupr->get('vettore') ?>"  onchange="controllaform(this)">
      
    </div>
                <?php
                break;
            default: //indirizzo
            
                ?>
                   <div>
        <label>Ora</label> <input type="time" id="orapickupr" name="orapickupr" value="<?php echo SaiuDate::getTimeHH_MM($pickupr->get('data')) ?>"  onchange="controllaform(this)">
      
    </div>
            <div>
            <label>Indirizzo/Nome Hotel</label> <input id="viapickupr" name="viapickupr" value="<?php echo $indirizzopickupr->get('via') ?>"   onchange="controllaform(this)" placeholder="Indirizzo o nome hotel">
            </div>
                <?php    
                break;
        }
    
    ?>
    
      <p>Luogo di destinazione</p>
    <?php
        switch ($dropritorno) {
            case 'aeroporto':
              
                ?>
     <div>
        <label>Ora di decollo</label> <input type="time" id="oradropdownr" name="oradropdownr" value="<?php echo SaiuDate::getTimeHH_MM($dropdownr->get('data')) ?>"  onchange="controllaform(this)">
      
    </div>
                 <div>
        <label id="numerovolodropdownrlabel">Codice volo</label> <input id="numerovolodropdownr" value="<?php echo $dropdownr->get('numerovolo') ?>" name="numerovolodropdownr"  onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettoredropdownr" name="vettoredropdownr" value="<?php echo $dropdownr->get('vettore') ?>"  onchange="controllaform(this)">
      
    </div>
                <?php

                break;
            case 'porto':
                 
                ?>
                 <div>
        <label>Ora</label> <input type="time" id="oradropdownr" name="oradropdownr" value="<?php echo SaiuDate::getTimeHH_MM($dropdownr->get('data')) ?>"   onchange="controllaform(this)">
      
    </div>
                 <div>
        <label id="numerovolodropdownrlabel">Codice Nave</label> <input id="numerovolodropdownr" value="<?php echo $dropdownr->get('numerovolo') ?>"   name="numerovolodropdownr"  onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>Compagnia</label> <input id="vettoredropdownr" name="vettoredropdownr" value="<?php echo $dropdownr->get('vettore') ?>"   onchange="controllaform(this)">
      
    </div>
                <?php
                break;
            default: //indirizzo
              
                ?>
                   <!--div>
        <label>Ora</label> <input type="time" id="oradropdownr" name="oradropdownr"  onchange="controllaform(this)">
      
    </div-->
            <div>
            <label>Indirizzo/Nome Hotel</label> <input id="viadropdownr" name="viadropdownr" value="<?php echo $indirizzodropdownr->get('via')   ?>" onchange="controllaform(this)" placeholder="Indirizzo o nome hotel">
            </div>
                <?php    
                break;
        }
    
    ?>
	
   
   
    </div> <!-- FINE DATI PICKUPRITORNO -->    
    
    
    <div>
        <script>allReadOnly('formprenotazione')</script>
    </div>
    
</form>
</div> <!-- fine del div tabella -->

<?php
include_once '../inc/footer.php';