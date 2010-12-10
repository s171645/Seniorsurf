<?php
echo "<h3>Dette er side 2</h3>";

echo "Her detaljene fra forige side: <br/>";
echo "Navn : ".$_REQUEST["Navn"]."<br/>";
echo "Alder : ".$_REQUEST["Alder"]."<br/>";
echo "Epost : ".$_REQUEST["Epost"]."<br/>";

if (isset ($_REQUEST["Send"]))   
{ 
echo "Din beskjed : ".$_REQUEST["Kommentar"]."<br/>";
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
$til      = 'vijitharan91@live.no';

  if (mail($til, "Fra Seniorsurf skjema", $melding)) {
    print ( "Mailen er nå sendt \n" );
} 
  else { print ( "En feil oppstod ved sending av mail, Gå tilbake og send på nytt.\n");}


?>
