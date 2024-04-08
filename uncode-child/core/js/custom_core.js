

jQuery(document).ready(function($) {

		$('.menu-primary.style-light-override').removeClass('style-light-override').addClass('style-dark-override');
		
		// $('.logo-light').removeClass('logo-light').addClass('logo-dark');

		// $('.logo-light img').attr('src', 'https://deco.pt/dev/wp-content/uploads/2020/06/Logo-site-Menu-Brc.png');
		// $('header').change(function(event) {
		// 	$('.is_stuck .logo-light img').attr('src', 'https://deco.pt/dev/wp-content/uploads/2020/06/2020-05-05-Logo-Deco-01.png');
		// });


	// var shrinkMenu = function( index, nextIndex ){
	// 	if ( $('body').hasClass('vmenu') || !$('body').hasClass('uncode-fp-menu-shrink') )
	// 		return false;

	// 	if ( index === 1 && nextIndex > 1 ) {
	// 		$logo.addClass('shrinked');
	// 		$('div', $logo).each(function(index, val){
	// 			$(val).css({
	// 				'height': logoMinScale,
	// 				'line-height': logoMinScale
	// 			});
	// 			if ($(val).hasClass('text-logo')) {
	// 				$(val).css({
	// 					'font-size': logoMinScale + 'px'
	// 				});
	// 			}
	// 		});
	// 		requestTimeout(function() {
	// 			UNCODE.menuMobileHeight = $masthead.outerHeight();
	// 		}, 300);
	// 	} else if ( index !== 1 && nextIndex === 1 ) {
	// 		$logo.removeClass('shrinked');
	// 		$('div', $logo).each(function(index, val){
	// 			$(val).css({
	// 				'height': logoMaxScale,
	// 				'line-height': logoMaxScale
	// 			});
	// 			if ($(val).hasClass('text-logo')) {
	// 				$(val).css({
	// 					'font-size': logoMaxScale + 'px'
	// 				});
	// 			}
	// 		});
	// 		requestTimeout(function() {
	// 			UNCODE.menuMobileHeight = $masthead.outerHeight();
	// 		}, 300);
	// 	} else {
	// 		return false;
	// 	}

	// };
		


}); 