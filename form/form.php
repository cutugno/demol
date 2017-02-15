<?php	
	
	require_once ("include/DB.class.php");

	/*
	define('DB_HOST', "62.149.150.249"); 
	define('DB_NAME', "Sql921165_1");
    define('DB_PORT', "3306"); 
    define('DB_USER', "Sql921165"); 
    define('DB_PASS', "z8ye1dkwnt");
    */
    
    define('DB_HOST', "localhost"); 
	define('DB_NAME', "auto");
    define('DB_PORT', "3306"); 
    define('DB_USER', "root"); 
    define('DB_PASS', "Aleare26"); 
    $DB = DB::Open();
    
    isset($_GET['s']) ? $s=$_GET['s'] : exit(); 
    switch ($s) {
		case "maker":
			$q="select maker from auto group by maker order by maker";
			break;
		case "model":
			$maker=$_GET['maker'];
			$q="select model from auto where maker='$maker' group by model order by model";
			break;
		case "anno": // anni di produzione
			$maker=$_GET['maker'];
			$model=$_GET['model'];
			$q="select prod_years_start, prod_years_end from auto where maker='$maker' and model='$model'";
			break;
	}
	
	$result=$DB->qry($q);
	$arr=array();
	while ($results=$result->fetch_array(MYSQLI_ASSOC)){
		$arr[]=$results;
	}
	$output=array("risultato"=>$arr);
	echo json_encode($output);
	
    
    
?>
