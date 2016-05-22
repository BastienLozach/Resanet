<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteUsager.php") ;
	$_SESSION["modifMDP"] = TRUE ;
?>

<script type="text/javascript">
	
	function modifierMDP(){
		var mdp1 = document.getElementById("mdp1").value ;
		var mdp2 = document.getElementById("mdp2").value ;
		if(mdp1 == mdp2){
			document.getElementById("lienModificationMDP").submit() ;
		}
		else {
			$("#erreurSaisie").modal("show") ;
			document.getElementById("mdp1").value = "" ;
			document.getElementById("mdp2").value = "" ;
		}
	}
	
</script>

<div class="container-fluid">

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
				
				if(isset($etatModificationMDP) && $etatModificationMDP == 0){
					echo '<p class="alert alert-danger" role="alert">Modification du mot de passe refusée.</p>' ;
				}

			?>
		</div>
		<div class="col-md-4"></div>
	</div>
	
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">

			<form id="lienModificationMDP" role="form" action="index.php" method="POST">
				<div class="form-group">
					<label for="mdp">Ancien mot de passe</label>
					<input type="password" class="form-control" name="ancienMDP" id="mdp" placeholder="Saisir l'ancien mot de passe"/>
				</div>
				<div class="form-group">
					<label for="mdp1">Nouveau mot de passe</label>
					<input id="mdp1" class="form-control" type="password" name="nouveauMDP" placeholder="Saisir le nouveau mot de passe"/>
				</div>
				<div class="form-group">
					<label for="mdp2">Nouveau mot de passe :</label>
					<input id="mdp2" class="form-control" type="password" name="nouveauMDPVerif" placeholder="Re-saisir le nouveau mot de passe"/>
				</div>
				
				<input type="hidden" name="action" value="modifierMDP" />

			</form>
			
			<button type="button" class="btn btn-primary" onClick='modifierMDP()'>Modifier</button>
			
		</div>
		<div class="col-md-4"></div>
	</div>

</div>

<div class="modal fade" id="erreurSaisie" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Saisies incorrectes</h4>
      </div>
      <div class="modal-body">
        Les deux saisies du nouveau mot de passe sont différentes. Recommencez...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<?php
	require_once("vues/vuePied.php") ;
?>

