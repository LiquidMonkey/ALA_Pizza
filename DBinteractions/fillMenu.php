<?php
	if(defined('__ROOT__') == false){
		define('__ROOT__', dirname(dirname(__FILE__)));
	}
	include_once(__ROOT__.'/phpDB/DBcon.php');

	//full query
	$query = "SELECT `producten`.`naam`, `producten`.`ingredienten`, `producten`.`prijs`, `categorie`.`naam` AS 'categorieNaam' FROM `producten` LEFT JOIN `categorie` ON `producten`.`categorie` = `categorie`.`categorie_ID`";
	//preparing the query
	$preparedQuery = $db->prepare($query);
	//executing on given query
	$preparedQuery->execute();
	//preparing output variable
	while ($row = $preparedQuery->fetch(PDO::FETCH_ASSOC)) {
		$ingredienten = $row{'ingredienten'};
		if ($ingredienten == 0 || $ingredienten == null || $ingredienten == '' || $ingredienten == '0'){
			$ingredienten = '';
		}
		//add name of product to the choices array
		$string = '<div categorie="'. $row{'categorieNaam'} .'" class="row menuItem">'."\n\t".'<div class="column column-2 contain">'."\n\t\t".'<img src="./media/products/'. $row{'naam'} .'.png"/>'."\n\t".'</div>'."\n\t".'<div class="productInformation column column-10">'."\n\t\t".'<div class=" column column-6">'."\n\t\t\t".'<div class="productName column column-12">'. $row{'naam'} .'</div>'."\n\t\t\t".'<div class="productIngriedients column column-12">'."\n\t\t\t\t".'<p>'. $ingredienten .'</p>'."\n\t\t\t".'</div>'."\n\t\t".'</div>'."\n\t\t".'<div class="orderInteraction column column-6"><span class="prijs">&euro; '.$row{'prijs'}.'</span>';

		if($row{'categorieNaam'} == 'pizza'){
			$string2 = "\n\t\t\t".'<select name="soort" class="soort"><option value="medium">medium</option><option value="large">large</option><option value="calzone">calzone</option></select>'."\n\t\t\t".'<input type="number" name="amount" value="1" max="100" min="1" class="amount"/>'."\n\t\t\t".'<input type="submit" value="Add to cart" class="orderAddButton"/>'."\n\t\t".'</div>'."\n\t\t".'</div>'."\n\t".'</div>'."\n\n";
		}else{
			$string2 = "\n\t\t\t".'<input type="number" name="amount" value="1" max="100" min="1" class="amount"/>'."\n\t\t\t".'<input type="submit" value="Add to cart" class="orderAddButton"/>'."\n\t\t".'</div>'."\n\t\t".'</div>'."\n\t".'</div>'."\n\n";
		}
		echo $string . $string2;
	}
?>