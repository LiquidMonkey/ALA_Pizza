<?php
	include_once './includes/header.php';
?>

		<?php
		if (IsSet($_POST['woonplaats']) && IsSet($_POST['betaal']) && !IsSet($_POST['betaald'])) { 
			$naam_ontvanger = 'Pizza Sopranos'; 
			$email_ontvanger = 'pizzasopranos'; 

			$naam_verzender = $_POST['van_naam']; 
			$email_verzender = $_POST['van_emailadres'];

			$woonplaats = $_POST['woonplaats'];
			$straat = $_POST['straat'];
			$straatnum = $_POST['streetNumb'];

			$telNummer = $_POST['telNummer'];

			$onderwerp = 'Bestelling Pizza Sopranos'; 

			$headers = "From: ".$naam_verzender." <".$email_verzender."> \r\n";
			$headers .= "CC: pizzasopranoshoofd@gishhub.web44.net\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

			$bericht = " 
			Beste ".$naam_ontvanger.", 

			Uw bestelling wordt verzonden naar het volgende adres: ".$woonplaats.", ".$straat.$straatnum."

			<html><body>
			<img src='//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png' alt='Website Change Request' />
			mvg, 
			<strong>Pizza Sopranos</strong>
			</body></html>";
			
			switch($woonplaats){
				case 'zoetermeer':
					$email_ontvanger.urlencode("zoetermeer");
					break;
				case 'amsterdam':
					$email_ontvanger.urlencode("amsterdam");
					break;
				case 'denhaag':
					$email_ontvanger.urlencode("denhaag");
					break;
				default:
					$email_ontvanger.urlencode('hoofd');
			}
			$tail = urlencode('@gishhub.web44.net');

			$email_ontvanger . $tail;

			mail($email_ontvanger, $onderwerp, $bericht, $headers);

			echo '<div class="row">
					<form action="" method="POST">
						<div class="column column-12">
							<div class="column-6 center float bigbuttonContainer">
								<a target="_blank" href="http://www.iDeal.nl/Pay"><input class="bigbutton ideal" type="submit" name="betaald" value="iDeal"></a>
							</div>
							<div class="column-6 center float bigbuttonContainer">
								<a target="_blank" href="http://www.PayPal.nl/Pay"><input class="bigbutton paypal" type="submit" name="betaald" value="PayPal"></a>
							</div>
						</div>
					</div>
				</form>';
		} else 	if (IsSet($_POST['betaald'])) {
			echo '<div class="row"><div class="column column-12"><p>U heeft betaald Hartelijk dank voor het bestellen bij Pizza Sopranos, uw bestelling zal zo spoedig mogelijk geleverd worden reken op zo\'n 30 tot 90 minuten.</p> <h1>Eet smakelijk</h1></div></div>';
		} else {
			echo '<h3>U heeft geen producten aan uw bestelling toegevoegt, ga terug naar menu en kies daar de producten die u wilt bestellen volg daarna de aanweizingen op het scherm</h3>';
		}


		?>

<?php
	include_once './includes/footer.php';
?>