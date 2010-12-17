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
			//link klikket, sjekk i url'en om det er kravspesifikasjon
			elseif ($_GET["targetpage"]=='kravspesifikasjon'){
				include("content-kravspesifikasjon.php"); 
			}
			//link klikket, sjekk i url'en om det er designvalg
			elseif ($_GET["targetpage"]=='designvalg'){
				include("content-designvalg.php");
			}
			//link klikket, sjekk i url'en om det er produktskisse
			elseif ($_GET["targetpage"]=='produktskisse'){
				include("content-produktskisse.php");
			}
			//link klikket, sjekk i url'en om det er sitemap
			elseif ($_GET["targetpage"]=='sitemap'){
				include("content-sitemap.php");
			}
			//link klikket, sjekk i url'en om det er skissetsluttrapport
			elseif ($_GET["targetpage"]=='skissesluttrapport'){
						include("content-skissesluttrapport.php");
			}
			//link klikket, sjekk i url'en om det er individuellrapport
			elseif ($_GET["targetpage"]=='individuellrapport'){
				include("content-individuellrapport.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='prosjektarbeid'){
				include("content-prosjektarbeid.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='innholdsfortegnelse'){
				include("content-sluttrapport-innholdsfortegnelse.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='forord'){
				include("content-sluttrapport-forord.php");	
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='innledning'){
				include("content-sluttrapport-innledning.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='problemstilling'){
				include("content-sluttrapport-problemstilling.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='oppbygging'){
				include("content-sluttrapport-oppbygging.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='løsningsmetode'){
				include("content-sluttrapport-løsningsmetode.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='prosessrapport'){
				include("content-sluttrapport-prosessrapport.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='oppsummering'){
				include("content-sluttrapport-oppsummering.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='kravspesifikasjonslutt'){
				include("content-sluttrapport-kravspesifikasjonslutt.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='resultatavprodukt'){
				include("content-sluttrapport-resultatavprodukt.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='konklusjon'){
				include("content-sluttrapport-konklusjon.php");
			}
			//link klikket, sjekk i url'en om det er prosjektarbeid
			elseif ($_GET["targetpage"]=='kilder'){
				include("content-sluttrapport-kilder.php");	
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