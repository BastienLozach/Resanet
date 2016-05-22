<?php

//	session_start() ;
	
//	$numeroCarte = $_SESSION["numéroCarte"] ;
	$numCarte = $_REQUEST["numCarte"] ;
	
	
	require_once("modele/modele.php") ;
	$test = activerCarte($numCarte) ;


	
	require_once("vues/vueListePersonnelsCarte.php") ;

?>


