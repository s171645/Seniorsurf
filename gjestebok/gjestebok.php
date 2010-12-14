
<?php
/*	______________________________________________________________________
	_GJESTEBOK_v1.3_______________________________________mortz.tjokk.net_
	
	Forfatter:   Morten Daniel Fornes
	E-post:      mortz0r@gmail.com
	Hjemmeside:  http://mortz.tjokk.net
	Sist endret: 10/11/2005
	_______________________________________________________________________
	
	_______________________________________________________________________
	_DISCLAIMER_&_LISENS:__________________________________________________
	
	* All bruk av dette scriptet skjer på _EGET_ ansvar!
	  Jeg tar ikke på meg skylden om en bug i scriptet mitt fuxxer
	  serveren din eller noe!

	* Scriptet ble skrevet for 1,5 år siden, så ikke flame meg for den
	  skitne og uoptimaliserte koden. Det funker utmerket, så jeg gir
	  egentlig faen. =)

	* Scriptet kan KUN BRUKES AV PRIVATPERSONER PÅ SIN EGNE PERSONLIGE
	  HJEMMESIDE MED LINK TILBAKE TIL MIN SIDE!!

	  D.v.s.:

	  - Scriptet skal KUN BRUKES PÅ PERSONLIGE HJEMMESIDER.

	  - Du kan IKKE LEGGE SCRIPTET PÅ EN HJEMMESIDE DU HAR FÅTT BETALING
	    FOR Å HA LAGET!! Slike tilfeller vil selvsagt straks bli saksøkt,
	    anmeldt, og personen mister i tillegg all respekt og selvtillit.

	  - Du kan IKKE TA BETALING FOR Å HJELPE ANDRE MED Å LEGGE UT SCRIPTET!

	  - Du kan IKKE SELGE SCRIPTET VIDERE!!

	  - Altså, du kan aldri ta BETALT for TJENESTER der DETTE SCRIPTET
	    er en del av/innvolvert i!

	* Du kan IKKE DISTRIBUERE SCRIPTET VIDERE! I hvertfall IKKE I DITT EGET
	  NAVN! Gi heller ut en link til hjemmesida mi, og gjerne anbefal det
	  for andre =)

	* Det KAN selvsagt GJØRES mange UNNTAK av reglene som står over, etter 
	  egen avtale gjort med meg på forhånd. (Se hjemmeside for kontaktinfo)
	  Ikke vær redde for å spørre! =))
	_______________________________________________________________________
	
	_______________________________________________________________________
	_INSTALLERING_OG_KONFIGURERING:________________________________________
	
	1. Veldig enkelt, egentlig. Først, åpne fila 'gjestebok.php' (som
	   ligger i "inc"-mappa) i hvilken som helst teksteditor, og endre 
	   konfigurasjonen til dine behov. Har prøvd å kommentere litt, for å 
	   gjøre ting lettere å forstå. =)
	
	   Er det noe der som du er usikker på, så la det være som det er!

	
	2. Etterpå kan du åpne 'index.php' og tilpasse den din sides design.
	   Bare pass på at linjen '<?php include("inc/gjestebok.php"); ?>'
	   er der, ellers vil det ikke fungere! Fonter, farger ol. _bør_
	   defineres med et CSS stilark! Endre litt på filen 'style.css' om du
	   vil. =)
	
	   (Scriptet er laget slik, at det gjerne kan brukes sammen med
	   INCLUDESCRIPTET og/eller LOGINSCRIPTET. (Se hjemmesida!))


	3. Når det er gjort, så gjenstår det bare å legge den på nett.
	
	   Bruk en ftpklient og last opp alle filene i denne mappa til en mappe
	   på webområdet ditt. Etterpå chmod'er du mappa 'data'
	   til 0777. Om du ikke skjønner hva jeg snakker om, kan du søke på
	   www.google.com etter navnet på FTP-klienten din og chmod i tillegg.
	_______________________________________________________________________
	
	_______________________________________________________________________
	_ANNET:________________________________________________________________
	
	* Får du problemer, så sjekk hjemmesiden min for informasjon og
	  eventuelt ta kontakt.

	* Om du oppdager en bug/feil i scriptet setter jeg pris på at du sier
	  ifra om det, så den kan rettes opp så fort som mulig.

	* Si gjerne ifra om du har forslag til forbedringer etc.

	* Følg med på http://mortz.tjokk.net/ for eventuelle oppdateringer!
	_______________________________________________________________________
*/

