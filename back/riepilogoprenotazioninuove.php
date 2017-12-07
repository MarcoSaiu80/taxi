<?php
include_once '../inc/headerbackoffice.php';
require_once '../phpclass/Prenotazione.php';
require_once '../phpclass/Utils.php';
require_once '../phpclass/SaiuDate.php';
session_start();
$dataOdierna=date("Ymd");
//echo $dataOdierna;

/* 

 *  * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/***
 * 
 * CI SARà L'ELENCO DELLE TRATTE CON I COSTI PER STAGIONE E CAPIENZA
 */
/*
$arrayTratte=  Tratta::getAll(Tratta," order by id desc");
$arrayStagioni=  Stagione::getAll(Stagione);
$arrayCapienze= Capienza::getAll(Capienza);
*/
?>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
        <script src="../grid2/js/jquery.columns-1.0.min.js"></script>
        <link id="style" href="../grid2/css/clean.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="../css/filtergrid.css">
        <script src="../js/taxy.js" type="text/javascript"></script>
        <script src="../js/TableFilter/tablefilter_all_min.js"></script>
        
        
        <script>
        var table11_Props = {
    filters_row_index: 1,
    match_case: true,
    remember_grid_values: true
};
var tf11 = setFilterGrid("table11", table11_Props);
        </script>
    </head>
    <body>
        <?php
        $stringaSql= 'select prenotazione.id as id,concat(substr(data,1,4),"-", substr(data,5,2) ,"-", substr(data,7,2)) as datanormale, nome as nome,cognome as cognome ,pickup.data as data from prenotazione,utente,pickup where utente.id=prenotazione.idutente and prenotazione.pickupa=pickup.id and concat(substr(data,1,4), substr(data,5,2) , substr(data,7,2))>="'.$dataOdierna.'" ORDER BY prenotazione.id  ASC';
        if(!isset($_REQUEST['idp'])){
        // $elencoPrenotazioni= Prenotazione::getAll(Prenotazione," ORDER BY id desc");
        ?>
                      <h2>Elenco delle Prenotazioni</h2>
                <div id="example3"></div>

        <script>$.ajax({
            //vecchia stringa select * from pagamenti,prenotazione where pagamenti.idprenotazione=prenotazione.id order by pagamenti.id desc
	url:'<?php echo Utils::getBase() ?>json/jsonFromSql.php?<?php echo $stringaSql ?>',
	dataType: 'json', 
	success: function(json) { 
		example3 = $('#example3').columns({
			data:json, 
                        size:10,
                        showRows:[25,50,100,1000],
                        schema:[
                            {"header":"ID","key":"id","template":"<a href='vediprenotazione.php?id={{id}}'>{{id}}</a>"},
                            
                             
                            {"header":"Data (aaaa-mm-gg)","key":"datanormale",},
                            {"header":"Nome","key":"nome"},
                            {"header":"Cognome","key":"cognome"},
                          //  {"header":"Data","key":"data"},
                           // {"header":"Clienti","key":"clienti","template":"<label>carica clienti</label>"},
                          //  {"header":"Stato","key":"idstato"},
                          //  {"header":"IdPrev","key":"idprev"},
                          {"header":"Elimina","template":"<input onclick=cancellaprenotazioneconconfirm({{id}}) type='button' value='x'>"}
                        ]
		}); 
	}
    }); </script>
        <?php
       $ilJson=  Utils::getJsonFromSql($stringaSql);
        //echo $ilJson;
        ?>
        <script>var dat=<?php echo $ilJson ?>;</script>
        
        <button onclick=JSONToCSVConvertor(dat,'Estazione',true)>Scarica in csv</button> 
        <?php
        
        }
  else
      { //caso nel quale esiste una sola prenotazione
      
        $prenotazione= new Prenotazione($_REQUEST['idp']);
      
      }      
include_once '../inc/footer.php';
        
        ?>