<?php
include "toppssh.html";
?>

			<!-- Brødtekst -->
					
			 <div id="main"> 
			 <h2> Kontakt oss </h2>
				
<p>Du kan kontakte oss på mail seniorsurf@hotmail.no eller skrive under her. </p> 


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
