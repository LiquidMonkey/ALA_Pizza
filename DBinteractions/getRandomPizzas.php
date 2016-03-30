<?php 
	if(defined('__ROOT__') == false){
		define('__ROOT__', dirname(dirname(__FILE__)));
	}
	include_once(__ROOT__.'/phpDB/DBcon.php');

	//array for chosing randomly
	$choices = array();
	//full query
	$query =
	"
		SELECT `naam`
		FROM `producten`;
	";
	//preparing the query
	$preparedQuery = $db->prepare($query);
	//executing on given query
	$preparedQuery->execute();
	//preparing output variable
	while ($row = $preparedQuery->fetch(PDO::FETCH_ASSOC)) {
		//add name of product to the choices array
		array_push($choices, $row{'naam'});
	}

	//generate random number and echo the value at that place in the array
	//print_r($choices);
	shuffle($choices);
	//print_r($choices);
	for ($i = 0; $i < 4 && $i < count($choices); $i++) {
		echo '<div class="column column-3 featuredProduct"><a href="#addToCart"><span class="productName">'. $choices[$i] .'</span></a></div>';
	}
?>