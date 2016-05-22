<?php

	session_start() ;
	
	$numCarte = $_REQUEST["numCarte"] ;

	
	if (isset($_REQUEST["activee"] ) == TRUE) {
		$activee = TRUE ;
	}
	else{
		$activee = FALSE ;
	}
	

	require_once("modele/modele.php") ;
	creerCarte($numCarte, $activee) ;

	require_once("vues/vueListePersonnelsCarte.php") ;

	
?>
