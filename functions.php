<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_add_parent_dep' ) ):
function chld_thm_cfg_add_parent_dep() {
    global $wp_styles;
    array_unshift( $wp_styles->registered[ 'ebor-style' ]->deps, 'ebor-fonts' );
}
endif;
add_action( 'wp_head', 'chld_thm_cfg_add_parent_dep', 2 );

// END ENQUEUE PARENT ACTION


// Enqueue script and styles...

function cwp_fc_scripts(){
 
  wp_enqueue_style('mixitup-style', get_stylesheet_directory_uri().'/css/style.css');
  wp_enqueue_style('bxslider-style', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css');
  wp_enqueue_style('mignify-style', get_stylesheet_directory_uri().'/css/magnific-popup.css');


  wp_enqueue_script('mixitup-script', get_stylesheet_directory_uri() .'/js/mixitup.min.js', array('jquery'),'', false);
  wp_enqueue_script('bxslider-script', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'),'', false);
  wp_enqueue_script('magnify-script', get_stylesheet_directory_uri() .'/js/jquery.magnific-popup.min.js', array('jquery'),'', true);



  wp_enqueue_script('main-script', get_stylesheet_directory_uri() .'/js/scripts.js', array(),'', true);

}

add_action('wp_enqueue_scripts','cwp_fc_scripts');

// Theme supports
add_theme_support( 'post-thumbnails', array( 'post', 'portfolio','portfolio_gallery' ) );





// New portfolio action


function portfolio_custom_post() {
  // Portfolio Post type
  register_post_type('portfolio', array(

    'supports' => array('title', 'editor','thumbnail'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Projects',
      'add_new_item' => 'Add New Portfolio',
      'edit_item' => 'Edit Portfolio',
      'all_items' => 'All Portfolios',
      'singular_name' => 'Portfolio',
      'add_new' => 'Add New Portfolio',
    ),
    'menu_icon' => 'dashicons-portfolio'
  ));
	

  register_post_type('portfolio_gallery', array(

    'supports' => array('title', 'editor','thumbnail'),
    'rewrite' => array('slug' => 'portfolio-gallery'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Portfolio Gallery',
      'add_new_item' => 'Add New Gallery',
      'edit_item' => 'Edit Gallery',
      'all_items' => 'All Gallerys',
      'singular_name' => 'Gallery',
      'add_new' => 'Add New Gallery',
    ),
    'menu_icon' => 'dashicons-format-gallery'
  ));
	

}

add_action( 'init', 'portfolio_custom_post' );

// Taxonomy Support for Portfolio

function portfolio_taxonomy() {
	register_taxonomy(
		'portfolio-cat',
		'portfolio',
		array(
			'hierarchical'          => true,
			'label'                         => 'Portfolio Category',  //Display name
			'query_var'             => true,
			'rewrite'                       => array(
				'slug'                  => 'portfolio-category', // This controls the base slug that will display before each term
				'with_front'    => true // Don't display the category base before
				),
			'show_admin_column' => TRUE
			
			)
	);
}

add_action( 'init', 'portfolio_taxonomy'); 


//Shortcode 
function portfolio_shortcodes( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'location' => '',
	), $atts ) ); ob_start(); ?>
	
		<div class="featured_properties_area ">
			<div class="container">
				<div class="row mix_container">
					
					<?php

				    $q = new WP_Query(
				        array('posts_per_page' => -1, 'post_type' => 'portfolio')
				        );        
				         
				 
				//Portfolio taxanomy query
				    global $paged;
				    global $post;
				    $args = array(    
				        'post_type' => 'portfolio',
				        'paged' => $paged,
				        'posts_per_page' => -1,
				    );
				 
				    $portfolio = new WP_Query($args);
				    if(is_array($portfolio->posts) && !empty($portfolio->posts)) {
				        foreach($portfolio->posts as $gallery_post) {
				            $post_taxs = wp_get_post_terms($gallery_post->ID, 'portfolio-cat', array("fields" => "all"));
				            if(is_array($post_taxs) && !empty($post_taxs)) {
				                foreach($post_taxs as $post_tax) {
				                    $portfolio_taxs[$post_tax->slug] = $post_tax->name;
				                }
				            }
				        }
				    }
				?>        
				
				<div class="col-md-12">
					
				
			         <div class="controls">
			            <button type="button" class="mix_button all_items" data-filter="all">All</button>
			            <?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
			            	<button type="button"  class="mix_button individual_items" data-filter=".<?php echo $portfolio_tax_slug; ?>"><?php echo $portfolio_tax_name; ?></button>
			            <?php endforeach; ?>
			        </div>

		    	</div>
			
    <?php
     $i = 1;
    while($q->have_posts()) : $q->the_post();
    	
        $idd = get_the_ID();
        $term = get_field('portfolio_category');
        //Get Texanmy class        
        $item_classes = '';
        $item_images =array();
        $item_cats = get_the_terms($post->ID, 'portfolio-cat');
        if($item_cats):
        foreach($item_cats as $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
            $item_images[] = get_field('image', $item_cat);
        }
        endif;
    

    ?>
       

			
                <div class="mix col-md-3 <?php echo $item_classes; echo $i; ?>" >

							   		<div class="short_view">
								   		<?php the_post_thumbnail(); ?>
										<?php the_title(); ?>							   			
							   		</div>

						
									<div class="full_view">
										<div class="description_part">
											<?php //the_post_thumbnail(); ?>
											<?php //the_content(); ?>
										</div>

										<div class="slider_area_part">

											<?php 
												$galleries =  get_field('choose_gallery_for_portfolio');
											?>

											<?php
								        		foreach($galleries as $gallery) { ?>
								            	<?php

								            		$gallery_id = $gallery->ID;
								            		//print_r($gallery_id);
								            		$featured_img_url = get_the_post_thumbnail_url($gallery_id,'full');
								            		//print_r($featured_img_url);
								            	?>





											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-<?php echo $i; ?>">
											  <img src="<?php echo $featured_img_url; ?>" alt="">
											</button>

											<!-- Modal -->
											<div class="modal fade" id="exampleModal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">


													
													<div class="bxslider-<?php echo $i; ?>">


														<?php 
														if( get_field('gallery_images', $gallery_id) )
														{
														   

														    while( the_repeater_field('gallery_images', $gallery_id) )
														    {
														    ?>
														    
														    <div>
														    	<img src="<?php echo  get_sub_field('image')['url']; ?>" alt="">
														    </div>    
														       
														   <?php  }

														    
														}
									           

									            	?>
												
									          		<?php } ?>


													</div>



											      </div>

											    </div>
											  </div>
											</div>

									

										</div>


										

									</div>




                </div>



				<script>

					jQuery('#exampleModal-<?php echo $i; ?>').on('shown.bs.modal', function (e) {
						
						jQuery('.bxslider-<?php echo $i; ?>').bxSlider();

					});



				</script>



				<?php  $i++; endwhile; ?>

					
					
				</div>				
				
			</div>
		</div>
		
	
