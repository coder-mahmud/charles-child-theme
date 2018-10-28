jQuery(document).ready(function($){


    var containerEl = document.querySelector('.mix_container');
    var mixer = mixitup(containerEl);

    var $details_container = $('.details_container');
    $('.see_more_part').click(function(){
    	//mySlider.reloadSlider(config);

    	$(this).parent().find('.details_content').show('fast');
    	$('.slider').bxSlider();
    })
	
	$('.hide_this').click(function(){
		$(this).parent().hide('slow');
	})

	
//$('.slider').bxSlider();
	
	console.log('working');



	
})
