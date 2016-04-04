<?php
	include_once './includes/header.php';
?>

			<div id="content" class="row">
				<div class="column column-4">
					<h2>Nieuwe Pizza's</h2>
					<ul class="prodList">
					<?php
						//Add products to this list from database only products with column new where niew = 'true'
						include_once './DBinteractions/getAllNewPizzas.php';
					?>
					</ul>
				</div>
				<div class="column column-8">
					<div class="column column-6">
						<h2>Aanbiedingen</h2>
						<ul class="prodList">
							<?php
								//add products from database where sale = 'true'
								include_once './DBinteractions/getAllSales.php';
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="filler"></div>

<?php
	include_once './includes/footer.php';
?>