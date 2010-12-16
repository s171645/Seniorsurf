<?php
include "toppssh.html";
?>	
<div id="main">
<p><a href="skrivgjestebok.php" ><strong> Trykk her for å skrive inn ditt eget bidrag.</strong> </a> </p> 


<?php

	
if(isset($_POST["sendt"])) {

	$fp=fopen("gjester.txt", "a+") ; 
	if ($fp==false)
	{
	echo "Feil, vennligst prøv seinere :( (Klarte ikke åpne fil).";
	}
	else
	{
	$linje = $_POST ['navn'] . "***---***";
	$linje .= $_POST ['hilsen'] . "***---***";
	$linje = str_replace("\r\n", "<br />" , $linje);
	$linje = htmlentities ($linje);
	fwrite($fp, $linje);//skriver strengen til fil		
	fwrite($fp, "\n");	
	fclose ($fp);
}	
}

?>

<?php

$matrise=file("gjester.txt");

$matrise = array_reverse($matrise);


foreach ($matrise as $linje) 
	{
	$neste = explode("***---***", $linje) ;
	echo "<p>";	
	echo "<h2>" . $neste[0] . "</h2>";
	echo  $neste[1] ;
	echo  $neste[2] ;	
	echo "<p>";	
	}
	


?>

</div>

<?php
include "bunnssh.html";
?>	

