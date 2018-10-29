jQuery(document).ready(function($){

    var containerEl = document.querySelector('.mix_container');
    var mixer = mixitup(containerEl);

    var $details_container = $('.details_container');
    $('.see_more_part').click(function(){
    	//mySlider.reloadSlider(config);

    	$(this).parent().find('.details_content').addClass('show');
    	//$('.slider').bxSlider();
    	$(this).parent().find('.see_more_part').hide();
    })
	
	$('.hide_this').click(function(){
		$(this).parent().removeClass('show');
		$(this).parent().parent().find('.see_more_part').show();
	})

	$('.slider').bxSlider();
	
	$('.image-popup-fit-width').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: false
		}
	});







	
	console.log('working');



	
})
