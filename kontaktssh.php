<?php
include "toppssh.html";
?>

			<!-- Brødtekst -->
					
			 <div id="main"> 
			 <h2> Kontakt oss </h2>
				
<p>Du kan kontakte oss på mail seniorsurf@hotmail.no eller kan du fylle inn ditt navn, alder, epostadresse og en melding i skjemaet som står nedenfor.</p>
<p>Når du har fylt inn all informasjonen og meldingen din så trykker du på knappen 'send' for å sende meldingen din til oss.</p> 
<p>Om du ikke har epost så kan vi desverre ikke svare deg, men om du følger denne <a href="http://www.seniorsurf.org/forum.php" > linken </a> så kan du legge inn en melding direkte på siden vår i diskusjonsforumet.</p>
<p> Da kan du komme tilbake til siden vår etter noen dager og se om noen har svart på spørsmålet ditt i diskusjonsforumet.</p>


<form action="epostssh.php" method="post">
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
<td>Melding: </td><td><textarea name="Kommentar" rows="5" cols="25">Skriv her...</textarea> </td>
</tr>
</table>
<br/> <input type="submit" name="Send" value="Send"/> <input type="reset"><br>
</form>
</div>


<?php
include "bunnssh.html";
?>
