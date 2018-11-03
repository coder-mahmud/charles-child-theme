jQuery(document).ready(function($){

				    var containerEl = document.querySelector('.mix_container');
				    var mixer = mixitup(containerEl);



	//var slider = $('.bxslider').bxSlider();
/*
		var sliderCount = 1;
	    $('.modal-body').each(function () {
	    	

			$('#exampleModal-'+ sliderCount).on('shown.bs.modal', function (e) {
				
				
				$('.bxslider-'+ sliderCount).bxSlider();
				


			});
			console.log(sliderCount);
			sliderCount++;
			
			
	        
	        
	    });



/*
	    	

			$('#exampleModal-1').on('shown.bs.modal', function (e) {
				
				
				$('.bxslider-1').bxSlider();

			});


	    	

			$('#exampleModal-2').on('shown.bs.modal', function (e) {
				
				
				$('.bxslider-2').bxSlider();

			});


*/








/*

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
	
	

	//Magnific popup
	$('.image-popup-fit-width').magnificPopup({
		  type: 'image',
		  mainClass: 'mfp-with-zoom', // this class is for CSS animation below

		  zoom: {
		    enabled: true, // By default it's false, so don't forget to enable it

		    duration: 300, // duration of the effect, in milliseconds
		    easing: 'ease-in-out', // CSS transition easing function

		    // The "opener" function should return the element from which popup will be zoomed in
		    // and to which popup will be scaled down
		    // By defailt it looks for an image tag:
		    opener: function(openerElement) {
		      // openerElement is the element on which popup was initialized, in this case its <a> tag
		      // you don't need to add "opener" option if this code matches your needs, it's defailt one.
		      return openerElement.is('img') ? openerElement : openerElement.find('img');
		    }
		  }
	});

*/
	
	console.log('working');



	
})