<?php	
return ob_get_clean();
}	
add_shortcode('portfolios', 'portfolio_shortcodes');














//Old portfolio codes 
// Taxonomy support for Portfolio custom post types
 
function wp_tutorials_post_taxonomy() {
    register_taxonomy(
        'portfolio_category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'jetpack-portfolio',                  //post type name
        array(
            'hierarchical'          => true,
            'label'                         => 'Portfolio Category',  //Display name
            'query_var'             => true,
            'show_admin_column'             => true,
            'rewrite'                       => array(
                'slug'                  => 'portfolio-category', // This controls the base slug that will display before each term
                'with_front'    => true // Don't display the category base before
                )
            )
    );
}
add_action( 'init', 'wp_tutorials_post_taxonomy');



# Dynamic Portfolio With Shortcode
 
function portfolio_shortcode($atts){
    extract( shortcode_atts( array(
        'category' => ''
    ), $atts, '' ) );
     
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'jetpack-portfolio')
        );        
         
 
//Portfolio taxanomy query
    global $paged;
    global $post;
    $args = array(    
        'post_type' => 'jetpack-portfolio',
        'paged' => $paged,
        'posts_per_page' => -1,
    );
 
    $portfolio = new WP_Query($args);
    if(is_array($portfolio->posts) && !empty($portfolio->posts)) {
        foreach($portfolio->posts as $gallery_post) {
            $post_taxs = wp_get_post_terms($gallery_post->ID, 'portfolio_category', array("fields" => "all"));
            if(is_array($post_taxs) && !empty($post_taxs)) {
                foreach($post_taxs as $post_tax) {
                    $portfolio_taxs[$post_tax->slug] = $post_tax->name;
                }
            }
        }
    }
