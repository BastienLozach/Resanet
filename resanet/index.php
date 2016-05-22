<?php

	if(isset($_REQUEST["action"])){
		$action = $_REQUEST["action"] ;
	}
	else {
		$action = "accueillir" ;
	}
	
		
	require_once("modele/modele.php") ;
	if (connexionBD() === false) {
		
		require_once("controleurs/ctrlErrorMysql.php") ;
	}
	else {
		switch($action){
		
			case "accueillir" :
				require_once("controleurs/ctrlAccueillir.php") ;
				break ;
			
			case "choisirSessionUsager" :
				require_once("controleurs/ctrlChoisirSessionUsager.php") ;
				break ;
			
			case "seConnecterUsager" :
				require_once("controleurs/ctrlSeConnecterUsager.php") ;
				break ;
			
			case "listerReservations" :
				require_once("controleurs/ctrlListerReservations.php") ;
				break ;
			
			case "modifierReservation" :
				require_once("controleurs/ctrlModifierReservation.php") ;
				break ;
			
			case "choisirModifierMDP" :
				require_once("controleurs/ctrlChoisirModifierMDP.php") ;
				break ;
			
			case "modifierMDP" :
				require_once("controleurs/ctrlModifierMDP.php") ;
				break ;
			
			case "annulerModificationMDP" :
				require_once("controleurs/ctrlListerReservations.php") ;
				break ;
			
			case "choisirSessionGestionnaire" ;
				require_once("controleurs/ctrlChoisirSessionGestionnaire.php") ;
				break ;
			
			case "seDeconnecter" :
				require_once("controleurs/ctrlSeDeconnecter.php") ;
				break ;
		
			case "annulerSession" :
				require_once("controleurs/ctrlAccueillir.php") ;
				break ;
			//modifs
			case "seConnecterGestionnaire" :
				require_once("controleurs/ctrlSeConnecterGestionnaire.php") ;
				break ;		
			
			case "bloquerCarte" :
				require_once("controleurs/ctrlBloquerCarte.php") ;
				break ;
			
			case "activerCarte" :
				require_once("controleurs/ctrlActiverCarte.php") ;
				break ;
			
			case "reinitialiserMDP" :
				require_once("controleurs/ctrlReinitialiserMDP.php") ;
				break ;
			case "crediterCarte" :
				require_once("controleurs/ctrlCrediterCarte.php") ;
				break ;
			case "historiqueCarte" :
				require_once("controleurs/ctrlHistoriqueCarte.php") ;
				break ;
		
			case "lienConsulterPersonnelsCarte" :
				require_once("controleurs/ctrlLienConsulterPersonnelsCarte.php") ;
				break ;
		
			case "lienConsulterPersonnelsSansCarte" :
				require_once("controleurs/ctrlLienConsulterPersonnelsSansCarte.php") ;
				break ;
			
			case "creerCarte" :
				require_once("controleurs/ctrlCreerCarte.php") ;
				break ;
			
			case "creerCompte" :
				require_once("controleurs/ctrlCreerCompte.php") ;
				break ;
			
			case "lienConsulterResasDate" :
				require_once("controleurs/ctrlLienConsulterResasDate.php") ;
				break ;
			
			case "resasDate" :
				require_once("controleurs/ctrlResasDate.php") ;
				break ;
			
			case "lienConsulterJoursFeries" :
				require_once("controleurs/ctrlLienConsulterJoursFeries.php") ;
				break ;
				
			case "supprimerJoursFeries" :
				require_once("controleurs/ctrlSupprimerJoursFeries.php") ;
				break ;
				
			case "ajouterJoursFeries" :
				require_once("controleurs/ctrlAjouterJoursFeries.php") ;
				break ;
				
			case "ajouterJoursFeries2" :
				require_once("controleurs/ctrlValiderAjouterJoursFeries.php") ;
				break ;
				
			case "validerJoursFeries" :
				require_once("controleurs/ctrlValiderJoursFeries.php") ;
				break ;
		}
	}

?>
