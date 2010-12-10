<?php
include "topp.html";
?>
							<!-- Brødtekst -->
			 <div id="main"> 
			 <h2> Kontakt oss </h2>
				
			 <p>
Du kan kontakte oss på mail seniorsurf@hotmail.no eller skrive under her. </p> 

<form action="" method="post"> 
<table> 
<tr> 
<td>Navn: </td><td><input type="text" name="Navn" /></td> 
</tr> 
<tr> 
<td>Alder: </td><td> <input type="text" name="Alder" /></td> 
</tr> 
<tr> 
<td>Epost: </td><td><input type="text" name="Epost" /></td> 
</tr> 
<tr> 
<td>Melding:</td> 
<td><textarea name="Kommentar" rows="5" cols="25">Skriv her...</textarea> </td> 
</tr> 
</table> 
<br/> <input type="submit" name="Send" value="Send"/> <input type="reset"><br> 
</form> 


<?php

echo "Her detaljene du skrev inn: </br>";
echo "Navn : ".$_REQUEST["Navn"]."</br>";
echo "Alder : ".$_REQUEST["Alder"]."</br>";
echo "Epost : ".$_REQUEST["Epost"]."</br>";

if (isset ($_REQUEST["Send"]))   
{ 
echo "Din beskjed : ".$_REQUEST["Kommentar"]."</br>";
}

$melding = "Navn : ".$_REQUEST["Navn"]. "\r\n";
$melding .= "Alder : ".$_REQUEST["Alder"]. "\r\n";
$melding .= "Epost : ".$_REQUEST["Epost"]. "\r\n";
$melding .= "Din beskjed : ".$_REQUEST["Kommentar"]. "\r\n";

echo "<br/>";
setlocale(LC_TIME,"no_NO");
date_default_timezone_set("Europe/Oslo");
echo strftime("I dag er det %A %d %B %Y || %H : %M : %S"); 
echo "<br/>";
$til = "seniorsurf@hotmail.no";

if (mail($til, "skjema", $melding)) { 
print ( "Mailen er sendt \n" ); 
} 
else { print ( "En feil oppstod ved sending av mail, G� tilbake og send på nytt.\n");
}  

?>	
</div>	
	  
<?php
include "bunn.html";
?>