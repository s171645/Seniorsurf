<?php
include "topp.html";
?>	

<p><a href="skrivgjestebok.php" ><strong> Trykk her for Ã¥ skrive. </a></strong></p> 


<?php

if ($_POST ['hilsen'] == "") {
	echo "Feil, Du har ikke skrivet inn noe.";
}


else {
	$fp=fopen("gjester.txt", "a+") ; 
	if ($fp==false)
	{
	echo "Feil, vennligst prøv seinere :( (Klarte ikke åpne fil).";
	}

	else
	{
	$linje = $_POST ['navn'] . "***---***";
	$linje .= $_POST ['hilsen'] . "***---***";
	$linje .= $_POST ['www'] . "***---***";
	$linje = str_replace("\r\n", "<br />", $linje);
	$linje = htmlentities ($linje);
	fwrite($fp, $linje);
	fwrite($fp, "\n");
	fclose ($fp);
	echo "<hr />";
	}
}
?>

<?php

$matrise=file("gjester.txt");

$matrise = array_reverse($matrise);


foreach ($matrise as $linje) 
	{
	$neste = explode("***---***", $linje) ;
	echo "<h2>" . $neste[0] . "</h2>";
	echo "<blockquote>" . $neste[1] . "</blockquote>";
	echo "<p>" . $neste[2] . "</p>";
	
	
	}
	
if ($matrise = true)
{
	echo " Den ".date("d-m-Y") ;
	echo "<hr />";
}


?>



<?php
include "bunn.html";
?>	

