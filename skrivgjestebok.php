<?php
include "topp.html";
?>	




<h2>Legg opp dine egne tips eller erfaringer!</h2>
<p> <strong> Det du skriver her vil bli lagt opp på siden </strong> </p>


<form action="visgjestebok.php" method="post">
<table border="0">
<tr>
	<td><width="150"><p> Skriv inn navnet ditt</p> </td>
	<td><input type="text" name="navn" value="Anonym"> </td>
	</tr>
<tr>	
	<td><width="150"> <p>Skriv ditt bidrag her: </p></td>
	<td><textarea name="hilsen" cols="50" rows="10">
	</textarea></td>
</tr>

<tr>
	<td><width="150"><p>URl hjemmesiden din (ikke nødvendig)</p> </td>
	<td><input type="text" name="www" size="30">  </td>
</tr>

<tr>
	<td> <p> Trykk her når du er ferdig:  <a href="gjestebok.php"> <input type="submit" value="Ferdig" align="right"> </a> </p> </td>
</tr>


</table>
</form>


<?php
include "bunn.html";
?>	

