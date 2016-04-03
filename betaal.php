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
			<div class="hidden">
				<a href="#" id="bestel" class="bestelButton">Bestel</a>
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
			<div id="betaal" class="row">
				<script type="text/javascript">
					var prijslijst = [];
					var totaal = 0;

					var medium = 0;
					var korting;
					var kortingDeci;

					var cookie = document.cookie;
					var items = cookie.split(',');

					document.writeln("<article class='row'><div class='center column column-9'>");
					for (var i = 0; i < items.length; i++) {
						var information = items[i].split('/');
						document.writeln("<div class'column column-12'><div class='column column-6'><input type='text' value='"+information[0]+"' disabled></div><div class='column column-3'><input type='text' value='x"+information[2]+"' disabled></div><div class='column column-3'><input type='text' value='= "+information[1]+"' disabled></div></div>");

						totaal += parseFloat(information[1]);
							//prijslijst.push("<div class='column column-12'><input type='text' class='right' value='"+information[1]+"' disabled></div>");
							if(information[3] == "medium" || (information[3] == "medium" && parseInt(information[2]) <= 2)){
								medium++;
								if(medium == 2){
									korting = "50%";
									kortingDeci = (parseInt(korting)/100);
								}
							}
						};
						for (var i = 0; i < prijslijst.length; i++){
							document.writeln('<div></div>'.prijslijst[i]);
						}
						document.writeln("<hr class='column column-12'/>");
						document.writeln("<div class='center'><span class='column column-6 textRight'>Totaal:</span><span class='column column-6'>"+totaal+"</span></div>");
						if(korting == "" || korting == null || korting == undefined){
							document.writeln("<div class='center column column-12'><span class='column column-6 textRight'>Korting:</span><span class='column column-6'> "+"0%"+"</span></div>");
							document.writeln("<hr class='column column-12'/><div class='center'><span class='column column-6 textRight'>Eind prijs:</span> <span class='column column-6'>"+totaal+"</span></div>");
						}else{
							document.writeln("<div class='center'><span class='column column-6 textRight'>Korting:</span><span class='column column-6'> "+korting+"</span></div><div class='center'><span class='column column-6 textRight'>Korting berekend:</span><span class='column column-6'>"+Math.round(totaal*(1-kortingDeci) *100)/100+"</span></div>");
							document.writeln("<hr class='column column-12'/><div class='center'><span class='column column-6 textRight'>Eind prijs:</span> <span class='column column-6'>"+Math.round(totaal*(1-kortingDeci) *100)/100+"</span></div>");
						}

						document.writeln("</div></article>");//closes the column-3 from before the prijslijst write
					</script>
					<form action="" method="post"> 
						<div class="bestelButtonDiv">
							<?php
							if( IsSet($_POST['submit']) ){
								echo "";
							} else {
								echo '<input type="submit" name="submit" value="Verder" class="bestelButton">';
							}
							?>
							
						</div>
					</form>
					<?php 
					if(IsSet($_POST['submit'])){
						?> 
						<form name="gegevens" action="betaalStap2.php" method="post">
							<div class="column column-12 inputGroup">
								<span class="column column-3">Naam Verzender:</span>
								<div class="column column-9">
									<input type="text" name="van_naam">
								</div>
							</div>

							<div class="column column-12 inputGroup">
								<span class="column column-3">Email: </span>
								<div class="column column-9">
									<input type="email" name="van_emailadres">
								</div>
							</div>

							<div class="column column-12 inputGroup">
								<span class="column column-3">Woonplaats: </span>
								<div class="column column-9">
									<select name="woonplaats">
										<option selected disabled hidden style='display: none;' value=''>Kies dichtsbijzijnde</option>
										<option value="zoetermeer">Zoetermeer</option>
										<option value="amsterdam">Amsterdam</option>
										<option value="denhaag">Den Haag</option>
									</select>
								</div>
							</div>

							<div class="column column-12 inputGroup">
								<span class="column column-3">straat: </span>
								<div class="column column-5">
									<input type="text" name="straat"> 
								</div>
								<span class="column column-2">nummer:</span>
								<div class="column column-2">
									<input type="number" name="streetNumb" min="0">
								</div>
							</div>

							<div class="column column-12 inputGroup">
								<span class="column column-3">telNummer: </span>
								<div class="column column-9">
									<input type="text" name="telNummer">
								</div>
							</div>

							<div class="bestelButtonDiv">
							<input type="submit" name="betaal" value="Betaal" class="dontHide bestelButton">
							</div>
						</form> 
						<?php 
					}
					?>
				</div>
			</div>
		</section>
		<footer>
			<span>Lekker hè<span class="nonBold">&#8482;</span> Yannick Pot<span class="nonBold">&copy;</span></span>
		</footer>
	</body>
	</html>