<?php

	
	$login = $_REQUEST["login"] ;
	$mdp = $_REQUEST["mdp"] ;
	
	if($login != "" && $mdp != ""){
		require_once("modele/modele.php") ;
		
		$gestionnaire = seConnecterGestionnaire($login,$mdp) ;
		
		if(count($gestionnaire) != 0){
			session_start() ;
			
			$_SESSION["login"] = $gestionnaire["login"] ;
			$_SESSION["nom"] = $gestionnaire["nom"] ;
			$_SESSION["prénom"] = $gestionnaire["prénom"] ;
				
			require_once("vues/vueListePersonnelsCarte.php") ;
			
		}
		else{
			$echecConnexion = TRUE ;
			require_once("vues/vueConnexionGestionnaire.php") ;
		}
	}
	else {
		$saisieIncomplete = TRUE ;
		require_once("vues/vueConnexionGestionnaire.php") ;
	}
	
?>
