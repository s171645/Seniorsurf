<?php
include "topp.html";
?>	




<?php

if ($_POST ['hilsen'] == "") {
	echo "Feil, fikk ikke lagt inn. Du må skrive noe i den store tekst boksen.";
}


else {
	$fp=fopen("gjester.txt", "a+") ; 
	if ($fp==false)
	{
	echo "Feil, vennligst pr�v seinere :( (Klarte ikke �pne fil).";
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

