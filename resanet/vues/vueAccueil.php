<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteAccueil.php") ;
?>
<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
		<?php
			session_start() ;
			
			if(isset($_SESSION["error"])) {
				echo '<p class="alert alert-danger" role="alert">Erreur : impossible de joindre la base de données</p>' ;
				unset($_SESSION["error"]);
			}

		?>
		</div>
		
</div>

<div class="container-fluid">

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="index.php" method="POST">
				<input type="hidden" name="action" value="choisirSessionUsager" />
				<button type="submit" class="btn btn-primary btn-lg btn-block">Usager</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
	<p></p>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="index.php" method="POST">
				<input type="hidden" name="action" value="choisirSessionGestionnaire" />
				<button type="submit" class="btn btn-primary btn-lg btn-block">Gestionnaire</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>

</div>


<?php
	require_once("vues/vuePied.php") ;
?>
