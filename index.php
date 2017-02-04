<?php 

	require_once ('config.php') ;
	$page = (isset($_GET['page'])) ? $_GET['page'] : "home";
	
	$home_class=$azienda_class=$contatti_class="";
	$servizi_class=' class="dropdown"';
	
	switch ($page) {
		case "home":
			$home_class=' class="active"';
			break;
		
		case "azienda":
			$azienda_class=' class="active"';
			break;
			
		case "rottamazione":
		case "ricambi-usati":
		case "soccorso-stradale":
			$servizi_class=' class="dropdown active"';
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
        <?php include 'html/common/close.html' ?>