?>        

         <div class="controls">
            <button type="button" class="mix_button all_items" data-filter="all">All</button>
            <?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
            	<button type="button"  class="mix_button individual_items" data-filter=".<?php echo $portfolio_tax_slug; ?>"><?php echo $portfolio_tax_name; ?></button>
            <?php endforeach; ?>
        </div>





 
<?php


ob_start(); ?>


<div class="mix_container">

	<?php



    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $term = get_field('portfolio_category');
        //Get Texanmy class        
        $item_classes = '';
        $item_images =array();
        $item_cats = get_the_terms($post->ID, 'portfolio_category');
        if($item_cats):
        foreach($item_cats as $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
            $item_images[] = get_field('image', $item_cat);
        }
        endif;
        endwhile;		

    ?>
				





    <?php
    $all_taxos = array();
    while($q->have_posts()) : $q->the_post();


            
            $cat = get_the_terms($post->ID, 'portfolio_category');
            $term_id = $cat[0] -> term_id;
            $term = get_term( $term_id );
            $attachment_id = get_field( 'author_image', $term );
            //print_r($cat);
            //print_r($term_id);
            //print_r($term);
            //print_r($attachment_id);
            foreach($cat as $single_cat){
                $all_taxos[] = $single_cat -> term_id;
                //print_r($single_cat);
                //echo "eee";
            }
            
    ?>



    <?php   
        endwhile;


    ?>

        <div class="check_result row">
            <div class="col-md-12">
                
                <?php
                    $term_obj = array();
                    //print_r( array_unique($all_taxos));
                    $all_taxos = array_unique($all_taxos);
                    foreach($all_taxos as $single_taxo){
                       $term =  get_term( $single_taxo, 'portfolio_category' );
                       $name = $term->name;
                       $attachment_image = get_field( 'author_image', $term )['sizes']['large'];
                       //$name = get_field( 'author_image', $term );
                       //print_r($attachment_image);
                       //print_r($name);
                       ?>

                        <li><?php echo $name?></li>
                        <li><?php echo $attachment_image?></li>


                       <?php

                    }

                    //print_r($term_obj);

                ?>
            </div>
            
        </div>        



    <?php

    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $term = get_field('portfolio_category');
        //Get Texanmy class        
        $item_classes = '';
        $item_images =array();
        $item_cats = get_the_terms($post->ID, 'portfolio_category');
        if($item_cats):
        foreach($item_cats as $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
            $item_images[] = get_field('image', $item_cat);
        }
        endif;
    

    ?>
        


                <div class="mix row single_item view_for_individual <?php echo $item_classes ?>" >
                	
                	<div class="col-md-6">
                		<?php //print_r($item_images); ?>
                		<?php //echo $term->name; ?>
                		<?php the_post_thumbnail(); ?>	
                	</div>

                	<div class="col-md-6">
                		<?php the_content(); ?>
                	</div>
                	
                	<div class="col-md-12">


		                <div class="details_container">
			                 <button class="see_more_part" >See more of this Portfolio</button>
			                <div class="details_content">
			                	<div class="hide_this">X</div>

									<div class="slider">

										<?php

										// check if the repeater field has rows of data
										if( have_rows('slider_image') ):

										 	// loop through the rows of data
										    while ( have_rows('slider_image') ) : the_row();

										        // display a sub field value

										        $image = get_sub_field('small_image');
										        $image = $image['url'];
										        //print_r($image);

										        ?>

											    <div>
											    	

													<a class="image-popup-fit-width" href="<?php echo $image; ?>" title="">
														<img src="<?php echo $image; ?>" width="200" height="auto">
													</a>


											    </div>



										        <?php



										    endwhile;

										else :

										    // no rows found

										endif;

										?>




									</div>

				                	<div class="text_description">	                		

				                	</div>





			                </div>                   	
		                </div>
                		
                    </div>






                	
                </div>

   
        <?php       
    endwhile;

    wp_reset_query();


?>



</div>


<?php

	
return ob_get_clean();


}
add_shortcode('portfolio_code', 'portfolio_shortcode');


