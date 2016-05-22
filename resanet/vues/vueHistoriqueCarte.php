
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>



<table class="table">
	
	<thead>
	<tr>
		<th>
			<?php
				$numCarte = $_REQUEST["numCarte"] ;
				echo "Historique de la carte " , $numCarte ;
			?>
		</th>
		
	</tr>
	</thead>
	
	
	<tbody>
		
	<?php
		
		
		
		require_once("modele/modele.php") ;
		$historiqueCarte = getHistoriqueReservationsCarte($numCarte) ;
		
		//$historiqueCarte = array ("date1","date2","date3","date4") ;
		for($i = 0 ; $i < count($historiqueCarte) ; $i++){
			list($annee,$mois,$jour) = explode("-",$historiqueCarte[$i]) ;
			echo '<tr><td>'."$jour/$mois/$annee" ;
			echo '</td></tr>';
			
			
		}
		if(count($historiqueCarte) == 0){
			echo "<tr><td>Il n'y a pas de réservation</td></tr>" ;
		}
		
	?>
	</tbody>
</table>







<?php
	require_once("vues/vuePied.php") ;
?>
