<?php
include "toppssh.html";
?>	

			<!-- Br�dtekst -->
					
			 <div id="main"> 

<h2>Legg opp dine egne tips eller erfaringer!</h2>
<p> Her kan du legge opp dine l�sninger p� data problemer du har hatt, s� andre som kanskje sliter med det samme kan lese! </p>
<p> <strong> Det du skriver her vil bli lagt opp p� siden </strong> </p>


<form action="gjestebok.php" method="post">
<table border="0">
<tr>
	<td>
		<p> Skriv inn navnet ditt</p>
	</td>
	<td>
		<input type="text" name="navn" value="Anonym">
	</td>
</tr>
<tr>	
	<td>
		<p>Skriv ditt bidrag her: </p>
	</td>
	<td>
		<textarea name="hilsen" cols="50" rows="10"></textarea>
	</td>
</tr>

<tr>
	<td> <p> Trykk her n�r du er ferdig:  <a href="gjestebok.php"> <input type="submit" name="sendt" value="Ferdig" align="right"> </a> </p> </td>
</tr>
</table>
</form>

</div>

<?php
include "bunnssh.html";
?>	

