<?php
/* # Coastal Theme by Station Seven. 
Theme Name: Coastal
Theme URI: http://coastal.stnsvn.com
Description: The Coastal child theme for Genesis  
Author: Station Seven
Author URI: http://stnsvn.com
Template: genesis  
Template Version: 2.1.2  
Tags: 
License: GPL-2.0+  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  
*/

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_header', 'coastal_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function coastal_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

		printf( '<h1 class="entry-title">%s</h1>', __( 'Not found, error 404', 'genesis' ) );
		echo '<div class="entry-content">';

				echo '<p>' . sprintf( __( 'Whoops, looks like the page you are looking for isn\'t here. Let\'s go back to the <a href="%s">homepage</a> and try again.', 'genesis' ), get_home_url() ) . '</p>';

			echo '</div>';

		echo genesis_html5() ? '</article>' : '</div>';

}

genesis();
