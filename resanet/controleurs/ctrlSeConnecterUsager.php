<?php
	
	$numeroCarte = $_REQUEST["numeroCarte"] ;
	$mdp = $_REQUEST["mdp"] ;
	
	if($numeroCarte != "" && $mdp != ""){
		require_once("modele/modele.php") ;
		
		$usager = seConnecterUsager($numeroCarte,$mdp) ;
		
		if(count($usager) != 0){
			if($usager["carteActivée"] == TRUE){
				session_start() ;
				
				$_SESSION["numéroCarte"] = $usager["numéroCarte"] ;
				$_SESSION["nom"] = $usager["nom"] ;
				$_SESSION["prénom"] = $usager["prénom"] ;
				
				require_once("vues/vueListeReservations.php") ;
			}
			else {
				$carteBloquee = TRUE ;
				require_once("vues/vueConnexionUsager.php") ;
			}
		}
		else{
			$echecConnexion = TRUE ;
			require_once("vues/vueConnexionUsager.php") ;
		}
	}
	else {
		$saisieIncomplete = TRUE ;
		require_once("vues/vueConnexionUsager.php") ;
	}
	
?>
