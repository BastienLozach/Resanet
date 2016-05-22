
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>




<!--bouton supprimerJoursFeries -->
<form id="supprimerJoursFeries" action="index.php" method="POST">
		<input type="hidden" name="action" value="supprimerJoursFeries"/>
		<input type="hidden" id="id_joursFeries1" name="joursFeries" value=""/>
</form>

<script type="text/javascript">
	
	function supprimerJoursFeries(id_joursFeries){
		var champId_joursFeries = document.getElementById("id_joursFeries1") ;
		champId_joursFeries.value =  id_joursFeries;
		document.getElementById("supprimerJoursFeries").submit() ;
	}
	
</script>

<!--bouton ajouterJoursFeries -->
<form id="ajouterJoursFeries" action="index.php" method="POST">
		<input type="hidden" name="action" value="ajouterJoursFeries"/>
</form>

<script type="text/javascript">
	
	function ajouterJoursFeries(){
		document.getElementById("ajouterJoursFeries").submit() ;
	}
</script>

<table class="table">
	
	<thead>
	<tr>
		<th>id</th>
		<th>Jour</th>
		<th>Mois</th>
	</tr>
	</thead>
	<tbody>
		
	<?php
		require_once("modele/modele.php") ;
		$listeJoursFeries = afficherJoursFeries() ;
		for ($i = 0 ; $i < count($listeJoursFeries) ; $i++) {
			echo "<tr>" ;
			echo "<td>" .$listeJoursFeries[$i]["id_joursFeries"] . "</td>"; 
			echo "<td>" .$listeJoursFeries[$i]["jour"] . "</td>"; 
			echo "<td>" .$listeJoursFeries[$i]["mois"] . "</td>"; 
						
		
			echo '<td><button type="button" id="'.$i.'Supprimer'.'" class="btn btn-primary" OnClick="supprimerJoursFeries('."'".$listeJoursFeries[$i]["id_joursFeries"]."'".')"> Supprimer</button></td>' ;
		
			/*else{ 
				echo "<td> </td>" ;
				echo '<td><button type="button" id="'.$i.'Activer'.'"  class="btn btn-primary" OnClick="activerCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Activer</button></td>' ;
				echo "<td> </td>" ;
			}*/
			
			//copy-paste from vueListeReservation.php
			//echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
			//<button type="button" id="trucunique" class="trucjolie" OnClick="bloquerCarte($listePersonnelAvecCarte[$i]["numeroCarte"])"> Boutton </button>
			//copy-paste
			
			//echo '<td><button type="button" id="'.$i.'Historique'.'" class="btn btn-primary" OnClick="historiqueCarte('.$listePersonnelAvecCarte[$i]["numeroCarte"].')"> Historique</button></td>' ;
			
			
			echo "</tr>" ; 
			
			
			
		}
		echo '<td><button type="button" id="'.$i.'Ajouter'.'" class="btn btn-primary" OnClick="ajouterJoursFeries()"> Ajouter</button></td>' ;
		
	?>
	</tbody>
</table>

<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
		<?php
			session_start() ;
			
			if(isset($_SESSION["supprimer"])) {
				echo '<p class="alert alert-danger" role="alert">Le jour férié a été supprimé avec succès '.$_SESSION["supprimer"].'</p>' ;
				unset($_SESSION["supprimer"]);
			}
			if(isset($_SESSION["ajouterJoursFeries"])) {
				echo '<p class="alert alert-success" role="alert">La date a été ajouté avec succès '.
					$_SESSION["crediterCarteSomme"].'€</p>' ;
				unset($_SESSION["crediterCarteNum"]);
				unset($_SESSION["crediterCarteSomme"]);
			}
			if(isset($_SESSION["erreurAjout"])) {
				echo '<p class="alert alert-danger" role="alert">L\'ajout du jour férié a échoué </p>' ;
				unset($_SESSION["erreurAjout"]);
			}
		?>
		</div>
		
</div>




<?php
	require_once("vues/vuePied.php") ;
?>
