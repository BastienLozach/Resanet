<?php
	session_start() ;
	session_destroy() ;
	
	session_start() ;
	$_SESSION["error"] = true ;
	
	require_once("vues/vueAccueil.php") ;

?>