/*** KONFIGURASJON ***/

$URLToThisPage		= "index.php";	// URL til sida som viser gjesteboka.
									// F.eks "index.php"
									// Eller "index.php?page=gjestebok" hvis du bruker includescript.

$EntryFile			= "data/gbook_entries.txt";	// må chmoddes 0666!
$IPLogFile			= "data/gbook_iplog.txt";	// må chmoddes 0666!
$SmileyDir			= "smileys";

$MaxLenName			= 50;
$MaxLenMessage		= 500;
$MaxLenComment		= 300;
$MaxWordLen			= 50;
$EntriesPerPage		= 10;

$NameInputSize		= 50;
$EmailInputSize		= 50;
$HomepageInputSize	= 50;
$MessageSizeCols	= 50;
$MessageSizeRows	= 10;
$CommentSizeCols	= 50;
$CommentSizeRows	= 5;


/*** SCRIPTET STARTER HER ***************************************************/
/*** (ikke gjør endringer med mindre du vet hva du gjør! =) *****************/


$action = $_GET['action'];
$entry = $_GET['entry'];
$start = $_GET['start'];
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$url = $_POST['url'];
$message = $_POST['message'];
$comment = $_POST['comment'];

$phpSelf = explode("?", $URLToThisPage);
if (!strstr($_SERVER['PHP_SELF'], $phpSelf[0])) die("Permission denied.");
if (ereg("^[^?]+$", $URLToThisPage)) $URLToThisPage = $URLToThisPage . "?";

if (!file_exists($EntryFile)) {
	$fp = @fopen($EntryFile, "w");
	@fwrite($fp, "");
	@fclose($fp);
	@chmod($EntryFile, 0777);
}
if (!file_exists($IPLogFile)) {
	$fp = @fopen($IPLogFile, "w");
	@fwrite($fp, "");
	@fclose($fp);
	@chmod($IPLogFile, 0777);
}

// flood detector
function FloodDetector($IPLogFile) {
	$done = 0;
	$line = 0;
	$file = file($IPLogFile);
	$ip = getenv("REMOTE_ADDR");
	$hour = date("HdmY");
	while($file[$line]) {
		$a = explode("|", $file[$line]);
		if (($a[0] == $ip) && ($a[1] == $hour)) { $done = 1; }
		$line++;
	}
	if ($done == 1) return true;
	else {
		$a = implode($file, "");
		$fp = fopen($IPLogFile, "w"); 
		fwrite($fp, $ip . "|" . $hour . "|\n" . $a);
		fclose($fp);
		return false;
	}
}

