<?php	
	$login = $_SESSION["login"] ;
	$nom = $_SESSION["nom"] ;
	$prenom = $_SESSION["prénom"] ;
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
				<!--<li><a href="#" onClick='document.getElementById("lienListerReservations").submit()'>Réservations</a></li>-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Personnels<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="#" onClick='document.getElementById("lienConsulterPersonnelsAvecCarte").submit()'>Personnels avec carte</a></li>
					  <li><a href="#" onClick='document.getElementById("lienConsulterPersonnelsSansCarte").submit()'>Personnels sans carte</a></li>
					</ul>
				</li>
				<!--
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cartes<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="#" onClick='document.getElementById("lienCreerCarte").submit()'>Créer</a></li>
					  <li><a href="#" onClick='document.getElementById("lienGererCartes").submit()'>Gérer</a></li>
					</ul>
				</li>
				-->
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gestion<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="#" onClick='document.getElementById("lienConsulterJoursFeries").submit()'>Jours fériés</a></li>
					</ul>
				</li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Réservations<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="#" onClick='document.getElementById("lienConsulterResasDate").submit()'>Pour une date</a></li>
					  <!--<li><a href="#" onClick='document.getElementById("lienConsulterResasCarte").submit()'>Pour une carte</a></li>-->
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!--
				<li><p class="navbar-text"><?php echo $gestionnaire ; ?></p></li>
				-->
				<li><p class="navbar-text"><?php echo $nom , " ", $prenom ; ?></p></li>
				<li><a href="#" onClick='document.getElementById("lienSeDeconnecter").submit()'>Se déconnecter</a></li>
            </ul>
		</div>
	</div>
</nav>

<form id="lienSeDeconnecter" action="index.php" method="POST">
	<input type="hidden" name="action" value="seDeconnecter" />
</form>

<form id="lienConsulterPersonnelsAvecCarte" action="index.php" method="POST">
	<input type="hidden" name="action" value="lienConsulterPersonnelsCarte" />
</form>

<form id="lienConsulterPersonnelsSansCarte" action="index.php" method="POST">
	<input type="hidden" name="action" value="lienConsulterPersonnelsSansCarte" />
</form>

<form id="lienCreerCarte" action="index.php" method="POST">
	<input type="hidden" />
</form>

<form id="lienGererCartes" action="index.php" method="POST">
	<input type="hidden" />
</form>

<form id="lienConsulterResasDate" action="index.php" method="POST">
	<input type="hidden" name="action" value="lienConsulterResasDate" />
</form>

<form id="lienConsulterResasCarte" action="index.php" method="POST">
	<input type="hidden" />
</form>

<form id="lienConsulterJoursFeries" action="index.php" method="POST">
	<input type="hidden"  name="action" value="lienConsulterJoursFeries" />
</form>
