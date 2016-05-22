<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteAuthentification.php") ;
?>
<script>
	function validateForm() {
			var numero = document.getElementById("numeroCarte").value ;
			
			var regex = /^[0-9]{1,}$/ ;
			var test = regex.test(numero) ;
		
			if(test == false) {
				alert("Veuillez entrer un identifiant valide (un nombre)") ;
				return false ;
			}
	}
	
	
</script>



<div class="container-fluid">

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
				if(isset($carteBloquee) && $carteBloquee == TRUE){
					echo '<p class="alert alert-danger" role="alert">Carte bloquée. Contactez le gestionnaire.</p>' ;
				}
				if(isset($echecConnexion) && $echecConnexion == TRUE){
					echo '<p class="alert alert-danger" role="alert">Echec à l\'authentification. Numéro de carte et/ou mot de passe incorrects.</p>' ;
				}
				if(isset($saisieIncomplete) && $saisieIncomplete == TRUE){
					echo '<p class="alert alert-danger" role="alert">Saisie incomplète. Recommencez...</p>' ;
				}
			?>
		</div>
		<div class="col-md-4"></div>
	</div>

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form role="form" action="index.php" onsubmit="return validateForm()" method="POST">
				<div class="form-group">
					<label for="numeroCarte">Numéro de la carte</label>
					<input type="text" class="form-control" name="numeroCarte" id="numeroCarte" placeholder="Saisir le numéro de la carte"/>
					
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisir le mot de passe"/>
				</div>
				<input type="hidden" name="action" value="seConnecterUsager"/>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
			
		<div class="col-md-4"></div>
	</div>

</div>

<?php
	require_once("vues/vuePied.php") ;
?>
