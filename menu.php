<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="Site van pizzaria sopranos bestel heerlijke verse pizza's">
		<meta name="keywords" content="pizza, bestellen, online, eten, vers, sopranos, pizzaria">
		<meta name="author" content="Yannick Pot">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1"/>

		<title>Pizza Sopranos</title>
		<link href="./media/pizzaLogo.jpg" rel="shortcut icon" type="image/jpg">

		<link href="./css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="./css/grid.css" rel="stylesheet" type="text/css" />
		<link href="./css/main.css" rel="stylesheet" type="text/css" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="./js/main.js" type="text/javascript" charset="utf-8" async defer></script>
		<script>
			$(window).ready(function(){
				//hides the bestelbuttons that allow the user to order products this is only relevant in the menu page
				$(".bestelButton").addClass('hidden');				
			});	
		</script>
	</head>
	<body>
		<nav>
			<div class="header">
				<div class="logo">
					<a href="index.php">
						<div id="logoImg">
						</div>
						<div id="logoText">
							Pizza Sopranos
						</div>
					</a>
				</div>
				<div id="bestel">
					<a href="#" class="bestelButton redirector">Bestel</a>
				</div>
				<ul id="rightNav" class="vCenter">
					<li><a href="menu.php">Menu</a></li>
					<li><a href="aanbiedingen.php">Aanbiedingen</a></li>
				</ul>
			</div>
		</nav>
		<section class="container">
			<div id="bigBanner" class="row">
				<div class="column column-7">
					<img class="item" src="media/banner3.png" alt="Heerlijke pizza"/>
				</div>
				<!-- Holds 4 random featured products-->
				<div class="column column-5 specials">
					<?php
						//add 4 random products from database these are recomended/featured pizza's
						include_once('./DBinteractions/getRandomPizzas.php');
					?>
				</div>
			</div>
			<div id="content" class="row">
				<div class="column column-4">
					<h5>Bestelling</h5>
					<ul id="bestelling">
						<!--Gets filled via javascript-->
					</ul>
					<div class="bestelButtonDiv hidden">
						<input type="button" id="betaal" class="bestelButton" name="betaal" value="Betaal" onclick="betaal();">
					</div>
				</div>
				<div class="column column-8">
					<h5>Menu</h5>
					<div class="sorting">
						<div class="sortingType">
							<input type="checkbox" checked id="pizzaOnly" value="pizza">
							<label for="pizzaOnly"><span></span>Pizza</label>
						</div>
						<div class="sortingType">
							<input type="checkbox" checked id="specialsOnly" value="specials">
							<label for="specialsOnly"><span></span>Specials</label>
						</div>
						<div class="sortingType">
							<input type="checkbox" checked id="drankenOnly" value="dranken">
							<label for="drankenOnly"><span></span>Dranken</label>
						</div>
					</div>
					<div class="menuList">
						<?php
							include_once('./DBinteractions/fillMenu.php');
						?>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<span>Lekker hè<span class="nonBold">&#8482;</span> Yannick Pot<span class="nonBold">&copy;</span></span>
		</footer>
	</body>
</html>