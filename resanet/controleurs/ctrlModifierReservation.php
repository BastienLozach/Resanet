<?php

	session_start() ;
	
	$numeroCarte = $_SESSION["numéroCarte"] ;
	$dateResa = $_REQUEST["dateResa"] ;
	$etatResa = $_REQUEST["etatResa"] ;
	
	require_once("modele/modele.php") ;
	require_once("technique/datesResanet.php") ;
	$dateResaFR = convertirDateENversFR($dateResa) ;
	if($etatResa == "enregistrée"){
		enregistrerReservation($numeroCarte,$dateResa) ;
		$messageReservation = "Réservation du $dateResaFR enregistrée." ;
	}
	else {
		annulerReservation($numeroCarte,$dateResa) ;
		$messageReservation = "Réservation du $dateResaFR annulée." ;
	}
	
	require_once("vues/vueListeReservations.php") ;

?>


