
jQuery(document).ready(function($) {

	const releatedSwiper = new Swiper('.swiper-container', {
		slidesPerView: 1,
		slidesPerGroup: 1,
		loop: true,
		spaceBetween: 30,
		breakpointsBase: 'container',
		// effect: 'fade',
		// centeredSlides: true,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			// when window width is >= 320px
			768: {
			  slidesPerView: 2,
			},
		}				    
	});

});