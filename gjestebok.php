<?php
include "topp.html";
?>	

<p><a href="skrivgjestebok.php" ><strong> Trykk her for Ã¥ skrive.</strong> </a> </p> 


<?php

	if(isset($_POST["sendt"])) {
             if ($_POST ['hilsen'] == "") {
                echo "Feil, fikk ikke lagt inn. Du må skrive noe i den store tekst boksen.";
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
	$linje .= "<hr />";
	$linje = str_replace("\r\n", "<br />", $linje);
	$linje = htmlentities ($linje);
	fwrite($fp, $linje);
	fwrite($fp, "\n");
	fwrite($fp, "Den ".date("d-m-Y")) ;
	fwrite($fp, "<hr/>");
	fclose ($fp);
}	
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
	


?>



<?php
include "bunn.html";
?>	

