<?php

	session_start() ;
	
//	$numeroCarte = $_SESSION["numéroCarte"] ;
	$numCarte = $_REQUEST["numCarte"] ;
	$somme = $_REQUEST["somme"] ;
	
	require_once("modele/modele.php") ;
	$test = crediterCarte($numCarte, $somme) ;

	$_SESSION["crediterCarteNum"] = $numCarte ;
	$_SESSION["crediterCarteSomme"] = $somme ;
	
	require_once("vues/vueListePersonnelsCarte.php") ;

?>


