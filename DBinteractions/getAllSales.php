<?php
	if(defined('__ROOT__') == false){
		define('__ROOT__', dirname(dirname(__FILE__)));
	}
	include_once(__ROOT__.'/phpDB/DBcon.php');

	//full query
	$query = "SELECT `naam` FROM `producten`";
	//preparing the query
	$preparedQuery = $db->prepare($query);
	//executing on given query
	$preparedQuery->execute();
	//preparing output variable
	while ($row = $preparedQuery->fetch(PDO::FETCH_ASSOC)) {
		//add name of product to the choices array
		echo '<li><a href="#addToCart"><span class="tinyProductPicture"></span><span class="productName">'. $row{'naam'} .'</span></a></li>';
	}
?>