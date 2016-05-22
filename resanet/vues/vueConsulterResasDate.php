
<?php
	require_once("vues/vueEntete.php") ;
	require_once("vues/vueEnteteGestionnaire.php") ;
?>

<script>
	
	function estAnneeBissextile(annee){
		var bissextile = false ;
		if( (annee % 400 == 0) || (annee % 4 == 0 && annee % 100 != 0) ) {
			bissextile = true ;
		}
		return bissextile ;
	}
	
	function estDateValide(jour,mois,annee){
		var ok = false ;
		
		if(jour >= 1 && jour <= 31 && mois >= 1 && mois <= 12){
		
			switch( mois ){
				case 2 :
					if( estAnneeBissextile(annee) && jour >= 1 && jour <= 29){
						ok = true ;
					}
					else {
						if(!estAnneeBissextile(annee) && jour >= 1 && jour <= 28){
							ok = true ;
						}
					}
					
					break ;
				
				case 4 :
				case 6 :
				case 9 :
				case 11 :
					if(jour <= 30){
						ok = true ;
					}
					break ;
				
				default :
					if(jour <= 31){
						ok = true ;
					}
			}
		}
		
		
		return ok ;
	}

	function validateForm() {
		var date = document.getElementById("dateResa").value ;
		var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/ ;
		var test = regex.test(date) ;
		
		
		
		if(test == false) {
			alert("Veuillez entrer une date au format jj/mm/aaaa") ;
			return false ;
		}
				
		var liste = date.split("/") ;
			
		if(estDateValide(liste[0],liste[1],liste[2]) == false) {
			alert("Veuillez entrer une date valide") ;
			return false ;
		}	
			
				
				
				
		
	}







</script>

<form id="resasDate" action="index.php" onsubmit="return validateForm()" method="POST">
<!--<form id="resasDate" action="index.php" method="POST">-->
		<input type="hidden" name="action" value="resasDate"/>
		<input type="text" name="dateResas" id="dateResa" required/>
		<input type="submit"/>
		
</form>

<?php
	require_once("vues/vuePied.php") ;
?>
