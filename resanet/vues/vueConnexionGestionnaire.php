<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteAuthentification.php") ;
?>
<!--
<form action="index.php" method="POST">

	Nom de connexion
	<input type="text" name="login"/>
	Mot de passe
	<input type="password" name="mdp"/>
	<input type="hidden" name="action" value="seConnecterGestionnaire"/>
	<button type="submit">Se connecter</button>
</form>
-->
<div class="container-fluid">
	
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form role="form" action="index.php" method="POST">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" class="form-control" name="login" id="login" placeholder="Saisir le login"/>
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisir le mot de passe"/>
				</div>
				<input type="hidden" name="action" value="seConnecterGestionnaire"/>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
			
		<div class="col-md-4"></div>
	</div>

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
				if(isset($echecConnexion) && $echecConnexion == TRUE){
					echo '<p class="alert alert-danger" role="alert">Echec à l\'authentification. Login et/ou mot de passe incorrects.</p>' ;
				}
				if(isset($saisieIncomplete) && $saisieIncomplete == TRUE){
					echo '<p class="alert alert-danger" role="alert">Saisie incomplète. Recommencez...</p>' ;
				}
			?>
		</div>
		<div class="col-md-4"></div>
	</div>
	
</div>
		

<?php
	require_once("vues/vuePied.php") ;
?>
