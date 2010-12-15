	<?php
		//Start formateringen som definerer hovedområdet for innhold på siden
		echo "<div id=\"content\">";
		
		//Sjekk om en link er klikket
		if (isset ($_GET["targetpage"])){
			//link klikket, sjekk i url'en om det er hjem
			if ($_GET["targetpage"]=='hjem'){
				include("content-hjem.php"); 
			}
			//link klikket, sjekk i url'en om det er prosjektbeskrivelsen
			elseif ($_GET["targetpage"]=='prosjektbeskrivelse'){
				include("content-prosjektbeskrivelse.php"); 
			}
			//link klikket, sjekk i url'en om det er ansvarskartet
			elseif ($_GET["targetpage"]=='ansvarskart'){
				include("content-ansvarskart.php"); 
			}
			//link klikket, sjekk i url'en om det er milepælsplan
			elseif ($_GET["targetpage"]=='milepaelsplan'){
				include("content-milepaelsplan.php"); 
			}
			//link klikket, sjekk i url'en om det er aktivitetsplan
			elseif ($_GET["targetpage"]=='aktivitetsplan'){
				include("content-aktivitetsplan.php"); 
			}
			//link klikket, sjekk i url'en om det er risikoplan
			elseif ($_GET["targetpage"]=='risikoplan'){
				include("content-risikoplan.php"); 
			}
			//link klikket, sjekk i url'en om det er samarbeidsavtale
			elseif ($_GET["targetpage"]=='samarbeidsavtale'){
				include("content-samarbeidsavtale.php"); 
			}
			//link klikket, sjekk i url'en om det er prosjektdagbok
			elseif ($_GET["targetpage"]=='prosjektdagbok'){
				include("content-prosjektdagbok.php"); 
			}
			//noe lå i url'en, men passet ikke med noen av våre predefinerte linker
			else {
				echo "INFO: Det lå noe skrot i url";
				include("content-hjem.php"); 
				}
		}
		//Ingen linker klikket enda, vis startsiden
		else {
			include("content-hjem.php"); 
		}
		//Avslutt formateringen som definerer hovedområdet for innhold på siden
		echo "</div>";
	?>