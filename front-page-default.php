<?php 
/**
 * Front Page
 * 
 * @package Coastal
 * @author Station Seven <hello@stnsvn.com> 
 * @copyright Copyright (c) 2015, Station Seven
 * 
 * 
 */ 

// Force full width 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Content Area 
remove_action( 'genesis_loop', 'genesis_do_loop' ); 
add_action( 'genesis_loop', 'coastal_home_loop' );

function coastal_home_loop() {
            $parent = get_the_ID();

				// WP_Query arguments
				$args = array (
					'post_parent'            => $parent,
					'post_type'              => 'page',
					'order'                  => 'ASC',
					'orderby'                => 'menu_order',
					'posts_per_page'         => '-1',
				);

				// The Query
				$query = new WP_Query( $args );

							// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();					

	if(get_field('section_type') == "collection"){
	echo '<div class="home-section home-collection clearfix" id="'; global $post; echo $post->post_name;
	echo '">
		<div class="wrap">
				<h1>' , the_title() , '</h1>';
				if(get_field('section_subtitle')) { ?><h3 class="section-subtitle"><?php the_field('section_subtitle') ?></h3><?php } ;
	echo		'<div id="collection-container">
				<div class="gutter-sizer"></div>
				<div class="grid-sizer"></div>
				';

				// WP_Query arguments
				$args = array (
					'post_type'              => 'page',
					'order'                  => 'ASC',
					'orderby'                => 'menu_order',
					'posts_per_page'         => '-1',
					'meta_query'             => array(
						array(
							'key'       => '_wp_page_template',
							'value'     => 'portfolio-page.php',
						),
					),
				);

				$collection_query = new WP_Query( $args );
				if ( $collection_query->have_posts() ) { 
					while ( $collection_query->have_posts() ) { 
						$collection_query->the_post();
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							?>
							 <div class="item">
							 	<a href="<?php the_permalink(); ?>">
							 		<?php the_title('<div class="overlay"><h4>', '</h4></div>'); ?>
							<?php the_post_thumbnail('large'); 
						echo 	'</a>
							</div>';
						} 
					}
				}
				wp_reset_postdata(); 
	echo	'</div>
			</div>
		</div>';
			};

			
	if(get_field('section_type') == "text"){
	echo	'<div class="home-section home-content clearfix fullwidth-section"> 
				<div class="wrap">
				<h1 id="'; global $post; echo $post->post_name;
	echo '">' , the_title() , '</h1>';
				if(get_field('section_subtitle')) { ?><h3 class="section-subtitle"><?php the_field('section_subtitle') ?></h3><?php } ;
				
				if(get_field('text_block_content')) { the_field('text_block_content'); };
				
							
	echo			'</div>
			</div>';
	};
		

	if(get_field('section_type') == "photo"){
	?>
	<div class="home-section home-bloglink clearfix fullwidth-section" style=" background: url(<?php the_field('blog_image')?>); background-size: cover; background-position: 50%; background-repeat: no-repeat;" id="<?php global $post; echo $post->post_name;?>">
		
        <div class="bloglink-bg wrap">
        	<a href="<?php the_field('blog_link_url'); ?>">
					<h2><?php the_field('blog_link_text'); ?></h2>
				</a></div>		
	</div>
	<?php
		
	};
	

	if(get_field('section_type') == "contact"){
	?>
	<div class="home-section home-contact clearfix" id="<?php global $post; echo $post->post_name;?>">
				<div class="wrap">
				<h1><?php the_field('contact_section_header')?></h1>
    <?php
				if(get_field('section_subtitle')) {
	?>
    			<h3 class="section-subtitle"><?php the_field('section_subtitle') ?></h3>
	<?php 		} ;
	echo		'<div class="contact-form">';
    echo do_shortcode( get_field('contact_form_shortcode') );
	echo		'</div>
				</div>
			</div>';
						};
					};
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
	echo '</div>';

}

genesis(); ?>
