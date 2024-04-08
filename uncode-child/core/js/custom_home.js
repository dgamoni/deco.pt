

jQuery(document).ready(function($) {

			const mySwiper = new Swiper('.swiper-container', {
			    slidesPerView: 1,

			    // grid: {
			    //     rows: 2,
			    //   },
			    //slidesPerColumn: 3,
			    //slidesPerGroup :3,
			    //spaceBetween: 30,
			    pagination: {
			      el: '.swiper-pagination',
			      clickable: true,
			    },
			    // on: {
			    //   init: function () {},
			    //   orientationchange: function(){},
			    //   beforeResize: function(){
			    //     let vw = window.innerWidth;
			    //     if(vw > 1000){
			    //       mySwiper.params.slidesPerView = 3
			    //         mySwiper.params.slidesPerColumn = 3
			    //         mySwiper.params.slidesPerGroup = 3;
			    //     } else {
			    //       mySwiper.params.slidesPerView = 4
			    //         mySwiper.params.slidesPerColumn = 2
			    //         mySwiper.params.slidesPerGroup =4;
			    //     }
			    //     mySwiper.init();
			    //   },
			    // },
			});


        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
        
});


