<?php

//	session_start() ;
	
//	$numeroCarte = $_SESSION["numéroCarte"] ;
	$id_joursFeries = $_REQUEST["joursFeries"] ;
	
	
	
	require_once("modele/modele.php") ;
	
	$supprimerJoursFeries = supprimerJoursFeries($id_joursFeries) ;

	
	require_once("vues/vueJoursFeries.php") ;

?>


