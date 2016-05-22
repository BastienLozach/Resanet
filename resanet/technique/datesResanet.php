<?php

	function convertirDateENversFR($dateEN){
		$champsDateEN = explode("-",$dateEN) ;
		$champsDateFR = array_reverse($champsDateEN) ;
		$dateFR = implode("/",$champsDateFR) ;
		return $dateFR ;
	}
	
	function convertirDateFRversEN($dateFR){
		$champsDateFR = explode("/",$dateFR) ;
		$champsDateEN = array_reverse($champsDateFR) ;
		$dateEN = implode("-",$champsDateEN) ;
		return $dateEN ;
	}
	
	function getDateAujourdhuiEN(){
		$aujourdhui = new DateTime() ;
		$aujourdhuiEN = $aujourdhui->format("Y-m-d") ;
		return $aujourdhuiEN ;
	}
	
	function getDateAujourdhuiFR(){
		$aujourdhui = new DateTime() ;
		$aujourdhuiFR = $aujourdhui->format("d/m/Y") ;
		return $aujourdhuiFR ;
	}
	
	function getDatesPeriodeCouranteEN(){
		$datesEN = array() ;
		
		$aujourdhui = new DateTime() ;
		
		if($aujourdhui->format("l") != "Monday"){
			$dateDebutSemaine1 = new DateTime('previous monday') ;
		}
		else {
			$dateDebutSemaine1 = clone $aujourdhui ;
		}
		
		$dateFinSemaine1 = clone $dateDebutSemaine1 ;
		$dateFinSemaine1->modify('+5 days') ;
		
		$dateDebutSemaine2 = clone $dateDebutSemaine1 ;
		$dateDebutSemaine2->modify('+7 days') ;
		
		$dateFinSemaine2 = clone $dateFinSemaine1 ;
		$dateFinSemaine2->modify('+7 days') ;
		
		$intervale = new DateInterval('P1D') ;
		
		$periode1 = new DatePeriod($dateDebutSemaine1,$intervale,$dateFinSemaine1) ;
		foreach($periode1 as $uneDate){
			$uneDateEN = $uneDate->format("Y-m-d") ;
			array_push($datesEN,$uneDateEN) ;
		}
		
		$periode2 = new DatePeriod($dateDebutSemaine2,$intervale,$dateFinSemaine2) ;
		foreach($periode2 as $uneDate){
			$uneDateEN = $uneDate->format("Y-m-d") ;
			array_push($datesEN,$uneDateEN) ;
		}
		
		return $datesEN ;
	}
	

?>
