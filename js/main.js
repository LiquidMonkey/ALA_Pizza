$(document).ready(function() {
	$("*").attr('draggable', 'false');

	setTimeout(animateBorder, 900 );

	$(".sortingType input[type=checkbox]").on('change', sorting);

	$(".orderAddButton").click(addToBestelling);

	$(".bestelButton").addClass('hidden');

	$(".redirector").click(function(){
		$("#betaal").click();
	});

	putBackgrounds();
	//animateFeatured();
});

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
}	

//array for bestelling
var bestelling = [];

function addToBestelling(){
	var bestelItem = [];
	var product = $(this).closest('.productInformation').children().eq(0).children('.productName').text();
	var aantal = parseInt($(this).prev().val());
	var prijs = parseFloat($(this).prev().prev().prev().text().split("€")[1]) * aantal;
	var soort = $(this).prev().prev().val();
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
	$('.bestelButton, .bestelButtonDiv').removeClass('hidden');
}

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

function betaal(){
	setCookie();
	window.location.replace("betaal.php");
}

function setCookie(){
	var cookieValue = [];
	$(bestelling).each(function(index){
		var item = bestelling[index];
		/*cookiestring (cookieValue)
			every element is devided by a . 
			every part is devided by a , and 
			every name(key) and value  is devided by :
		*/
		cookieValue.push(item[0]+"/"+item[2]+"/"+item[1]);
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

function putBackgrounds(){
	var prodList = $(".featuredProduct");
	for (var i = 0; i < prodList.length; i++) {
		$(".featuredProduct").eq(i).css('background','url("./media/products/'+ $(".featuredProduct").eq(i).text() +'.png") left center no-repeat').css('backgroundSize', 'cover');
	};
}