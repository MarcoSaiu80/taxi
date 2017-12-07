/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**************
 * 
 * FUNZIONI TIPICHE
 * 
 * 
 */

var elencoDa= new Array();
var elencoA= new Array();

function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    //Set Report title in first row or line
    
    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);
        
        //append Label row with line break
        CSV += row + '\r\n';
    }
    
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    //Generate a file name
    var fileName = "MyReport_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   
    
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}



 function CreateXmlHttpReq(handler) 
        {
         var ProgID = ["Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.3.0", "Microsoft.XMLHTTP"];            
        var xmlhttp = null;
        try {
	xmlhttp = new XMLHttpRequest();
          } catch(e) {
               for (var i = 0; i < ProgID.length; i++)
                {
                    try
                    {
                        xmlhttp = new ActiveXObject(ProgID[i]);
                    }
                    catch(e)
                    {                        
                        continue;
                    }
                }
	
        }
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
        }


function ajaxsaiuasync(funzionephp,querystring)
{
    var richiestasaiu=null;
        richiestasaiu = CreateXmlHttpReq(doNothing); 
        richiestasaiu.open("POST",funzionephp,true); 
        richiestasaiu.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8"); 
       	richiestasaiu.send(querystring); 
        return richiestasaiu.responseText;
}
function doNothing()
{
    //il titolo dovrebbe dire tutto
}

function ajaxsaiu(funzionephp,querystring)
{
   // alert(funzionephp);
        var richiestasaiu=null;
        richiestasaiu = CreateXmlHttpReq(doNothing); 
        richiestasaiu.open("POST",funzionephp,false); 
        richiestasaiu.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8"); 
       	richiestasaiu.send(querystring); 
        return richiestasaiu.responseText;
}

function elemento(nomeid)
{
    return document.getElementById(nomeid);
}



function isEmail(emailStr) {
	        var emailPat = /^(.+)@(.+)$/;
	        var specialChars = "\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
	        var validChars = "[^\\s" + specialChars + "]";
	        var quotedUser = "(\"[^\"]*\")";
	        var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	        var atom = validChars + "+";
	        var word = "(" + atom + "|" + quotedUser + ")";
	        var userPat = new RegExp("^" + word + "(\\." + word + ")*$");
	        var domainPat = new RegExp("^" + atom + "(\\." + atom + ")*$");
	        var matchArray = emailStr.match(emailPat);
	        if (matchArray == null) {
	            alert("L'email sembra essere sbagliata: (controlla @ e .)");
	            return false;
	        }
	        var user = matchArray[1];
	        var domain = matchArray[2];
	        if (user.match(userPat) == null) {
	            alert("La parte dell'email prima di '@' non sembra essere valida!");
	            return false;
	        }
	        var IPArray = domain.match(ipDomainPat);
	        if (IPArray != null) {
	            for (var i = 1; i <= 4; i++) {
	                if (IPArray[i] > 255) {
	                    alert("L'IP di destinazione non è valido!");
	                    return false;
	                }
	            }
	            return true;
	        }
	        var domainArray = domain.match(domainPat);
	        if (domainArray == null) {
	            alert("La parte dell'email dopo '@' non sembra essere valida!");
	            return false;
	        }
	        var atomPat = new RegExp(atom, "g");
	        var domArr = domain.match(atomPat);
	        var len = domArr.length;
	        if (domArr[domArr.length - 1].length < 2 ||
	            domArr[domArr.length - 1].length > 6) {
	            alert("Il dominio di primo livello (es: .com e .it) non sembra essere valido!");
	            return false;
	        }
	        if (len < 2) {
	            var errStr = "L'indirizzo manca del dominio!";
	            alert(errStr);
	            return false;
	        }
	        return true;
	    }
            
