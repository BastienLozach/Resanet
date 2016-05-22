<?php

	session_start() ;
	

	$numCarte = $_REQUEST["numCarte"] ;
	
	
	require_once("modele/modele.php") ;
	$test = reinitialiserMDP($numCarte) ;
	if ($test) {
		$_SESSION["initMDP"] = $numCarte ;
	}
	
	require_once("vues/vueListePersonnelsCarte.php") ;

?>


