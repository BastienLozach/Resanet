
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>




<!--bouton bloquer -->
<form id="bloquerCarte" action="index.php" method="POST">
		<input type="hidden" name="action" value="bloquerCarte"/>
		<input type="hidden" id="numCarte" name="numCarte" value=""/>
</form>

<script type="text/javascript">
	
	function bloquerCarte(numCarte){
		var champNumCarte = document.getElementById("numCarte") ;
		champNumCarte.value =  numCarte;
		document.getElementById("bloquerCarte").submit() ;
	}
	
</script>

<!--bouton activer -->
<form id="activerCarte" action="index.php" method="POST">
		<input type="hidden" name="action" value="activerCarte"/>
		<input type="hidden" id="numCarteB" name="numCarte" value=""/>
</form>

<script type="text/javascript">
	
	function activerCarte(numCarte){
		var champNumCarte = document.getElementById("numCarteB") ;
		champNumCarte.value =  numCarte;
		document.getElementById("activerCarte").submit() ;
	}
	
</script>

<!--bouton Init. MDP -->
<form id="reinitialiserMDP" action="index.php" method="POST">
		<input type="hidden" name="action" value="reinitialiserMDP"/>
		<input type="hidden" id="numCarteC" name="numCarte" value=""/>
</form>

<script type="text/javascript">
	
	function reinitialiserMDP(numCarte){
		var champNumCarte = document.getElementById("numCarteC") ;
		champNumCarte.value =  numCarte;
		document.getElementById("reinitialiserMDP").submit() ;
	}
	
</script>

<!--bouton Crediter -->
<form id="crediterCarte" action="index.php" method="POST">
		<input type="hidden" name="action" value="crediterCarte"/>
		<input type="hidden" id="numCarteD" name="numCarte" value=""/>
		<input type="hidden" id="somme" name="somme" value=""/>
</form>

<script type="text/javascript">
	
	function crediterCarte(numCarte){
		var somme = 0 ;
		somme = prompt("Somme à créditer (en euro) : ", "somme") ;
		
		while(somme < 0 || isNaN(somme) ){
			somme = 0 ;
			somme = prompt("Somme à créditer (en euro)(doit être un nombre positif) : ", "somme") ;
		}
		
		if (somme != 0 && somme != null && somme != ""){
			var champNumCarte = document.getElementById("numCarteD") ;
			champNumCarte.value =  numCarte;
			var champSomme = document.getElementById("somme") ;
			champSomme.value =  somme;
			document.getElementById("crediterCarte").submit() ;
		}
		
	}
	
</script>


<!--bouton historique -->
<form id="historiqueCarte" action="index.php" method="POST">
		<input type="hidden" name="action" value="historiqueCarte"/>
		<input type="hidden" id="numCarteE" name="numCarte" value=""/>
</form>

<script type="text/javascript">
	
	function historiqueCarte(numCarte){
		var champNumCarte = document.getElementById("numCarteE") ;
		champNumCarte.value =  numCarte;
		document.getElementById("historiqueCarte").submit() ;
	}
	
</script>

<table class="table">
	
	<thead>
	<tr>
		<th>N° Carte</th>
		<th>Solde</th>
		<th>Matricule</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Service</th>
	</tr>
	</thead>
	<tbody>
		
	<?php
		require_once("modele/modele.php") ;
		$listePersonnelAvecCarte = getPersonnelsAvecCarte() ;
		for ($i = 0 ; $i < count($listePersonnelAvecCarte) ; $i++) {
			echo "<tr>" ;
			echo "<td>" .$listePersonnelAvecCarte[$i]["numeroCarte"] . "</td>"; 
			echo "<td>" .$listePersonnelAvecCarte[$i]["solde"] . "</td>"; 
			echo "<td>" .$listePersonnelAvecCarte[$i]["matricule"] . "</td>"; 
			echo "<td>" .$listePersonnelAvecCarte[$i]["nom"] . "</td>"; 
			echo "<td>" .$listePersonnelAvecCarte[$i]["prénom"] . "</td>"; 
			echo "<td>" .$listePersonnelAvecCarte[$i]["service"] . "</td>";
			
			if ($listePersonnelAvecCarte[$i]["estActivée"] == TRUE) {
				echo '<td><button type="button" id="'.$i.'Crediter'.'" class="btn btn-primary" OnClick="crediterCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Créditer</button></td>' ;
				echo '<td><button type="button" id="'.$i.'Bloquer'.'"  class="btn btn-primary" OnClick="bloquerCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Bloquer</button></td>' ;
				echo '<td><button type="button" id="'.$i.'InitMDP'.'" class="btn btn-primary" OnClick="reinitialiserMDP('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Init. MDP</button></td>' ;
			}
			else{ 
				echo "<td> </td>" ;
				echo '<td><button type="button" id="'.$i.'Activer'.'"  class="btn btn-primary" OnClick="activerCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Activer</button></td>' ;
				echo "<td> </td>" ;
			}
			
			//copy-paste from vueListeReservation.php
			//echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
			//<button type="button" id="trucunique" class="trucjolie" OnClick="bloquerCarte($listePersonnelAvecCarte[$i]["numeroCarte"])"> Boutton </button>
			//copy-paste
			
			echo '<td><button type="button" id="'.$i.'Historique'.'" class="btn btn-primary" OnClick="historiqueCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Historique</button></td>' ;
			
			
			echo "</tr>" ; 
		}
	?>
	</tbody>
</table>

<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
		<?php
			session_start() ;
			
			if(isset($_SESSION["initMDP"])) {
				echo '<p class="alert alert-danger" role="alert">Reinitialisation du mot de passe pour la carte '.$_SESSION["initMDP"].'</p>' ;
				unset($_SESSION["initMDP"]);
			}
			if(isset($_SESSION["crediterCarteNum"])) {
				echo '<p class="alert alert-success" role="alert">La carte '.$_SESSION["crediterCarteNum"].' a été créditée de '.
					$_SESSION["crediterCarteSomme"].'€</p>' ;
				unset($_SESSION["crediterCarteNum"]);
				unset($_SESSION["crediterCarteSomme"]);
			}
		?>
		</div>
		
</div>





<?php
	require_once("vues/vuePied.php") ;
?>