function isdate(data)
{
    // Recupera l'informazione dall'input "data" del form
  var stringa=data;//document.getElementById("data").value;
 
  // Struttura l'espressione regolare
  var espressione = /^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/;
 
  // Effettua il test sulla stringa e 
  //    ritorna il risultato con un alert
  /*if (!espressione.test(stringa))  {
    return false;
  } else*/ {
    // Recupera dalla stringa i campi anno, mese e giorno
    giorno = parseInt(stringa.substr(8),10);
    mese = parseInt(stringa.substr(5, 2),10);
    anno = parseInt(stringa.substr(0, 4),10);
     
    // Crea la nuova data
    var data=new Date(anno, mese-1, giorno);
 
    // Controlla che i parametri della data siano 
    //  gli stessi che abbiamo impostato
    if (data.getFullYear()==anno && 
          data.getMonth()+1==mese && 
          data.getDate()==giorno){
      return true;
    } else {
      return false;
    }
  }
}

function addZero(numero)
{
    return numero<10 ? ""+"0"+numero:numero;
}

function compareDate(data1gg_mm_aaaa,data2gg_mm_aaaa)
{
        gg = addZero(parseInt(data1gg_mm_aaaa.substr(8),10));
        mm = addZero(parseInt(data1gg_mm_aaaa.substr(5, 2),10));
        aaaa = parseInt(data1gg_mm_aaaa.substr(0, 4),10);
        str1=""+aaaa+mm+gg+""; 
        gg = addZero(parseInt(data2gg_mm_aaaa.substr(8),10));
        mm = addZero(parseInt(data2gg_mm_aaaa.substr(5, 2),10));
        aaaa = parseInt(data2gg_mm_aaaa.substr(0, 4),10);
        str2=""+aaaa+mm+gg+""; 
        if(str1<str2)
        {
            return -1;
        }
        else if(str1=str2)
            return 0;
        else return 1;
        
    
}

