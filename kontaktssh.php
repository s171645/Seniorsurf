<?php
include "toppssh.html";
?>

			<!-- Br�dtekst -->
					
			 <div id="main"> 
			 <h2> Kontakt oss </h2>
				
<p>Du kan kontakte oss p� mail seniorsurf@hotmail.no eller kan du fylle inn ditt navn, alder, epostadresse og en melding i skjemaet som st�r nedenfor.</p>
<p>N�r du har fylt inn all informasjonen og meldingen din s� trykker du p� knappen 'send' for � sende meldingen din til oss.</p> 
<p>Om du ikke har epost s� kan vi desverre ikke svare deg, men om du f�lger denne <a href="http://www.seniorsurf.org/forum.php" > linken </a> s� kan du legge inn en melding direkte p� siden v�r i diskusjonsforumet.</p>
<p> Da kan du komme tilbake til siden v�r etter noen dager og se om noen har svart p� sp�rsm�let ditt i diskusjonsforumet.</p>


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
