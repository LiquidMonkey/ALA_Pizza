<?php
	include_once './includes/header.php';
?>

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

<?php
	include_once './includes/footer.php';
?>