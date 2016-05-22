<?php
		require_once("modele/modele.php") ;
		
		$numeroCarte = $_SESSION["numéroCarte"] ;
		$nom = $_SESSION["nom"] ;
		$prenom = $_SESSION["prénom"] ;
		$solde = getSolde($numeroCarte) ;
		$usager = "$nom $prenom (Solde : $solde €)" ;
?>


<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">Résanet</span>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="#" onClick='document.getElementById("lienListerReservations").submit()'>Réservations</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Compte<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="#" onClick='document.getElementById("lienModifierMDP").submit()'>Modifier Mot de Passe</a></li>
					</ul>
              </li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><p class="navbar-text"><?php echo $usager ; ?></p></li>
				<li><a href="#" onClick='document.getElementById("lienSeDeconnecter").submit()'>Se déconnecter</a></li>
            </ul>
		</div>
	</div>
</nav>

<form id="lienSeDeconnecter" action="index.php" method="POST">
	<input type="hidden" name="action" value="seDeconnecter" />
</form>

<form id="lienListerReservations" action="index.php" method="POST">
	<input type="hidden" name="action" value="annulerModificationMDP" />
</form>

<form id="lienModifierMDP" action="index.php" method="POST">
	<input type="hidden" name="action" value="choisirModifierMDP" />
</form>
