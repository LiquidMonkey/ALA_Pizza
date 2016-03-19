<?php
	if(defined('__ROOT__') == false){
		define('__ROOT__', dirname(dirname(__FILE__)));
	}
	include_once(__ROOT__.'/phpDB/DBcon.php');

	//full query
	$query = "SELECT `producten`.`naam`, `categorie`.`naam` AS 'categorieNaam' FROM `producten` LEFT JOIN `categorie` ON `producten`.`categorie` = `categorie`.`categorie_ID`";
	//preparing the query
	$preparedQuery = $db->prepare($query);
	//executing on given query
	$preparedQuery->execute();
	//preparing output variable
	while ($row = $preparedQuery->fetch(PDO::FETCH_ASSOC)) {
		//add name of product to the choices array
		echo '<div categorie="'. $row{'categorieNaam'} .'" class="row menuItem"><div class="column column-2 contain"><img src="./media/products/'. $row{'naam'} .'.png"/></div><div class="productInformation column column-10"><div class=" column column-7"><div class="productName column column-12">'. $row{'naam'} .'</div><div class="productIngriedients column column-12"><p>bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla </p></div></div> <span class="orderInteraction column column-5"><input type="number" name="amount" value="1" class="amount"/> <input type="submit" value="Add to cart" class="orderAddButton"/></span></div></div>';
	}
?>