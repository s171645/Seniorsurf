<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="layout1.css" title="Standard Layout" />
	
	<title>Gruppe 27</title>
</head>

<body>


<!--Flytt ut headeren også i egen fil og include, blir ryddigere-->
<div id="header">
	<h1>Gruppe 27 - Web-prosjekt</h1>
</div>

<div id="container">
<div id="container2">

	<?php
		include("menuLeft.php");
		include("menuRight.php");
		include("contentchooser.php");
	?>

	<!--
	clearer helt ned forbi siste element på sidden så langt, slik atbakgrunnen i container/
	containter2 tegnes opp like langt nedover på begge sider, uavhengig av om content er kortere enn
	menuright og menuleft. NB, cleardiv har høyde 1em, men fordi bakgrunnsbildene i container ikke
	telles som elementer vil disse tegnes opp i cleardiv også (som ønsket).
	-->
	<div id="cleardiv"></div>
</div>
</div>

<?php
	include("footer.php");
?>

</body>
</html>
