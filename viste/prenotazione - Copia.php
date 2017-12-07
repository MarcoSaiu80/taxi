<?php
session_start();
include_once '../inc/header.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/SaiuDate.php';
require_once '../phpclass/Localita.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Utente.php';
require_once '../phpclass/Pagamento.php';
require_once '../phpclass/Pickup.php';
//riceve l'id della prenotazione e chiede di inserire tutti i campi
//$_SESSION['idprenotazione']
if(isset($_REQUEST['get']) && $_REQUEST['get']!="" )
    $idprenotazione=$_REQUEST['idprenotazione'];
    else
    $idprenotazione= $_SESSION['idprenotazione'];

//$jsonLocalita= Localita::getJson(Localita);
//$arrayCitta=json_decode($jsonLocalita,true);
$prenotazione=new Prenotazione($idprenotazione);
$tratta=new Tratta($prenotazione->get('idtratta'));
$utente=new Utente($prenotazione->get('idutente'));
$pickupa=new Pickup($prenotazione->get('pickupa'));
$pickupr=new Pickup($prenotazione->get('pickupr'));
$pagamento=new Pagamento($prenotazione->get('pagamento'));
?>
<div id="tabella">
    <form name="formprenotazione" action="../actions/salvaprenotazione.php" onsubmit="controllaform(this)" >
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
        <label>a/r</label><input type="checkbox" id="ar" name="ar"  required disabled readonly onchange="controllaform(this)">
    </div>
    <div>
        <label>Alzatine</label><input type="number" id="alzatine" name="alzatine"  required readonly onchange="controllaform(this)" value="<?php echo $prenotazione->get('alzatine')?>">
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
	</table>
	</div>
    <div>
        <label>Seggiolini</label><input type="number" id="seggiolini" name="seggiolini" value="<?php echo $prenotazione->get('seggiolini')?>"  required readonly onchange="controllaform(this)">
    </div>
        <div>
            <label>Costo</label><input id="costo" name="costo"  required readonly value="<?php echo $pagamento->get('cifra')  ?>" >
    </div>
    </div>
    <div id="datiresidenza">
    <h1>Dati Personali</h1>
    
    <div>
        <label>Nome</label><input type="text" id="nome" name="nome"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>Cognome</label><input type="text" id="cognome" name="cognome"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>Email</label><input type="email" id="email" name="email"  required onchange="controllaform(this)" value="<?php echo $utente->get('email')?>">
    </div>
    <div>
        <label>Verifica Email</label><input type="email" id="email2" name="email2"  required onchange="controllaform(this)">
    </div>
    
    <div>
        <label>Nazione</label><input type="text"  id="nazione" name="nazione"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>N. Cellulare</label><input type="text"  id="telefono" name="telefono"  required onchange="controllaform(this)">
    </div>
    <div>
        <label>Permetto il trattamento dei miei dati personali</label><input type="checkbox" id="permetto" required name="permetto" onchange="controllaform(this)">
    </div>
        
    </div> <!-- FINE DATI RESIDENZA -->
    <div id="datipickupa">
        <h1>Dati Pickup andata (da <?php echo Localita::getName($tratta->get('da')) ?> a <?php echo Localita::getName($tratta->get('a')) ?>)  <?php echo SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupa->get('data')) ?></h1>
        
    <div>
        <label>giorno</label> <input id="giornopickupa" readonly name="giornopickupa" value="<?php echo SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupa->get('data')) ?>" required onchange="controllaform(this)">
      
    </div>
        
    <div>
        <label>Ora</label> <input type="time" id="orapickupa" name="orapickupa" required onchange="controllaform(this)">
      
    </div>
    <div>
        <label>arrivo in</label><br>
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="nulla" onclick="controllaform(this)" checked>nessun mezzo<br>  
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="aereo" onclick="controllaform(this)">Aereo<br>
        <input type="radio" name="mezzopickupa" id="mezzopickupa" value="nave" onclick="controllaform(this)">Nave<br>
    
    </div>
    <div>
       <label id="numerovolopickupalabel">Codice volo</label><input id="numerovolopickupa" name="numerovolopickupa" required onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>vettore</label> <input id="vettorepickupa" name="vettorepickupa" required onchange="controllaform(this)">
       <input type="hidden" name="idindirizzopickupa" id="idindirizzopickupa">
    </div>
        <div>
            <label>Via Pickup Andata</label>
            <input id="viapickupa" name="viapickupa" required onchange="controllaform(this)">
        </div>
        
        <div>
            <label>Civico Pickup Andata</label>
            <input id="civicopickupa" name="civicopickupa" required onchange="controllaform(this)">
        </div>
    </div><!-- FINE DATI PICKUPANDATA -->    
    
    
    <div id="datipickupr" <?php if($pickupr->get('data')=="") echo "style='display:none'"?>>
    <h1>Dati Pickup Ritorno (da <?php echo Localita::getName($tratta->get('a')) ?> a <?php echo Localita::getName($tratta->get('da')) ?>)  <?php echo SaiuDate::convertAAAAMMGGHHmmSStoGG_MM_AAAA($pickupr->get('data')) ?></h1>
   
        <div>
            <label>giorno</label> <input id="giornopickupr" name="giornopickupr" readonly  onchange="controllaform(this)">
      
    </div>
        
    <div>
        <label>Ora</label> <input id="orapickupr" name="orapickupr"  onchange="controllaform(this)">
      
    </div>
    <div>
        <label>parto in</label><br><input type="radio" name="mezzopickupr" id="mezzopickupr" value="aereo" onclick="controllaform(this)">Aereo
<br>
<input type="radio" name="mezzopickupr" id="mezzopickupr" value="nave" onclick="controllaform(this)">Nave<br>
<input type="radio" name="mezzopickupr" id="mezzopickupr" value="nulla" onclick="controllaform(this)" checked>nessun mezzo      
    </div>
    <div>
        <label id="numerovolopickuprlabel">Codice volo</label> <input id="numerovolopickupr" name="numerovolopickupr"  onchange="controllaform(this)">
      
    </div>    
        <div>
            <label>vettore</label> <input id="vettorepickupr" name="vettorepickupr"  onchange="controllaform(this)">
      
    </div>
         <div>
           <label>Via Pickup Ritorno</label> <input id="viapickupr" name="viapickupr"  onchange="controllaform(this)">
        </div>
        
        <div>
           <label>Civico Pickup Ritorno</label> <input id="civicopickupr" name="civicopickupr"  onchange="controllaform(this)">
        </div>
    </div> <!-- FINE DATI PICKUPRITORNO -->    
    
    
    <div>
        <input type="submit" id="sottometti" name="sottometti" value="Conferma!">
    </div>
    
</form>
</div> <!-- fine del div tabella -->

<?php
include_once '../inc/footer.php';