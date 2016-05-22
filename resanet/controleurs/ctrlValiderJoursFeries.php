<?php
	session_start(); 
	$id = $_REQUEST["libelle"] ;
	$jour = $_REQUEST["jour"] ;
	$mois = $_REQUEST["mois"] ;
	
	
	
	require_once("modele/modele.php") ;
	
	$nbresJoursAvant = afficherNbreJoursFeries() ;
	
	$ajoutOk = ajouterJourFerie($id, $jour, $mois) ;
	
	$nbresJoursApres = afficherNbreJoursFeries() ;
	
	if ($nbresJoursAvant == $nbresJoursApres){
		$_SESSION["erreurAjout"] = TRUE ;
	}
	
	
	
	require_once("vues/vueJoursFeries.php") ;
	
?>


