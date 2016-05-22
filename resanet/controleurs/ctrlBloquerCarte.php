<?php

//	session_start() ;
	
//	$numeroCarte = $_SESSION["numéroCarte"] ;
	$numCarte = $_REQUEST["numCarte"] ;
	
	
	require_once("modele/modele.php") ;
	$test = bloquerCarte($numCarte) ;


	
	require_once("vues/vueListePersonnelsCarte.php") ;

?>