// skriv innlegg
if ($action == "sign") {
?>
<script language="Javascript" type="text/javascript">
<!--
function addsmile(smiley) {
  doc_content = document.sign.message.value + smiley
  document.sign.message.value = doc_content
  document.sign.message.focus()
}
// -->
</script>
<?php

echo <<< end

  <h1>Skriv innlegg</h1>

  <form name="sign" action="$URLToThisPage&amp;action=dosign" method="post">
  <p><b>Navn:</b><br>
  <input type="text" name="name" size="$NameInputSize"></p>
  <p><b>Epost:</b><br>
  <input type="text" name="email" size="$EmailInputSize"></p>
  <p><b>Hjemmeside:</b><br>
  <input type="text" name="url" size="$HomepageInputSize" value="http://"></p>
  <p><b>Melding:</b><br>
  <textarea name='message' cols='$MessageSizeCols' rows='$MessageSizeRows'></textarea><br>
  <a href="javascript:addsmile(' X( ')"><img src="$SmileyDir/angry.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :f ')"><img src="$SmileyDir/flirt.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :x ')"><img src="$SmileyDir/dead.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :( ')"><img src="$SmileyDir/frown.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :h ')"><img src="$SmileyDir/cool.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :i ')"><img src="$SmileyDir/idea.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :) ')"><img src="$SmileyDir/smile.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' ;) ')"><img src="$SmileyDir/wink.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :l ')"><img src="$SmileyDir/hrmpf.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :o ')"><img src="$SmileyDir/redface.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :00 ')"><img src="$SmileyDir/look.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :p ')"><img src="$SmileyDir/tounge.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :q ')"><img src="$SmileyDir/quest.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :r ')"><img src="$SmileyDir/shame.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :D ')"><img src="$SmileyDir/biggrin.gif" alt="" border="0"></a>
  <a href="javascript:addsmile(' :e ')"><img src="$SmileyDir/supergrin.gif" alt="" border="0"></a></p>
  <p><input type="submit" value="Skriv innlegg!"> <input type="reset" value="Visk ut!">
  </form>

  <p>Navn og melding m&aring; fylles ut.</p>
  <p><a href="$URLToThisPage&amp;action=view">Tilbake til gjesteboken!</a></p>

end;

}
elseif ($action == "dosign") {
	echo "<h1>Skriv innlegg</h1>\n";
	if (!empty($name) && !empty($message)) {
		if ($url == "http://") { $url = ""; }

		$name = stripslashes($name);
		$name = ltrim($name);
		$name = rtrim($name);
		$message = stripslashes($message);
		$message = ltrim($message);
		$message = rtrim($message);

		if (strlen($name) > $MaxLenName) echo "<p><i>ERROR! Navnet er for langt! Max $MaxLenName tegn!</i></p>\n";
		elseif (strlen($message) > $MaxLenMessage) echo "<p><i>ERROR! Meldingen er for lang! Max $MaxLenMessage tegn!</i></p>\n";
		elseif (!empty($email) && !ereg("^[^@ ()$#><;%*?&+='\{}æøåÆØÅ]+@[^@ ()$#><;%*?&+='\{}æøåÆØÅ]+\.[^@ ()$#><;*%?&+='\{}æøåÆØÅ\.]+$", $email)) echo "<p><i>ERROR! Feil format p&aring; mailadresse!</i></p>\n";
		elseif (!empty($url) && !ereg("^[a-zA-Z0-9]+://[^ ()$#>\<;*&+'{}æøåÆØÅ]+$", $url)) echo "<p><i>ERROR! Feil format p&aring; hjemmesideadresse!</i></p>\n";
		else {
			$id = date("ymdHis");
			$ip = getenv("REMOTE_ADDR");
			$host = gethostbyaddr($ip);
			$url = str_replace("|","&#124;",$url);
			$name = htmlspecialchars($name);
			$name = str_replace("æ","&aelig;",$name);
			$name = str_replace("ø","&oslash;",$name);
			$name = str_replace("å","&aring;",$name);
			$name = str_replace("Æ","&AElig;",$name);
			$name = str_replace("Ø","&Oslash;",$name);
			$name = str_replace("Å","&Aring;",$name);
			$name = str_replace("|","&#124;",$name);
			$message = htmlspecialchars($message);
			$message = wordwrap($message, $MaxWordLen, " ", 1); 
			$message = str_replace("æ","&aelig;",$message);
			$message = str_replace("ø","&oslash;",$message);
			$message = str_replace("å","&aring;",$message);
			$message = str_replace("Æ","&AElig;",$message);
			$message = str_replace("Ø","&Oslash;",$message);
			$message = str_replace("Å","&Aring;",$message);
			$message = str_replace("|","&#124;",$message);
			$message = str_replace("
","<br>",$message);
			$message = str_replace("\n","<br>",$message);
			$done = 0;
			$line = 0; 
			$file = file($EntryFile); 
			while ($file[$line]) { 
				$a = explode("|", $file[$line]); 
				if ($a[0] == $id) { 
					$done = 1; 
				}
				$line++; 
			}
			if ($done == 1) echo "<p><i>ERROR! Et innlegg med samme ID eksisterer allerede! Pr&oslash;v igjen!</i></p>\n";
			else { 
				if (FloodDetector($IPLogFile)) echo "<p><i>FEIL! Du har allerede skrevet et innlegg i l&oslash;pet av denne timen!</i></p>\n";
				else {
					$a = implode($file, ""); 
					$fp = fopen($EntryFile, "w"); 
					fwrite($fp,$id . "|" . $name . "|" . $email . "|" . $url . "|" . $message . "||" . date("d/m/Y") . "|" . date("H:i:s") . "|" . $ip . "|" . $host . "|\n" . $a); 
					fclose($fp); 
					echo "<p><i>Innlegget er lagret i databasen!</i></p>\n";
				}
			}
		}

	}
	else { echo "<p><i>ERROR! N&oslash;dvendige felt mangler</i></p>\n"; }
	echo "<p><a href=\"$URLToThisPage&amp;action=view\">Tilbake til gjesteboken!</a></p>\n";
}



// ingen hjemmesideadresse
elseif ($action == "nopage") {

echo <<< end

  <h2>Forum</h2>
  
  <p>Denne personen la ikke igjen noen hjemmesideadresse.</p>
  <p><a href="$URLToThisPage&amp;action=view&amp;start=$start">Tilbake!</a></p>

end;
}

// ingen e-postadresse
elseif ($action == "nomail") {

echo <<< end

  <h2>Forum</h2>
  
  <p>Denne personen la ikke igjen noen e-postadresse.</p>
  <p><a href="$URLToThisPage&amp;action=view&amp;start=$start">Tilbake!</a></p>

end;
}

// vis innlegg
else {
	echo "<h2>Forum</h2>\n";
	echo "<p><a href=\"$URLToThisPage&amp;action=sign\">Skriv innlegg!</a></p>\n";
	$b = 0;
	$line = 0; 
	$file = file($EntryFile);
	if (empty($start) || $start < 1) $start = 1;
	while ($file[$line]) { 
		$b++;
		$a = explode("|", $file[$line]); 
		if (($b >= $start) && ($b < $EntriesPerPage+$start)) {

			$id = $a[0];
			$name = $a[1];
			$email = $a[2];
			$url = $a[3];
			$message = $a[4];
			$comment = $a[5];
			$date = $a[6];
			$time = $a[7];
			$ip = $a[8];
			$host = $a[9];

			$message = str_replace("X(","<img src=\"$SmileyDir/angry.gif\" alt=\"\">",$message); 
			$message = str_replace(":f","<img src=\"$SmileyDir/flirt.gif\" alt=\"\">",$message); 
			$message = str_replace(":x","<img src=\"$SmileyDir/dead.gif\" alt=\"\">",$message); 
			$message = str_replace(":(","<img src=\"$SmileyDir/frown.gif\" alt=\"\">",$message); 
			$message = str_replace(":h","<img src=\"$SmileyDir/cool.gif\" alt=\"\">",$message); 
			$message = str_replace(":i","<img src=\"$SmileyDir/idea.gif\" alt=\"\">",$message); 
			$message = str_replace(":)","<img src=\"$SmileyDir/smile.gif\" alt=\"\">",$message); 
			$message = str_replace(";)","<img src=\"$SmileyDir/wink.gif\" alt=\"\">",$message); 
			$message = str_replace(":l","<img src=\"$SmileyDir/hrmpf.gif\" alt=\"\">",$message); 
			$message = str_replace(":o","<img src=\"$SmileyDir/redface.gif\" alt=\"\">",$message); 
			$message = str_replace(":00","<img src=\"$SmileyDir/look.gif\" alt=\"\">",$message); 
			$message = str_replace(":p","<img src=\"$SmileyDir/tounge.gif\" alt=\"\">",$message); 
			$message = str_replace(":P","<img src=\"$SmileyDir/tounge.gif\" alt=\"\">",$message); 
			$message = str_replace(":q","<img src=\"$SmileyDir/quest.gif\" alt=\"\">",$message); 
			$message = str_replace(":r","<img src=\"$SmileyDir/shame.gif\" alt=\"\">",$message); 
			$message = str_replace(":D","<img src=\"$SmileyDir/biggrin.gif\" alt=\"\">",$message); 
			$message = str_replace(":e","<img src=\"$SmileyDir/supergrin.gif\" alt=\"\">",$message); 
		
			$comment = str_replace("X(","<img src=\"$SmileyDir/angry.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":f","<img src=\"$SmileyDir/flirt.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":x","<img src=\"$SmileyDir/dead.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":(","<img src=\"$SmileyDir/frown.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":h","<img src=\"$SmileyDir/cool.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":i","<img src=\"$SmileyDir/idea.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":)","<img src=\"$SmileyDir/smile.gif\" alt=\"\">",$comment); 
			$comment = str_replace(";)","<img src=\"$SmileyDir/wink.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":l","<img src=\"$SmileyDir/hrmpf.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":o","<img src=\"$SmileyDir/redface.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":00","<img src=\"$SmileyDir/look.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":p","<img src=\"$SmileyDir/tounge.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":P","<img src=\"$SmileyDir/tounge.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":q","<img src=\"$SmileyDir/quest.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":r","<img src=\"$SmileyDir/shame.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":D","<img src=\"$SmileyDir/biggrin.gif\" alt=\"\">",$comment); 
			$comment = str_replace(":e","<img src=\"$SmileyDir/supergrin.gif\" alt=\"\">",$comment); 
		
			if (!empty($comment)) $comment = "\n  <br><br><b>:: Kommentar:</b>\n  <i>$comment</i>\n";
			else $comment = "";
		
			$pagetarget = "_blank";
			$mailtarget = "_blank";
			if (empty($url)) { $url = "$URLToThisPage&amp;action=nopage&amp;start=$start"; $pagetarget = "_self"; }
			if (empty($email)) { $email = "$URLToThisPage&amp;action=nomail&amp;start=$start"; $mailtarget = "_self"; }
			else $email = "mailto:".$email;

echo <<< end

  <table cellpadding="0" cellspacing="0" border="0">
	<tr><td class="gbHead"><b>$name</b></td><td align="right" class="gbHead">[ <a href="$email" target="$emailtarget">email</a> | <a href="$url" target="$pagetarget">hjemmeside</a> ]</td></tr>
	<tr><td colspan="2" class="gbMain">
		$message$comment
		<br><br></td></tr>
	<tr><td class="gbFoot">Skrevet: $date </td><td class="gbFoot" align="right"></td></tr>
  </table><br>

end;

		}
		$line++; 
	}

	echo "<p>";
	$c = round(round(100 * $start / $EntriesPerPage -50) / 100 +1); // den aktive siden
	if ($start == 1) $c = 1;
	if ($start >= $EntriesPerPage * $EntriesPerPage +1) $c = $c-1;
	$d = round(round(100 * $b / $EntriesPerPage +49) / 100); // hvor mange sider
	if ($d < 1) $d = 1;
	$next = $start+$EntriesPerPage;
	$prev = $start-$EntriesPerPage;
	if ($prev <= 1) $prev = 1;
	if ($start > $EntriesPerPage) echo "<a href=\"$URLToThisPage&amp;action=view&amp;action=$start\">&laquo; Forrige side</a>";
	if (($start > $EntriesPerPage) && ($b >= $start+$EntriesPerPage)) echo " :: ";
	if ($b >= $start+$EntriesPerPage) echo "<a href=\"$URLToThisPage&amp;action=view&amp;start=$next\">Neste side &raquo;</a>";
	echo "</p>\n";
	echo "<p>Du er n&aring; p&aring; side <b>$c</b> av <b>$d</b>.<br>\n";
	echo "Antall innlegg: <b>$b</b></p>\n";
}

// PLZ ikke fjern neste linje =)
echo "<p style=\"font-size:10px;margin-top:40px\"><i>Powered by <a href=\"http://mortz.tjokk.net\">mortz.tjokk.net</a>!</i></p>\n";
?>

