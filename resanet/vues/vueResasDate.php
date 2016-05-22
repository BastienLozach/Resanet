
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>

<?php
	
	
	session_start() ;
	
	
	$date = $_SESSION["dateResas"] ;
	$dateFR = $_SESSION["dateResasFR"] ;
	echo "Réservations effectuées le " , $dateFR ;
	
	require_once("modele/modele.php") ;
	
	
	$liste = getReservationsDate($date) ;
	
	
?>



<table class="table">
	
	<thead>
	<tr>
		<th>Numéro de la carte</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Service</th>
		
	</tr>
	</thead>
	
	
	<tbody>
		
	<?php
		for($i = 0 ; $i < count($liste) ; $i++){
			echo '<tr>' ;
			echo '<td>' .$liste[$i]["numéroCarte"].'</td>';
			echo '<td>' .$liste[$i]["nom"].'</td>';
			echo '<td>' .$liste[$i]["prénom"].'</td>';
			echo '<td>' .$liste[$i]["service"].'</td>';
			echo '</tr>' ;			
		}
		if(count($liste) == 0){
			echo "<tr><td>Il n'y a pas de réservation</td></tr>" ;
		}
		
	?>
	</tbody>
</table>

<!--bouton resasDate -->
<form id="resasDate" action="index.php" method="POST">
		<input type="hidden" name="action" value="lienConsulterResasDate"/>
</form>

<button type="button" Onclick='document.getElementById("resasDate").submit()' >Voir une autre date</button>


<?php
	require_once("vues/vuePied.php") ;
?>
