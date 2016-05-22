
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>

<!--bouton creerCarte -->
<form id="creerCarte" action="index.php" method="POST">
		<input type="hidden" name="action" value="creerCarte"/>
		<input type="hidden" id="numCarte" name="numCarte" value=""/>
</form>

<script type="text/javascript">
	
	function creerCarte(numCarte){
		var champNumCarte = document.getElementById("numCarte") ;
		champNumCarte.value =  numCarte;
		document.getElementById("creerCarte").submit() ;
	}
	
</script>


<table class="table">
	
	<thead>
	<tr>
		<th>Matricule</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Service</th>
	</tr>
	</thead>
	<tbody>
		
	<?php
		require_once("modele/modele.php") ;
		$listePersonnelSansCarte = getPersonnelsSansCarte() ;
		for ($i = 0 ; $i < count($listePersonnelSansCarte) ; $i++) {
			echo "<tr>" ;
			echo "<td>" .$listePersonnelSansCarte[$i]["matricule"] . "</td>"; 
			echo "<td>" .$listePersonnelSansCarte[$i]["nom"] . "</td>"; 
			echo "<td>" .$listePersonnelSansCarte[$i]["prénom"] . "</td>"; 
			echo "<td>" .$listePersonnelSansCarte[$i]["service"] . "</td>";
			
			//echo '<td><button type="button" id="'.$i.'creerCarte'.'"  class="btn btn-primary" OnClick="creerCarte('.$listePersonnelSansCarte[$i]["numeroCarte"].')"> Créer une carte</button></td>' ;
			echo '<td><button type="button" id="'.$i.'creerCarte'.'"  class="btn btn-primary" OnClick="creerCarte('.$listePersonnelSansCarte[$i]["matricule"].')"> Créer une carte</button></td>' ;
					
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
				echo '<p class="alert alert-success" role="alert">La carte '.$_SESSION["crediterCarteNum"].' a été créditer de '.
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
