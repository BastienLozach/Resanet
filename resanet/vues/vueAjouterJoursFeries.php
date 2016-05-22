
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>



<form action="index.php" method="POST">
		<input type="hidden" name="action" value="validerJoursFeries"/>
		<label>id jour ferie</label>
		<input type="text" name="libelle" value=""/>
		<br />
		<label>jour ferie</label>
		<input type="text" name="jour" value=""/>
		<br />
		<label>mois du jour ferie</label>
		<input type="text" name="mois" value=""/>
		
		<br />
		<input type="reset" value="annuler"/>
		<input type="submit" value="valider"/>
</form>






<?php
	
	//echo '<td><button type="button" id="'.$i.'Valider'.'" class="btn btn-primary" OnClick="ValiderJoursFeries()"> Valider</button></td>' ;

	
	require_once("vues/vuePied.php") ;
?>
