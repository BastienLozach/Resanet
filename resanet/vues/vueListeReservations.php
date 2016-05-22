<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteUsager.php") ;
	require_once("modele/modele.php") ;
	require_once("technique/datesResanet.php") ;
?>

<?php
if(!joursFeries(getDateAujourdhuiEN()) ) { ?>
<script type="text/javascript">
	function verifHeure() {
		
		
		var date = new Date() ;
		var id = '<?php echo getDateAujourdhuiEN() ; ?>' ;
		
		if ( date.getHours() == 10 && date.getMinutes() > 20
			|| date.getHours() > 10 ){
			document.getElementById(id).disabled = true; 
		}
		
		else {
			
			document.getElementById(id).disabled = false; 
		}
		
		
		
	}
	
	window.onload = function() {
			
			verifHeure();
			setInterval(verifHeure, 60000); 
	}
	

</script>
<?php
}
?>

<script type="text/javascript">
	
	function modifierResa(dateReservation,etatPrecedent){
		var champDateResa = document.getElementById("dateResa") ;
		var champEtatResa = document.getElementById("etatResa") ;
		champDateResa.value = dateReservation ;
		if(etatPrecedent == "annulée"){
			champEtatResa.value = "enregistrée" ;
		}
		else {
			champEtatResa.value = "annulée" ;
		}
		document.getElementById("choixDate").submit() ;
	}
	
</script>

<div class="container-fluid"  onload="onload()">

	<?php

		$numeroCarte = $_SESSION["numéroCarte"] ;
		$solde = getSolde($numeroCarte) ;
		$tarifRepas = getTarifRepas($numeroCarte) ;
		
		$dateJourCourant = getDateAujourdhuiFR() ;
		
		$dateAujourdhui = getDateAujourdhuiEN() ;
		$datesPeriode = getDatesPeriodeCouranteEN() ;
		$datesResa = getReservationsCarte($numeroCarte,$datesPeriode[0],$datesPeriode[9]) ;
	?>
	
	<p>
		Nous sommes le 
		<?php
			echo $dateJourCourant ;
		?>
		.
	</p>
	
	<div class="row">
		<div class="col-md-1"></div>
		<?php
			for($i = 0 ; $i < 5; $i++){
				echo '<div class="col-md-1">' ;
				echo '<button type="button" id="' . $datesPeriode[$i] . '" ';
				if($datesPeriode[$i] <= $dateAujourdhui){
					echo 'disabled="disabled" ' ;
								
				}
				
				if (joursFeries($datesPeriode[$i])) {
					echo 'disabled="disabled" ' ;
				}
				elseif($solde >= $tarifRepas && in_array($datesPeriode[$i],$datesResa) == TRUE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
				}
				elseif($solde >= $tarifRepas && in_array($datesPeriode[$i],$datesResa) == FALSE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"annulée\")' " ;
				}
				elseif($solde < $tarifRepas && in_array($datesPeriode[$i],$datesResa) == TRUE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
				}
				else{
					echo 'disabled="disabled" ' ;
				}
					
							
				
				$classeBouton = "btn " ;
				if(in_array($datesPeriode[$i],$datesResa) == TRUE){
					$classeBouton .= "btn-success" ;
				}
				else {
					$classeBouton .= "btn-default" ;
				}
				echo 'class="' . $classeBouton . '"> ' . convertirDateENversFR($datesPeriode[$i]) . '</button>' ;
				echo '</div>' ;
				echo '<div class="col-md-1"></div>' ;
			}
		?>
	</div>
	<p></p>
	<div class="row">
		<div class="col-md-1"></div>
		<?php
			for($i = 5 ; $i < count($datesPeriode) ; $i++){
				echo '<div class="col-md-1">' ;
				echo '<button type="button" id="' . $datesPeriode[$i] . '" ';
				if (joursFeries($datesPeriode[$i])) {
						echo 'disabled="disabled" ' ;
				}
				elseif($solde >= $tarifRepas && in_array($datesPeriode[$i],$datesResa) == TRUE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
				}
				elseif($solde >= $tarifRepas && in_array($datesPeriode[$i],$datesResa) == FALSE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"annulée\")' " ;
				}
				elseif($solde < $tarifRepas && in_array($datesPeriode[$i],$datesResa) == TRUE){
					echo "onClick='modifierResa(\"" . $datesPeriode[$i] . "\",\"enregistrée\")' " ;
				}
				else {
					echo 'disabled="disabled" ' ;
				}
				$classeBouton = "btn " ;
				if(in_array($datesPeriode[$i],$datesResa) == TRUE){
					$classeBouton .= "btn-success" ;
				}
				else {
					$classeBouton .= "btn-default" ;
				}
				echo 'class="' . $classeBouton . '"> ' . convertirDateENversFR($datesPeriode[$i]) . '</button>' ;
				echo '</div>' ;
				echo '<div class="col-md-1"></div>' ;
			}
		?>
	</div>
	
	<p></p>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
		<?php
			if($solde < $tarifRepas){
				echo '<p class="alert alert-danger" role="alert">Le solde de votre carte de restauration est insuffisant pour effectuer une réservation.</p>' ;
			}
			if(isset($etatModificationMDP) && $etatModificationMDP == 1){
				echo '<p class="alert alert-success" role="alert">Mot de passe modifié.</p>' ;
				unset($_SESSION["modifMDP"]);
			}
			if(isset($_SESSION["modifMDP"])) {
				echo '<p class="alert alert-danger" role="alert">Modification du mdp annulé</p>' ;
				unset($_SESSION["modifMDP"]);
			}
			if(isset($messageReservation)){
				echo '<p class="alert alert-success" role="alert">' . $messageReservation . '</p>' ;
			}
		?>
		</div>
		
	</div>
	
	<form id="choixDate" action="index.php" method="POST">
		<input type="hidden" name="action" value="modifierReservation"/>
		<input type="hidden" id="dateResa" name="dateResa" value=""/>
		<input type="hidden" id="etatResa" name="etatResa" value=""/>
	</form>
	
</div>

<?php
	require_once("vues/vuePied.php") ;
?>
