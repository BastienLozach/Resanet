<?php

	function connexionBD(){
		$dsn = "mysql:host=localhost;dbname=resanet" ;
		$utilisateur = "root" ;
		$motDePasse = "azerty" ;
		
		$options = array (
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			) ;
		try {	
			$connexion = new PDO($dsn,$utilisateur,$motDePasse,$options) ;
		}
		catch (PDOException $e) {
			return false ;
		}
			
		return $connexion ;
	}
	
	function seConnecterGestionnaire($login,$mdp){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$compte = array() ;
			
			$requete = "select nom,prenom" ;
			$requete .= " from Gestionnaire,Personnel" ;
			$requete .= " where Gestionnaire.matricule = Personnel.matricule" ;
			$requete .= " and login = '$login'" ;
			$requete .= " and mdp = '$mdp'" ;
			
			$resultat = $connexion->query($requete) ;
			
			if($resultat->rowCount() == 1){
				$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
				$enregistrement = $resultat->fetch() ;
				$compte["login"] = $login ;
				$compte["nom"] = $enregistrement["nom"] ;
				$compte["prénom"] = $enregistrement["prenom"] ;
			}
			$connexion = null ;
			return $compte ;
		}
		else {
			return FALSE ;
		}
	}
	
	function seConnecterUsager($numeroCarte,$mdp){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$compte = array() ;
			
			$requete = "select nom,prenom,activee" ;
			$requete .= " from Carte,Personnel" ;
			$requete .= " where Carte.matricule = Personnel.matricule" ;
			$requete .= " and numeroCarte = $numeroCarte" ;
			$requete .= " and mdpCarte = '$mdp'" ;
			
			$resultat = $connexion->query($requete) ;
			
			if($resultat->rowCount() == 1){
				$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
				$enregistrement = $resultat->fetch() ;
				$compte["numéroCarte"] = $numeroCarte ;
				$compte["nom"] = $enregistrement["nom"] ;
				$compte["prénom"] = $enregistrement["prenom"] ;
				$compte["solde"] = $enregistrement["solde"] ;
				$compte["carteActivée"] = $enregistrement["activee"] ;
			}
			$connexion = null ;
			return $compte ;
		}
		else {
			return FALSE ;
		}
	}
	
	function getSolde($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$requete = "select solde" ;
			$requete .= " from Carte" ;
			$requete .= " where numeroCarte = '$numeroCarte'" ;
			
			$resultat = $connexion->query($requete) ;
			
			if($resultat->rowCount() == 1){
				$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
				$enregistrement = $resultat->fetch() ;
				$connexion = null ;
				return $enregistrement["solde"] ;
			}
			else {
				$connexion = null ;
				return "inconnu" ;
			}
		}
		else {
			return FALSE ;
		}
	}
	
	function getTarifRepas($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$requete = "select tarifRepas" ;
			$requete .= " from Carte,Personnel,Fonction" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$requete .= " and Carte.matricule = Personnel.matricule" ;
			$requete .= " and Personnel.idFonction = Fonction.idFonction" ;
			
			$resultat = $connexion->query($requete) ;
			
			if($resultat->rowCount() == 1){
				$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
				$enregistrement = $resultat->fetch() ;
				$connexion = null ;
				return $enregistrement["tarifRepas"] ;
			}
			else {
				$connexion = null ;
				return "inconnu" ;
			}
		}
		else {
			return FALSE ;
		}
	}
	
	function debiterSolde($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set solde = (" ;
			$requete .= " select solde - tarifRepas" ;
			$requete .= " from Personnel,Fonction" ;
			$requete .= " where Carte.Matricule = Personnel.matricule" ;
			$requete .= " and Personnel.idFonction = Fonction.idFonction)" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function crediterSolde($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set solde = (" ;
			$requete .= " select solde + tarifRepas" ;
			$requete .= " from Personnel,Fonction" ;
			$requete .= " where Carte.Matricule = Personnel.matricule" ;
			$requete .= " and Personnel.idFonction = Fonction.idFonction)" ;
			$requete .= "where numeroCarte = $numeroCarte" ;
			
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function enregistrerReservation($numeroCarte,$dateReservation){
		
		
		$connexion = connexionBD() ;
		if($connexion === FALSE){
			return FALSE ;
		}
		$requete ="SELECT * FROM Reservation" ;
		$requete .=" WHERE dateResa = '$dateReservation' AND numeroCarte = $numeroCarte ;" ;
		$recherche = $connexion->query($requete) ;
		$resultat = $recherche->fetchAll() ;
		
		if (count($resultat) == 0) {
			$debitOk = debiterSolde($numeroCarte) ;
			
			if($debitOk !== FALSE){
				
				
				
				$requete = "insert into Reservation(dateResa,numeroCarte)" ;
				$requete .= " values('$dateReservation',$numeroCarte)" ;
					
				$insertionOk = $connexion->exec($requete) ;
				$connexion = null ;
				return $insertionOk ;
			
						
			}
			else {
				return FALSE ;
			}
		}
	}
	
	function annulerReservation($numeroCarte,$dateReservation){
		
		$connexion = connexionBD() ;
		if($connexion === FALSE){
			return FALSE ;
		}
		$requete ="SELECT * FROM Reservation" ;
		$requete .=" WHERE dateResa = '$dateReservation' AND numeroCarte = $numeroCarte ;" ;
		$recherche = $connexion->query($requete) ;
		$resultat = $recherche->fetchAll() ;
		
		
		
		//
		if (count($resultat) != 0) {
			$creditOk = crediterSolde($numeroCarte) ;
		
		
			if($creditOk !== FALSE){
				
				
				
				$requete = "delete from Reservation" ;
				$requete .= " where numeroCarte = $numeroCarte" ;
				$requete .= " and dateResa = '$dateReservation'" ;
				
				$suppressionOk = $connexion->exec($requete) ;
				$connexion = null ;
				return $suppressionOk ;
				
					
			}
			else {
				return FALSE ;
			}
		}
	}
	
	function getReservationsCarte($numeroCarte,$dateDebut,$dateFin){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$dates = array() ;
			
			$requete = "select dateResa" ;
			$requete .= " from Reservation" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$requete .= " and dateResa >= '$dateDebut'" ;
			$requete .= " and dateResa <= '$dateFin'" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			while($enregistrement = $resultat->fetch()){
				array_push($dates,$enregistrement["dateResa"]) ;
			}
			$connexion = null ;
			return $dates ;
		}
		else {
			return FALSE ;
		}
	}
	
	function modifierMdpUsager($numeroCarte,$ancienMDP,$nouveauMDP){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$requete = "update Carte" ;
			$requete .= " set mdpCarte = '$nouveauMDP'" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$requete .= " and mdpCarte = '$ancienMDP'" ;
			
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function getReservationsDate($date){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$reservations = array() ;
			
			$requete = "select Carte.numeroCarte,Personnel.nom,Personnel.prenom,Service.nomService" ;
			$requete .= " from Reservation,Carte,Personnel,Service" ;
			$requete .= " where Reservation.numeroCarte = Carte.numeroCarte" ;
			$requete .= " and Carte.matricule = Personnel.matricule" ;
			$requete .= " and Personnel.idService = Service.idService" ;
			$requete .= " and Reservation.dateResa = '$date'" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			while($enregistrement = $resultat->fetch()){
				$uneReservation = array() ;
				$uneReservation["numéroCarte"] = $enregistrement["numeroCarte"] ;
				$uneReservation["nom"] = $enregistrement["nom"] ;
				$uneReservation["prénom"] = $enregistrement["prenom"] ;
				$uneReservation["service"] = $enregistrement["nomService"] ;
				
				array_push($reservations,$uneReservation) ;
			}
			$connexion = null ;
			return $reservations ;
		}
		else {
			return FALSE ;
		}
	}
	
	function getPersonnelsSansCarte(){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$personnelsSansCarte = array() ;
			
			$requete = "select Personnel.matricule,Personnel.nom,Personnel.prenom,Service.nomService" ;
			$requete .= " from Personnel,Service" ;
			$requete .= " where Personnel.idService = Service.idService" ;
			$requete .= " and Personnel.matricule not in (select matricule" ;
			$requete .= " from Carte)" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			while($enregistrement = $resultat->fetch()){
				$unPersonnel = array() ;
				$unPersonnel["matricule"] = $enregistrement["matricule"] ;
				$unPersonnel["nom"] = $enregistrement["nom"] ;
				$unPersonnel["prénom"] = $enregistrement["prenom"] ;
				$unPersonnel["service"] = $enregistrement["nomService"] ;
				
				array_push($personnelsSansCarte,$unPersonnel) ;
			}
			$connexion = null ;
			return $personnelsSansCarte ;
		}
		else {
			return FALSE ;
		}
	}
	
	function getPersonnelsAvecCarte(){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$personnelsAvecCarte = array() ;
			
			$requete = "select Carte.numeroCarte, Carte.solde, Carte.activee, Personnel.matricule,Personnel.nom,Personnel.prenom,Service.nomService" ;
			$requete .= " from Carte,Personnel,Service" ;
			$requete .= " where Carte.matricule = Personnel.matricule" ;
			$requete .= " and Personnel.idService = Service.idService" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			while($enregistrement = $resultat->fetch()){
				$unPersonnel = array() ;
				$unPersonnel["numeroCarte"] = $enregistrement["numeroCarte"] ;
				$unPersonnel["solde"] = $enregistrement["solde"] ;
				if($enregistrement["activee"] == 1){
					$unPersonnel["estActivée"] = TRUE ;
				}
				else {
					$unPersonnel["estActivée"] = FALSE ;
				}
				$unPersonnel["matricule"] = $enregistrement["matricule"] ;
				$unPersonnel["nom"] = $enregistrement["nom"] ;
				$unPersonnel["prénom"] = $enregistrement["prenom"] ;
				$unPersonnel["service"] = $enregistrement["nomService"] ;
				
				array_push($personnelsAvecCarte,$unPersonnel) ;
			}
			$connexion = null ;
			return $personnelsAvecCarte ;
		}
		else {
			return FALSE ;
		}
	}
	
	function getHistoriqueReservationsCarte($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$reservations = array() ;
			
			$requete = "select dateResa" ;
			$requete .= " from Reservation" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$requete .= " order by dateResa DESC" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			while($enregistrement = $resultat->fetch()){
				array_push($reservations,$enregistrement["dateResa"]) ;
			}
			$connexion = null ;
			return $reservations ;
		}
		else {
			return FALSE ;
		}
	}
	
	function activerCarte($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set activee = True" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function bloquerCarte($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion != FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set activee = False" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;	
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function creerCarte($matriculePersonnel,$carteActivee=FALSE){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			if($carteActivee == TRUE){
				$activee = 'True' ;
			}
			else {
				$activee = 'False' ;
			}
			
			$requete = "insert into Carte(dateCreation,activee,matricule,mdpCarte)" ;
			$requete .= " values(" ;
			$requete .= " current_date()," ;
			$requete .= " $activee," ;
			$requete .= " $matriculePersonnel," ;
			$requete .= " (select YEAR(dateNaissance)" ;
			$requete .= " from Personnel" ;
			$requete .= " where matricule = $matriculePersonnel" ;
			$requete .= " ))" ;
			
			$creationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $creationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function crediterCarte($numeroCarte,$somme){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set solde = solde + $somme" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	function reinitialiserMDP($numeroCarte){
		$connexion = connexionBD() ;
		
		if($connexion != FALSE){
			
			$requete = "update Carte" ;
			$requete .= " set mdpCarte = (select YEAR(dateNaissance)" ;
			$requete .= " from Personnel" ;
			$requete .= " where Carte.Matricule = Personnel.matricule" ;
			$requete .= " )" ;
			$requete .= " where numeroCarte = $numeroCarte" ;
			
			$modificationOk = $connexion->exec($requete) ;
			$connexion = null ;
				
			return $modificationOk ;
		}
		else {
			return FALSE ;
		}
	}
	
	//Ajouts 
	
	function getInfosPersonnel($matricule){
		$connexion = connexionBD() ;
		
		if($connexion !== FALSE){
			$personnelsSansCarte = array() ;
			
			$requete = "select Personnel.matricule,Personnel.nom,Personnel.prenom,Service.nomService" ;
			$requete .= " from Personnel,Service" ;
			$requete .= " where Personnel.idService = Service.idService" ;
			$requete .= " and Personnel.matricule = $matricule ;" ;
			
			$resultat = $connexion->query($requete) ;
			$resultat->setFetchMode(PDO::FETCH_ASSOC) ;
			
			$enregistrement = $resultat->fetch();
			$unPersonnel = array() ;
			$unPersonnel["matricule"] = $enregistrement["matricule"] ;
			$unPersonnel["nom"] = $enregistrement["nom"] ;
			$unPersonnel["prénom"] = $enregistrement["prenom"] ;
			$unPersonnel["service"] = $enregistrement["nomService"] ;
			$connexion = null ;
			return $unPersonnel ;
				
			/*
			while($enregistrement = $resultat->fetch()){
				$unPersonnel = array() ;
				$unPersonnel["matricule"] = $enregistrement["matricule"] ;
				$unPersonnel["nom"] = $enregistrement["nom"] ;
				$unPersonnel["prénom"] = $enregistrement["prenom"] ;
				$unPersonnel["service"] = $enregistrement["nomService"] ;
				
				array_push($personnelsSansCarte,$unPersonnel) ;
			}
			$connexion = null ;
			return $personnelsSansCarte ;
			*/
		}
		else {
			return FALSE ;
		}
	}
	
	
	function joursFeries($date){
		
		list($annee, $mois, $jour) = explode("-", $date) ;
		
		$connexion = connexionBD() ;
				
		$requete ="SELECT * FROM JoursFeries" ;
		$requete .=" WHERE jour = $jour AND mois = $mois ;" ;
		$recherche = $connexion->query($requete) ;
		$resultat = $recherche->fetchAll() ;
		
		if(count($resultat) === 0) {
			return false ;
		}
		else {
			return true ;
		}
		
	
	}
	
	function ajouterJourFerie($id, $jour, $mois) {
		$connexion = connexionBD() ;
		
		$requete = "INSERT INTO JoursFeries VALUES ('$id', $jour, $mois) ; " ;
		
		$ajoutOk = $connexion->exec($requete) ;
		$connexion = null ;
		return $ajoutOk ;
		 
	}
	
	function afficherNbreJoursFeries() {
		$connexion = connexionBD() ;
		
		$requete = "SELECT count(*) FROM JoursFeries" ;
		
		$recherche = $connexion->query($requete) ;
		$resultat = $recherche->fetch(PDO::FETCH_NUM)[0] ;
		
		return $resultat ;
		
	}
	
	function afficherJoursFeries() {
		$connexion = connexionBD() ;
		
		$requete = "SELECT * FROM JoursFeries" ;
		
		$recherche = $connexion->query($requete) ;
		$resultat = $recherche->fetchAll() ;
		
		return $resultat ;

	}
	
	function supprimerJoursFeries($id) {
		
		$connexion = connexionBD() ;
		
		$requete = "DELETE FROM JoursFeries " ;
		$requete .= "WHERE id_joursFeries = '$id' ;" ;
		
		$suppressionOk = $connexion->exec($requete) ;
		$connexion = null ;
		return $suppressionOk ;
	}
	
?>
