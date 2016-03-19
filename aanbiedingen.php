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

		<script src="https://code.jquery.com/jquery-1.12.1.min.js" integrity="sha256-I1nTg78tSrZev3kjvfdM5A5Ak/blglGzlaZANLPDl3I="   crossorigin="anonymous"></script>
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
				<div id="bestel">
					<a href="index.php">Bestel</a>
				</div>
				<ul id="rightNav" class="vCenter">
					<li><a href="menu.php">Menu</a></li>
					<li><a href="aanbiedingen.php">Aanbiedingen</a></li>
				</ul>
			</div>
		</nav>
		<section class="container">
			<div id="bigBanner">
				<div class="item">
					<img src="media/banner3.png" alt="Heerlijke pizza"/>
				</div>
			</div>
			<div id="content" class="row">
				<div class="column column-12">
					<h5>Aanbiedingen van de maand</h5>
					<div class="folderSection">
						<img src="media/folder/reclameFolderTest1.jpg" />
					</div>
				</div>
			</div>
		</section>
		<footer>
			<span>Lekker hè<span class="nonBold">&#8482;</span> Yannick Pot<span class="nonBold">&copy;</span></span>
		</footer>
	</body>
</html>