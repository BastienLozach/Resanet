<?php
	
	session_start() ;
	
	$numeroCarte = $_SESSION["numéroCarte"] ;
	$ancienMDP = $_REQUEST["ancienMDP"] ;
	$nouveauMDP = $_REQUEST["nouveauMDP"] ;
	
	require_once("modele/modele.php") ;
	$etatModificationMDP = modifierMdpUsager($numeroCarte,$ancienMDP,$nouveauMDP) ;
	
	if($etatModificationMDP == 0){
		require_once("vues/vueModificationMDP.php") ;
	}
	else {
		require_once("vues/vueListeReservations.php") ;
	}

?>
