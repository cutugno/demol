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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>L'Autodemolizione di Roma - L'unica con la "L"</title>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/ion-icons/css/ionicons.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/construction-fonts/flaticon.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/owl-carousel/owl.transitions.css" rel="stylesheet">
        <!--master slider-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/masterslider/style/masterslider.css"/>
        <link href="<?php echo BASE_URL ?>/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
        <link rel='stylesheet' type="text/css" href="<?php echo BASE_URL ?>/dzsparallaxer/dzsparallaxer.css">
		<link href="<?php echo BASE_URL ?>/css/style.css" rel="stylesheet">
		<link href="<?php echo BASE_URL ?>/css/custom.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="preloader"></div>
        
        <?php include 'html/common/topbar.html' ?>
        <?php include 'html/common/navbar.html' ?>
        <?php include 'html/'.$page.'.html' ?>
        <?php include 'html/common/footer.html' ?>

		<!-- jQuery -->
        <script src="<?php echo BASE_URL ?>/js/jquery.min.js"></script>
        <script src="<?php echo BASE_URL ?>/js/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL ?>/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="<?php echo BASE_URL ?>/js/wow.min.js"></script><script src="dzsparallaxer/dzsparallaxer.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL ?>/js/bootstrap-hover-dropdown.min.js"></script>
        
        <script src="<?php echo BASE_URL ?>/owl-carousel/owl.carousel.min.js"></script>
        <!--sticky plugin-->
        <script src="<?php echo BASE_URL ?>/js/jquery.sticky.js"></script>
        <script src="<?php echo BASE_URL ?>/js/custom.js"></script>
        <!--page template scripts-->
        <script src="<?php echo BASE_URL ?>/masterslider/masterslider.min.js"></script> 
        <script src="<?php echo BASE_URL ?>/js/master-custom.js"></script>

        <script>
            $(document).ready(function () {
                //sticky nav
                $(".sticky").sticky({topSpacing: 0});
            });
        </script>
    </body>
</html>
