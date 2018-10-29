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


  wp_enqueue_script('mixitup-script', get_stylesheet_directory_uri() .'/js/mixitup.min.js', array('jquery'),'', true);
  wp_enqueue_script('bxslider-script', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'),'', true);
  wp_enqueue_script('magnify-script', get_stylesheet_directory_uri() .'/js/jquery.magnific-popup.min.js', array('jquery'),'', true);



  wp_enqueue_script('main-script', get_stylesheet_directory_uri() .'/js/scripts.js', array(),'', true);

}

add_action('wp_enqueue_scripts','cwp_fc_scripts');

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
            <button type="button" class="mix_button" data-filter="all">All</button>
            <?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
            	<button type="button"  class="mix_button" data-filter=".<?php echo $portfolio_tax_slug; ?>"><?php echo $portfolio_tax_name; ?></button>
            <?php endforeach; ?>
        </div>





 
<?php

 /*
    $list = '<div class="mix_container">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        //Get Texanmy class        
        $item_classes = '';
        $item_cats = get_the_terms($post->ID, 'portfolio_category');
        if($item_cats):
        foreach($item_cats as $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
        }
        endif;
             
        $single_link = 
        $list .= '    
 
                <div class="mix '.$item_classes.'" >'.get_the_title().'</div>        
        ';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
*/

ob_start(); ?>


<div class="mix_container">

	<?php 
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        //Get Texanmy class        
        $item_classes = '';
        $item_cats = get_the_terms($post->ID, 'portfolio_category');
        if($item_cats):
        foreach($item_cats as $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
        }
        endif;
        ?>
 
                <div class="mix row single_item <?php echo $item_classes ?>" >
                	
                	<div class="col-md-6">
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
								    <div>
								    	

										<a class="image-popup-fit-width" href="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_b.jpg" title="">
											<img src="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_s.jpg" width="75" height="75">
										</a>


								    </div>

								    <div>
								    	

										<a class="image-popup-fit-width" href="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_b.jpg" title="">
											<img src="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_s.jpg" width="75" height="75">
										</a>

								    	
								    </div>
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