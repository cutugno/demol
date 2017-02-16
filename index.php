<?php 

	require_once ('config.php') ;
	$page = (isset($_GET['page'])) ? $_GET['page'] : "home";
	
	$home_class=$azienda_class=$contatti_class=$servizi_class=$rottamazione_class=$ricambi_class=$soccorso_class="";
	$servizi_class=' class="dropdown"';
	
	switch ($page) {
		case "home":
			$home_class=' class="active"';
			break;
		
		case "azienda":
			$azienda_class=' class="active"';
			break;
			
		case "rottamazione":
			$servizi_class=' class="dropdown active"';
			$rottamazione_class=' class="active"';
			break;
		
		case "ricambi-usati":	
			$servizi_class=' class="dropdown active"';
			break;
		
		case "soccorso-stradale":
			$servizi_class=' class="dropdown active"';
			$soccorso_class=' class="active"';
			break;
			
		case "ricambi-online":
			$ricambi_class=' class="active"';
			break;
			
		case "contatti":
			$contatti_class=' class="active"';
			break;
		
		default:
			$page="404";
			break;
			
	}


?>

		<?php include 'html/common/open.html' ?>
		<?php include 'html/common/topbar.html' ?>
        <?php include 'html/common/navbar.html' ?>
        <?php include 'html/'.$page.'.html' ?>
        <?php include 'html/common/footer.html' ?>
        <?php include 'html/common/scripts.html' ?>
        <?php 
			if ($page=="contatti") {
				include 'html/common/gmaps.html';
				include 'html/scripts/contatti.js';
			}
			if ($page=="ricambi-online") {
				include 'html/scripts/ricambi-online.js';
			}
		?>
        <?php include 'html/common/close.html' ?>
