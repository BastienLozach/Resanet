
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>

<?php
				$numCarte = $_REQUEST["numCarte"] ;
				//echo "carte : " , $numCarte ;
?>


		
<?php	
		
	require_once("modele/modele.php") ;
	$info = getInfosPersonnel($numCarte);
	echo "<p>" ;
	echo "<strong>Matricule</strong> : ", $info["matricule"] , "<br />" ;
	echo "<strong>Nom</strong> : " , $info["nom"] , "<br />" ; 
	echo "<strong>Prénom</strong> : " , $info["prénom"] , "<br />" ;
	echo "<strong>Service</strong> : " , $info["service"] , "<br />" ;
	echo "</p>" ;	
?>
<form id="creerCompte" action="index.php" method="POST">
		<input type="hidden" name="action" value="creerCompte"/>
		<input type="hidden" id="numCarte" name="numCarte" value="<?php echo $numCarte;?>"/>
		<input type="checkbox" name="activee" /><label for="activee">activée</label>
		<input type="submit" value="Créer le compte" />
		
</form>









<?php
	require_once("vues/vuePied.php") ;
?>