function isDataMaggioreOggi(dataGG_MM_AAAA)
{
    if(isdate(dataGG_MM_AAAA))
    {
        gg = addZero(parseInt(dataGG_MM_AAAA.substr(8),10));
    mm = addZero(parseInt(dataGG_MM_AAAA.substr(5, 2),10));
    aaaa = parseInt(dataGG_MM_AAAA.substr(0, 4),10);
    str2=""+aaaa+mm+gg+""; 
        today= new Date();
        stringa="";
        mese=addZero(today.getMonth()+1);
        anno= today.getYear()+1900;
        giorno=addZero(today.getDate());
        stringa=""+anno+""+mese+giorno+"";
        if(stringa<str2) //tutto ok
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else //non ha le caratteristiche di una data
    {
        return false;
    }
}

/****
 * 
 * 
 * 
 * 
 * 
 *   FINE FUNZIONI TIPICHE
 */



function scegliCitta(da_a,inizio)
{
    //rivisualizzo il div
    if(inizio.length>2){
    elemento(da_a).style.display='inline';
    elemento(da_a).innerHTML="";
    //ricerca degli elementi
    query="classe=localita";
    if(elencoDa.length==0)
    {
    var d=ajaxsaiu('../ajax/getFromClass.php',query);
    elencoDa=JSON.parse(d);
    //x=eval(d);
    
    }
    /*for  (var i in elencoDa) {
        if(i['nome'].indexOf(inizio)==0)
            alert(i['nome']);
            */
           j=0;
    var arr= new Array();       
    elemento(da_a).innerHTML="<ul>";
    for(i=0;i<elencoDa.length;i++)
    {
        
        minusc=elencoDa[i]['nome'].toLowerCase();
        if(minusc.indexOf(inizio.toLowerCase())>=0){
            arr[j]=elencoDa[i]['nome'];
            id=elencoDa[i]['id'];
            agg="<li onclick=sceltacitta("+da_a+","+id+",'"+arr[j].replace(/ /g, '_').replace(/'/g, "\\'")+"')>"+arr[j]+"</li>";
            //alert(agg);
            elemento(da_a).innerHTML=elemento(da_a).innerHTML+agg;
            j++;
        }
    }
    elemento(da_a).innerHTML=elemento(da_a).innerHTML+"</ul>";
    //alert(elemento(da_a).innerHTML);
    }
    //return arr;
}
    
function sceltacitta(da_a,valore,nomecitta)
{
    
    //alert(elencoDa[valore]['nome']);
    //assegna l'id della citta
    if(da_a.id=='preventivo_dx_da') //caso DA
    {
        
        elemento('_da').value=nomecitta;//elencoDa[valore]['nome'];
        elemento('da').value=valore;
        elemento('_da').readOnly="readonly";
    }
    else //caso A
    {
        
        elemento('_a').value=nomecitta;//elencoDa[valore]['nome'];
        elemento('a').value=valore;
        elemento('_a').readOnly="readonly";
    }
    da_a.innerHTML="";
    //assegna il nome
}
    
function calcolaPreventivo()
{
    //ricevi i dati e cercali via ajax
    da=elemento('da').value;
    a=elemento('a').value;
    if(elemento('ar').checked) ar="si"; else ar="no";
    capienza=elemento('idcapienza').value;
    stagione=elemento('stagione').value;
    seggiolini=elemento('seggiolini').value;
    alzatine=elemento('alzatine').value;
    if(da!="" && a!="" && capienza!="")
    {
    prezzo=ajaxsaiu('../ajax/cercaPrezzo.php',"da="+da+"&a="+a+"&ar="+ar+"&alzatine="+alzatine+"&seggiolini="+seggiolini+"&capienza="+capienza+"&stagione="+stagione);
    if(prezzo!="")  //caso nel quale esista un prezzo
    {
        elemento('cifra').style.display='inline';
        elemento('cifra').value=prezzo;
        elemento('sottometti').value="Accetta Preventivo";
        elemento('email').style.display='none';
        elemento('email').value="";
        elemento('preventivo').value="NO";
    }
    else //se non esiste il prezzo
    {
        elemento('email').style.display='inline';
        elemento('sottometti').value="Richiedi Preventivo";
        elemento('cifra').style.display='none';
        elemento('cifra').value="";
        elemento('preventivo').value="SI";
    }
}
else alert('Controlla di aver inserito tutti i valori');
    
}
    
 function checkminmax(inp,min,max)
  {
     if(inp.value>max || inp.value<min)
         inp.value=min;
  }


function allReadOnly(idform){
    forma=document.getElementById(idform);
    for(i=0;i<forma.elements.length;i++)
    {
        forma.elements[i].readOnly=true;
        forma.elements[i].disabled=true;
    }
}

function controllaform(campo) //riempe il controllo di grafica bellissima
{
     if(campo.name.indexOf('form')==0) //caso del form totale
    {
            var form = document.getElementById(campo.name);
                for (i = 0; i < form.elements.length; i++) 
                {
                    if (form.elements[i].required==true && form.elements[i].disabled==false  )
                    {
                        if(valida(form.elements[i])==false)
                            {
                            alert('ricontrolla i campi obbligatori');   
                            form.elements[i].style.backgroundColor='#ffaeae';
                            return false;
                            }
                        else{
                            form.elements[i].style.backgroundColor='#d1ffff';
                        }    
                            
                    }
                }
                return true;
   }
    else
    {
        if(valida(campo))
        {
            campo.style.backgroundColor='#d1ffff'; //'blue';//
        }
        else
        {
            campo.style.backgroundColor='#ffaeae';
        }
    }
    
    
    /*valore=campo.value;
    alert(valore);*/
    return true;

}    


function valida(cosa)
{
    valore=cosa.value.trim();
    switch (cosa.name)
    {
        case 'nome':
        case 'nomecognome':
        case 'cognome':
        case 'mansione': 
        case 'telefono':
        case 'civicopickupa':
        case 'civicopickupr':
        case 'nazione':
        case 'viapickupa':
        case 'viapickupr':
        case 'numerovolopickupa':
        case 'vettorepickupa':
        case 'viadropdowna':
        case 'numerovolopickupr':
        case 'vettorepickupr':
        case 'note':
        case '_da':
        case '_a':    
            val=valore;
            if(val!="")
                return true;
            return false;
            break;
        case 'a':
            if(cosa.value!=elemento(da).value)
                return true;
            return false;
        break;
        case 'email':
            if(isEmail(valore))
                return true;
            return false;
            break;
        case 'email2':
            if(cosa.value==elemento(email).value)
                return true;
            return false;
        break;
        case 'ora':
        case 'orapickupa':
        case 'orapickupr':
        case 'oradropdowna':
        case 'oradropdownr':    
            var or= cosa.value;
            var exp = new RegExp('^[0-9]{1,2}:[0-9]{2}$');
            if (exp.test(or)) {
                    return true;
            } else { return false;

                    }
        break;
        case 'mezzopickupa':
            switch(cosa.value){
                case 'aereo':
                    elemento('numerovolopickupalabel').innerHTML="Codice volo";
                  //  elemento('numerovolopickupalabel').setAttribute("required","true");
                    elemento('numerovolopickupa').disabled=false;
                  //  elemento('vettorepickupa').setAttribute("required","true");
                    elemento('vettorepickupa').disabled=false;
                  //  elemento('viapickupa').setAttribute("required","false");
                    elemento('viapickupa').setAttribute("disabled","true");
                  //  elemento('civicopickupa').setAttribute("required","false");
                    elemento('civicopickupa').setAttribute("disabled","true");
                    
                    break;
                case 'nave':
                    elemento('numerovolopickupalabel').innerHTML="Codice nave";
                  //  elemento('numerovolopickupalabel').setAttribute("required","true");
                    elemento('numerovolopickupa').disabled=false;
                  //  elemento('vettorepickupa').setAttribute("required","true");
                    elemento('vettorepickupa').disabled=false;
                  //  elemento('viapickupa').setAttribute("required","false");
                    elemento('viapickupa').setAttribute("disabled","true");
                  //  elemento('civicopickupa').setAttribute("required","false");
                    elemento('civicopickupa').setAttribute("disabled","true");
                    break;
                case 'nulla':
                    elemento('numerovolopickupalabel').innerHTML="Nessun Mezzo";
                 //   elemento('numerovolopickupalabel').setAttribute("required","false");
                    elemento('numerovolopickupa').setAttribute("disabled","true");
                 //   elemento('vettorepickupa').setAttribute("required","false");
                    elemento('vettorepickupa').setAttribute("disabled","true");
                //    elemento('viapickupa').setAttribute("required","true");
                    elemento('viapickupa').disabled=false;
                 //   elemento('civicopickupa').setAttribute("required","true");
                    elemento('civicopickupa').disabled=false;
                    elemento('civicopickupa').setAttribute("disabled","");
                    elemento('civicopickupa').disabled=false;
                    break;
            }
            
        break;
        case 'mezzopickupr':
            switch(cosa.value){
                case 'aereo':
                    elemento('numerovolopickuprlabel').innerHTML="Codice volo";
                  //  elemento('numerovolopickupalabel').setAttribute("required","true");
                    elemento('numerovolopickupr').disabled=false;
                  //  elemento('vettorepickupa').setAttribute("required","true");
                    elemento('vettorepickupr').disabled=false;
                  //  elemento('viapickupa').setAttribute("required","false");
                    elemento('viapickupr').setAttribute("disabled","true");
                  //  elemento('civicopickupa').setAttribute("required","false");
                    elemento('civicopickupr').setAttribute("disabled","true");
                    
                    break;
                case 'nave':
                    elemento('numerovolopickuprlabel').innerHTML="Codice nave";
                  //  elemento('numerovolopickupalabel').setAttribute("required","true");
                    elemento('numerovolopickupr').disabled=false;
                  //  elemento('vettorepickupa').setAttribute("required","true");
                    elemento('vettorepickupr').disabled=false;
                  //  elemento('viapickupa').setAttribute("required","false");
                    elemento('viapickupr').setAttribute("disabled","true");
                  //  elemento('civicopickupa').setAttribute("required","false");
                    elemento('civicopickupr').setAttribute("disabled","true");
                    break;
                case 'nulla':
                    elemento('numerovolopickuprlabel').innerHTML="Nessun Mezzo";
                 //   elemento('numerovolopickupalabel').setAttribute("required","false");
                    elemento('numerovolopickupr').setAttribute("disabled","true");
                 //   elemento('vettorepickupa').setAttribute("required","false");
                    elemento('vettorepickupr').setAttribute("disabled","true");
                //    elemento('viapickupa').setAttribute("required","true");
                    elemento('viapickupr').disabled=false;
                 //   elemento('civicopickupa').setAttribute("required","true");
                    elemento('civicopickupr').disabled=false;
                    elemento('civicopickupr').setAttribute("disabled","");
                    elemento('civicopickupr').disabled=false;
                    break;
            }
            
        break;    
        case 'dataa':
            datada=elemento('datada').value;
            if(compareDate(datada,cosa.value)<0 && isDataMaggioreOggi(datada) && isdate(cosa.value))
            {
                return true;
            }
            return false;
        
            //rroba per le date, controllo
            //devi controllare che la data di partenza sia >oggi e che data ritorno sia > data partenza
            
            return(isdate(cosa.value));
            
            
        break;
        case 'datada':
            return isDataMaggioreOggi(cosa.value);
            break;
    }
}
   
    
    function salvacosto(idtratta,idstagione,idcapienza,prezzo)
    {
        ajaxsaiuasync("../ajax/salvaCosto.php","idtratta="+idtratta+"&idstagione="+idstagione+"&idcapienza="+idcapienza+"&prezzo="+prezzo);
        
    }
  
function resetformpreventivo()
{
    elemento("da").value="";
    elemento("_da").value="";
    elemento("a").value="";
    elemento("_a").value="";
    elemento("cifra").value="";
    elemento("email").value="";
}


function salvatempotratta(idtratta,valore)
{
         ajaxsaiuasync("../ajax/salvatempotratta.php","idtratta="+idtratta+"&valore="+valore);
         
}

function andataritorno(coso)
{
    if(coso.checked)
    {
        document.getElementById('dataa').disabled=false;
        document.getElementById('dataa').required=true;
        
    }
    else 
    {document.getElementById('dataa').disabled=true;
        document.getElementById('dataa').required=false;
    }
calcolaPreventivo();

}
function cancellaprenotazioneconconfirm(idprenotazione)
{
    if(confirm("Vuoi cancellare la prenotazione "+idprenotazione+"?"))
    {
        cancellaprenotazione(idprenotazione);
        location.reload();
    }
}
function cancellaprenotazione(idprenotazione)
{
    //alert('ciao');
    // if(confirm("la chiusura della pagina cancellerà la tua prenotazione"))
    //{
        var querystring="idprenotazione="+idprenotazione;
       var risp= ajaxsaiu("../ajax/cancellaprenotazione.php",querystring);
       alert(risp);
       //location.reload();
           
   // }
}

function cancellatratta(idtratta)
{
    
    if(confirm('Sei certo di voler cancellare questa tratta?'))
    {
    alert(ajaxsaiu('../ajax/deleteTratta.php',"idtratta="+idtratta));
    location.reload();
    }
}

function pagamento(idpagamento,metodo,idprenotazione)
{
    //questa funzione salva tutti i dati del pagamento, manda le mail, diverso in base al pagare con paypal o altro
    
    /****   
     * Salvataggio informazioni
     * 
     * *******/
    window.onbeforeunload=function(){};
    window.onunload=function(){};
    risp=(ajaxsaiu('../ajax/updatepagamento.php',"metodo="+metodo+"&idpagamento="+idpagamento+"idprenotazione="+idprenotazione));
    if(risp=='ok')
    {
         if(metodo=='dopo')
        location.href="../viste/grazie.php?metodo=pagadopo&idp="+idpagamento;
        else
             document.getElementById("formpaypal").submit();
    }
    else alert(risp);
    
    
    
}