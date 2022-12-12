<?php 
	$servera_vards = "localhost";
	$lietotajvards = "administrators";
	$parole = "Parole1";
	$db_vards = "poliklinika";

	#connect to mysql database - server name, username, password, name of database. 
	$savienojums = mysqli_connect($servera_vards, $lietotajvards, $parole, $db_vards);
	
	if(!$savienojums){
		die("Pieslēgties neizdevās: ".mysqli_connect_error());
	} else {
		#atkomentēt tikai lai testētu!
		#echo "Savienojums ar datubāzi ir veiksmīgi izveidots!";
	}
?>