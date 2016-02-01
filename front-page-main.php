<?php 
/**
 * Template Name: Scrolling Home Page
 * 
 * @package Coastal
 * @author Station Seven <hello@stnsvn.com> 
 * @copyright Copyright (c) 2015, Station Seven
 * 
 */ 

// Force full width 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Content Area 
remove_action( 'genesis_loop', 'genesis_do_loop' ); 
add_action( 'genesis_loop', 'coastal_home_loop' );

function coastal_home_loop() {

global $coll_grid_ctr;
				
if( have_rows('home_page_sections') ):
				
	while ( have_rows('home_page_sections') ) : the_row();
							  			
	if( get_row_layout()  == "collection" ){
	$coll_grid_ctr++;
			
	$bg_color = get_sub_field('coll_background_color') ? get_sub_field('coll_background_color') : '#fff';	
	$txt_color = get_sub_field('coll_text_color') ? get_sub_field('coll_text_color') : '#333';

	$coll_sort = get_sub_field('coll_sort') ? get_sub_field('coll_sort') : 'ASC';
	
	$button_bg_color = get_sub_field('coll_cat_button_bg_color') ? get_sub_field('coll_cat_button_bg_color') : '#fff';
	$button_hover_color = get_sub_field('coll_cat_button_hover_color') ? get_sub_field('coll_cat_button_hover_color') : '#edf4f4';	
	$button_txt_color = get_sub_field('coll_cat_button_text_color') ? get_sub_field('coll_cat_button_text_color') : '#333';
	$button_hover_txt_color = get_sub_field('coll_cat_button_hover_text_color') ? get_sub_field('coll_cat_button_hover_text_color') : '#333';
	
	$coll_menu_link = ltrim(str_replace("/#","", get_sub_field('coll_menu_link')));
	
	echo '<div class="home-section home-collection clearfix" id="'.$coll_menu_link.'" style="background:'.$bg_color.';color:'.$txt_color.'">
		<div class="wrap">
				<h1>'.get_sub_field('coll_header_title').'</h1>';
				if(get_sub_field('coll_section_subtitle')) { ?><h3 class="section-subtitle"><?php the_sub_field('coll_section_subtitle'); ?></h3><?php } ;
				
		if (get_sub_field('display_collection_buttons') ) {
					
	?>
    
    				<div class="button-group button-group-ctr-<?php echo $coll_grid_ctr;  ?> filters-button-group filters-button-group-ctr-<?php echo $coll_grid_ctr;  ?>">
	<?php
    				
					
	?>
                    <button data-filter="*" style="background:<?php echo $button_bg_color; ?>;color:<?php echo $button_txt_color; ?>" onMouseOver="this.style.color='<?php echo $button_hover_txt_color; ?>';this.style.backgroundColor='<?php echo $button_hover_color; ?>';"
     onMouseOut="this.style.color='<?php echo $button_txt_color; ?>';this.style.backgroundColor='<?php echo $button_bg_color; ?>';">All</button>	
	
    <?php
		/*#####
			if there are selected categories:
				Get the ID's of selected portfolio categories;
				Get the slug value of each;
				Add the slug value to the button data filter;
				Display buttons for selected category
		    If no selected category:
				Display buttons for all categories
		*/			   
			if (get_sub_field('coll_categories') <> "") {	
					
					
					
				    $portfolio_categories = get_sub_field('coll_categories');
										
					foreach ( $portfolio_categories as $pf_cat_val ) {
						
						$pf_cat = get_term_by('id', $pf_cat_val, 'portfolio_category');
										
	?>
						<button data-filter=".<?php echo $pf_cat->slug; ?>" style="background:<?php echo $button_bg_color; ?>;color:<?php echo $button_txt_color; ?>" onMouseOver="this.style.color='<?php echo $button_hover_txt_color; ?>';this.style.backgroundColor='<?php echo $button_hover_color; ?>';"
     onMouseOut="this.style.color='<?php echo $button_txt_color; ?>';this.style.backgroundColor='<?php echo $button_bg_color; ?>';"><?php echo $pf_cat->name;?></button>
				  		
	<?php 		
					}
				
				 }
				 else {
					
					$portfolio_categories = get_terms( 'portfolio_category', array(
						'orderby'    => 'id',
						'hide_empty' => 0,
				 	) );
				 	
					foreach ( $portfolio_categories as $pf_cat ) {
						?>
						<button data-filter=".<?php echo $pf_cat->slug; ?>" style="background:<?php echo $button_bg_color; ?>;color:<?php echo $button_txt_color; ?>" onMouseOver="this.style.color='<?php echo $button_hover_txt_color; ?>';this.style.backgroundColor='<?php echo $button_hover_color; ?>';"
     onMouseOut="this.style.color='<?php echo $button_txt_color; ?>';this.style.backgroundColor='<?php echo $button_bg_color; ?>';"><?php echo $pf_cat->name;?></button>
				  		
	<?php 
					}
				}
				 
	?>			  				 
				</div><!--button group -->					
	<?php
    		}
			
			
	?>			
                <div class="grid grid-ctr-<?php echo $coll_grid_ctr; ?>">
	<?php
				
				if (get_sub_field('coll_categories') == ""){
					// WP_Query arguments
					$portf_args = array (
						'post_type'              => 'portfolio',
						'order'                  => $coll_sort,
						'orderby'                => 'date',
						'posts_per_page'         => '-1',
						
						
					);	
				}
				else {
					$portf_category_arr = get_sub_field('coll_categories');
				
				
					$portf_category_count = count($portf_category_arr); //total number of selected category
					
					$portf_category = array();
					$array_loop = 0;
					
					/*get the categories by id and add the slug for each category on the portf_category array*/
					 
					foreach ($portf_category_arr as $key => $value) 
					{ 
						
						$array_loop++;
						
						
						$portf_slug = get_term_by('id', $value, 'portfolio_category');
						array_push($portf_category, $portf_slug->slug);
						 
					}
					
					$portf_number = "-1";
					$portf_args = array (
						'post_type'              => 'portfolio',
						'order'                  => $coll_sort,
						'orderby'                => 'date',
						'posts_per_page'         => $portf_number,
						'tax_query' => array(
								array(
									'taxonomy' => 'portfolio_category',
									'field'    => 'slug',
									'terms'    => $portf_category
								),
						),
						
					);
					
				}
				
				$collection_query = new WP_Query( $portf_args );
				if ( $collection_query->have_posts() ) { 
					?>
            			<div class="grid-sizer grid-sizer-ctr-<?php echo $coll_grid_ctr;  ?>"></div>
						<div class="gutter-sizer gutter-sizer-ctr-<?php echo $coll_grid_ctr;  ?>"></div>
                    <?php
					while ( $collection_query->have_posts() ) { 
						$collection_query->the_post();
						
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							?>
							 <?php
                             	
								$pf_ID = get_the_ID();
								$pf_term_slugs = "";
								
								if (has_term('', 'portfolio_category')) {
																
									$portfolio_terms = get_the_terms( $pf_ID, 'portfolio_category' );
									
									foreach ( $portfolio_terms as $pf_term ) {
										$pf_term_slugs .= $pf_term->slug." ";
									}
								}
							
							 ?>
                             <div class="item item-ctr-<?php echo $coll_grid_ctr;  ?> <?php echo trim($pf_term_slugs); ?>">
							 	<a href="<?php the_permalink(); ?>">
                                	<?php the_title('<div class="overlay"><h4>', '</h4></div>'); ?>
							<?php the_post_thumbnail('large'); 
						echo 	'</a>
							</div>';
						} 
					}
					?>
                    
                    <?php
				}
				
				wp_reset_postdata(); 
	echo	'</div><!--grid -->
			</div><!--wrap -->
		</div><!--home-section -->';
	}					

	elseif( get_row_layout() == "text" ){
		
		$bg_color = get_sub_field('txt_background_color') ? get_sub_field('txt_background_color') : '#edf4f4';	
		$txt_color = get_sub_field('txt_text_color') ? get_sub_field('txt_text_color') : '#333';
		$txt_menu_link = ltrim(str_replace("/#","", get_sub_field('txt_menu_link')));
		echo	'<div class="home-section home-content clearfix fullwidth-section" id="'.$txt_menu_link.'" style="background:'.$bg_color.';color:'.$txt_color.'">
					<div class="wrap">
					<h1>'.get_sub_field('txt_header_title').'</h1>';
					if(get_sub_field('txt_section_subtitle')) { ?><h3 class="section-subtitle"><?php the_sub_field('txt_section_subtitle') ?></h3><?php } ;
					
					if(get_sub_field('txt_content')) { echo get_sub_field('txt_content'); }
					
					
									
		echo			'</div>
				</div>';
	}
	
	elseif( get_row_layout() == "latest" ){
	
	$bg_color = get_sub_field('tl_background_color') ? get_sub_field('tl_background_color') : '#fff';	
	$txt_color = get_sub_field('tl_text_color') ? get_sub_field('tl_text_color') : '#333';
	$tl_menu_link = ltrim(str_replace("/#","", get_sub_field('tl_menu_link')));
	?>
    <div class="home-section home-latest clearfix fullwidth-section" id="<?php echo $tl_menu_link; ?>" style="background:<?php echo $bg_color; ?>;color:<?php echo $txt_color; ?>"> 
				<div class="wrap">
				<h1><?php echo get_sub_field('tl_header_title'); ?></h1>
    <?php
				
				if(get_sub_field('tl_section_subtitle')) { ?><h3 class="section-subtitle"><?php echo get_sub_field('tl_section_subtitle'); ?></h3><?php } ;
				
				// WP_Query arguments
				$number_posts = get_sub_field('tl_number_of_posts');
				
				if (get_sub_field('tl_category') == ""){
					$args = array (
						'post_type'              => 'post',
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'posts_per_page'         => $number_posts
					);
				}
				else {
					$post_category_arr = get_sub_field('tl_category');
				
				
					$post_category_count = count($post_category_arr); //total number of selected category
					$post_category = "";
					$array_loop = 0; 
					foreach ($post_category_arr as $key => $value) 
					{ 
						
						$array_loop++;
						/*
							if only 1 category is selected, just add the value to post category
							else, 
								check if category is not the last one on the array, add the value then add a comma after the value
								else, add the value but don't add a oomma after the value
						*/
						if ($post_category_count == 1) { 
							$post_category = $value;
						}
						else {
							$post_category .= ($post_category_count <> $array_loop) ? $value.", " : $value;		
						}
						
						
						
						 
					}
					$args = array (
						'post_type'              => 'post',
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'posts_per_page'         => $number_posts,
						'cat'   				 =>	$post_category
					);
									
					
				}
				
				$loop_ctr = 0;
				
				
				$latests_query = new WP_Query( $args );
				$total_posts = $latests_query->found_posts;
				if ( $latests_query->have_posts() ) {
				?>
                	<div class="latest-row section group">
                <?php	 
					
					while ( $latests_query->have_posts() ) { 
						$latests_query->the_post();
						
						if($loop_ctr % 3 == 0 && $loop_ctr != 0) { //checks if post is the third post for the row
							
							if ($loop_ctr == $total_posts ) { //if post counter is equal to the total number of posts to be displayed, add ending div tag to end the row and the display of posts
				?>
                	</div>
                <?php
								
							}
							else { //if post counter is not equal to the total number of posts to be displayed, add ending div tag to end the row and add another row
				?>
                	</div><div class="latest-row section group">
                <?php
								
								
							}
						 }						
							
							$loop_ctr++;
							
						?>
                            
                            <div class="col one-3-cols">
                            	
                                <a href="<?php the_permalink(); ?>">
                                	<?php
                                    	if ( has_post_thumbnail() ) {

												the_post_thumbnail('latest-featured');
										
										}

									?>
							 		<?php
                                    $latest_item_tag = '<h3 style="color:'.$txt_color.'">';
									the_title($latest_item_tag, '</h3>'); ?>
							 
								</a>
                            </div>
                                                       
							 
                            <?php
					 
					}
				?>
                </div>
                <?php
					
					
				}
				wp_reset_postdata();
				
				
	echo		'</div>
			</div>';
	}
		

	elseif( get_row_layout() == "photo" ){
			$photo_link = get_sub_field('blog_link_url') ? get_sub_field('blog_link_url') : '';	
			$link_text = get_sub_field('blog_link_text') ? get_sub_field('blog_link_text') : '';	
	?>
	<div class="home-section home-bloglink clearfix fullwidth-section" style=" background: url(<?php the_sub_field('blog_image')?>); background-size: cover; background-position: 50%; background-repeat: no-repeat;" id="<?php echo get_sub_field('blog_menu_link');?>">		
        <div class="bloglink-bg wrap">
        	<?php if ($photo_link != '') {
        		echo '<a href="' , $photo_link , '">';
        			//Display button if text entered
        			if ($link_text != ''){
					echo '<h2>' , $link_text , '</h2>';
					}
        		echo '</a>';
        	}	
        	//Display text but no link
        	else if ($link_text != '') {
					echo '<h2>' , $link_text , '</h2>';
			}	else {
				//Do nothing
			} ?>
		</div>		
	</div>
	<?php
		
	}
	
	elseif( get_row_layout() == "contact" ){
	
	$bg_color = get_sub_field('contact_background_color') ? get_sub_field('contact_background_color') : '#fff';	
	$txt_color = get_sub_field('contact_text_color') ? get_sub_field('contact_text_color') : '#333';
	$contact_menu_link = ltrim(str_replace("/#","", get_sub_field('contact_menu_link')));
	
		echo	'<div class="home-section home-contact clearfix" id="'.$contact_menu_link.'" style="background:'.$bg_color.';color:'.$txt_color.'">';
	?>
				<div class="wrap">
				<h1><?php the_sub_field('contact_header_title')?></h1>
    <?php
				if(get_sub_field('contact_section_subtitle')) {
	?>
    			<h3 class="section-subtitle"><?php the_sub_field('contact_section_subtitle') ?></h3>
	<?php 		} ;
	echo		'<div class="contact-form">';
    echo do_shortcode( get_sub_field('contact_form_shortcode') );
	echo		'</div>
				</div>
			</div>';
	}
	

		endwhile;
				
	else :
				
					// no layouts found
				
	endif;
				/* Restore original Post Data */
				wp_reset_postdata();
	echo '</div>';
	

	
}

genesis(); ?>
