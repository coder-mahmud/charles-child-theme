jQuery(document).ready(function($){

    var containerEl = document.querySelector('.mix_container');
    var mixer = mixitup(containerEl);

    var $details_container = $('.details_container');
    $('.see_more_part').click(function(){
    	//mySlider.reloadSlider(config);

    	$(this).parent().find('.details_content').addClass('show');
    	//$('.slider').bxSlider();
    })
	
	$('.hide_this').click(function(){
		$(this).parent().removeClass('show');
	})

	$('.slider').bxSlider();
	
	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
			}
		}
	});







	
	console.log('working');



	
})
