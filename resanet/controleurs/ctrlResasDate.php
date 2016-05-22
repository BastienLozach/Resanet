<?php
	
	$date = $_REQUEST["dateResas"] ;
	
	require_once("technique/datesResanet.php") ;
	
	$dateEN = convertirDateFRversEN($date) ;
	
	session_start() ;
	$_SESSION["dateResas"] = $dateEN ;
	$_SESSION["dateResasFR"] = $date ;
	
	require_once("vues/vueResasDate.php") ;
	
	

?>



