$(document).ready(function() {
	//makes every element not draggable
	$("*").attr('draggable', 'false');

	//gives a delay before the button starts animating this is done because of loading times
	setTimeout(animateBorder, 900 );

	//gives the sorting function to the on change event of the checkboxses in the menu that are used for sorting the available products
	$(".sortingType input[type=checkbox]").on('change', sorting);

	//gives the add button on the menu page the function addToBestelling when the click event is fired
	$(".orderAddButton").click(addToBestelling);

	//the big round button in the navigation clicks on the betaal button (on the menu page only) when click event is fired. this way the button acts the exact same as the order button no matter what changes to the order button
	$(".redirector").click(function(){
		$("#betaal").click();
	});

	$('.bigbutton').click(function(){
		$(this).parent().click();
	});

	$(".hideAfterPress").click(function(){
		$(this).addClass('hidden');
		$('.dontHide').removeClass('hidden');
	});

	/*makes it so all the featured products get their respective backgrounds. can not be done in css (at least to my knowledge) because the featured products are added via php and therefor i didnt find a better way to do this
	i do know i could've given all the products classes but because there is not a specified amount of products i couldnt make a switch because this would mean someone would have to dig in the code
	Now however all they have to do is with every new product they upload an image to the correct folder (media/products/) and everything will work*/
	putBackgrounds();
	//animateFeatured();
});

/*Not used anymore instead look in css for the flex options
function animateFeatured(){
	$(".featuredProduct").on('mouseenter', function(event) {
		$(this).finish().addClass('selected').animate({width:'23.8%', width:'65%'}, {duration: 300, start: function(){
			$(".featuredProduct").not($(this)).finish().animate({width:'23.8%', width:'10%'}, 200).find('.productName').addClass('notSelected');;
		}});
	}).on('mouseleave', function(event) {
		$(this).finish().removeClass('selected').animate({width:'65%', width:'23.8%'}, {duration: 200, start: function(){
			$(".featuredProduct").not($(this)).finish().animate({width:'10%', width:'23.8%'}, 300).find('.productName').removeClass('notSelected');
		}});
	});
}	*/

//array for bestelling will contain all the ordered products
var bestelling = [];
//This function gets all the information needed to put the selected product in the bestel lijst.
function addToBestelling(){
	var bestelItem = [];
	var product = $(this).closest('.productInformation').children().eq(0).children('.productName').text();
	var aantal = parseInt($(this).closest('.orderInteraction ').find('.amount').val());
	var prijs = parseFloat($(this).closest('.orderInteraction ').find('.prijs').text().split("€")[1]) * aantal;
	var soort = $(this).closest('.orderInteraction ').find('.soort').val();
	prijs = +prijs;
	//reset amount counter
	$(this).prev().val(1);

	var dupe = false;
	if(bestelling.length > 0){
		for(var i = 0; i < bestelling.length; i++){
			if( product == bestelling[i][0] && soort == bestelling[i][3]){
				bestelling[i][1] += aantal;
				bestelling[i][2] = Math.round( (prijs * bestelling[i][1] + 0.00001) * 100) / 100;
				dupe = true;
			}
		}
		if(dupe == false){
			bestelItem = [product, aantal, prijs, soort];
			bestelling.push(bestelItem);
		}
	} else {
		bestelItem = [product, aantal, prijs, soort];
		bestelling.push(bestelItem);
	}

	conjureBestelLijst(bestelling);
	//activates the buttons that allow the user to order the selected products is not visible when there are no products
	$('.bestelButton, .bestelButtonDiv').removeClass('hidden');
}

//makes the bestellijst. meaning it puts the selected products in the bestel lijst on the left of the menu page
function conjureBestelLijst(lijst){
	$('#bestelling').html('');
	var i = 0;
	//bestelitem[0 => naam, 1 => aantal, 2 => prijs, 3 => soort]
	lijst.forEach(function (bestelItem){
		var newItem = '<li class="bestelItem row"><input class="column column-6" name="soort" type="text" disabled value="'+bestelItem[3]+'"><input type="text" disabled name="naam" class="column column-6" value="'+bestelItem[0]+'"><input name="prijs" disabled class="column column-6" value="'+bestelItem[2]+'"><input name="aantal" type="number" class="amount column column-6" disabled value="'+bestelItem[1]+'"/></li>';
		$('#bestelling').append(newItem);
		i++;
	});
}

//does everything that is needed for the pay button
function betaal(){
	bakery();
	window.location.replace("betaal.php");
}

//bakes the cookies
function bakery(){
	var cookieValue = [];
	$(bestelling).each(function(index){
		var item = bestelling[index];
		/*cookiestring (cookieValue)
			every element is devided by a . 
			every part is devided by a , and 
			every name(key) and value  is devided by :
		*/
		cookieValue.push(item[0]+"/"+item[2]+"/"+item[1]+"/"+item[3]);
	});
	
	document.cookie = cookieValue;
}

//makes sure the animation only starts its interval once
var animate = true;
function animateBorder(){
	if(animate == true){
		setInterval(animateBorder, 1000);
		animate = false;
	}

	//makes border go from 3 to 8 pixels and back to animate the #bestel button
	var obj = $('#bestel > a');
	if(obj.css('borderWidth') == '3px'){
		obj.animate({'borderWidth' : '8px'}, 500, 'linear');
	} else {
		obj.animate({'borderWidth' : '3px'}, 500, 'linear');
	}
}

//handels the sorting in the menu page with the checkboxes
function sorting(){
	$(this).closest('.sortingType').children('input');
	if( $(this).is(":checked") ){
		switch( $(this).val() ){
			case 'pizza':
				$('.menuList .menuItem[categorie=pizza]').removeClass('hidden');
				break;
			case 'specials':
				$('.menuList .menuItem[categorie=specials]').removeClass('hidden');
				break;
			case 'dranken':
				$('.menuList .menuItem[categorie=dranken]').removeClass('hidden');
				break;
		}
	} else {
		switch( $(this).val() ){
			case 'pizza':
				$('.menuList .menuItem[categorie=pizza]').addClass('hidden');
				break;
			case 'specials':
				$('.menuList .menuItem[categorie=specials]').addClass('hidden');
				break;
			case 'dranken':
				$('.menuList .menuItem[categorie=dranken]').addClass('hidden');
				break;
		}
	}
}

function bestellingPlaatsen(){
	var bestelling = $("#bestelling .bestelItem");
	//alert( JSON.stringify(bestelling, null, 2) );
	var rekening = maakRekening(bestelling);
	var bestellerInformatie;
	//verzend email (bestelling(array), bestellerInformatie(array[key=>gegevens] zoals naam plaats enz. (of haalt uit database op)))
	emailVerzenden(bestellijst, bestellerInformatie);
}

//moet emails verzenden naar de besteller en de dichtsbijzijne locatie
function emailVerzenden(bestelling, besteller){

}

//gives the featured boxes their backgrounds depending on the name of that product THEREFOR EVERY IMAGE SHOULD BE THE SAME FORMAT (PNG)
function putBackgrounds(){
	var prodList = $(".featuredProduct");
	for (var i = 0; i < prodList.length; i++) {
		$(".featuredProduct").eq(i).css('background','url("./media/products/'+ $(".featuredProduct").eq(i).text() +'.png") center center no-repeat').css('backgroundSize', 'cover');
	};
}