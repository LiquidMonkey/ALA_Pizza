$(document).ready(function() {
	$("*").attr('draggable', 'false');

	setTimeout(animateBorder, 900 );

	$(".sortingType input[type=checkbox]").on('change', sorting );
});

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
				$('.prodList li[categorie=pizza]').removeClass('hidden');
				break;
			case 'specials':
				$('.prodList li[categorie=specials]').removeClass('hidden');
				break;
			case 'dranken':
				$('.prodList li[categorie=dranken]').removeClass('hidden');
				break;
		}
	} else {
		switch( $(this).val() ){
			case 'pizza':
				$('.prodList li[categorie=pizza]').addClass('hidden');
				break;
			case 'specials':
				$('.prodList li[categorie=specials]').addClass('hidden');
				break;
			case 'dranken':
				$('.prodList li[categorie=dranken]').addClass('hidden');
				break;
		}
	}
}