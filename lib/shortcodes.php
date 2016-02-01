<?php

/*** File for creating and adding shortcodes */

/* Large button */
function cst_large_button($atts){
   extract(shortcode_atts(array(
      'url' 		=> 'http://#',
	  'button_text'	=> __('Button Text')
   ), $atts));

   $button_string = '<div class="btn-large btn-primary wrap"><a href="'.$url.'">
					<h2>'.$button_text.'</h2>
				</a></div>';
   return $button_string;
}

function cst_small_button($atts){
   extract(shortcode_atts(array(
      'url' 		=> 'http://#',
	  'button_text'	=> __('Button Text')
   ), $atts));

   $button_string = '<div class="btn-small btn-primary wrap"><a href="'.$url.'">
					<h2>'.$button_text.'</h2>
				</a></div>';
   return $button_string;
}

function cst_line() {
  
   $line_string = '<div class="coastal-line"></div>';
      
   return $line_string;
}



function cst_col_2($atts, $content = null) {
  
   $col_string = '<div class="col one-2-cols">'.$content.'</div>';
   return $col_string;
}

function cst_col_3($atts, $content = null) {
  
   $col_string = '<div class="col one-3-cols">'.$content.'</div>';
   return $col_string;
}

function cst_col_4($atts, $content = null) {
  
   $col_string = '<div class="col one-4-cols">'.$content.'</div>';
   return $col_string;
}

function register_shortcodes(){
   add_shortcode('coastal-button-large', 'cst_large_button');
   add_shortcode('coastal-button-small', 'cst_small_button');
   add_shortcode('coastal-line', 'cst_line');
   add_shortcode('coastal-col-2', 'cst_col_2');
   add_shortcode('coastal-col-3', 'cst_col_3');
   add_shortcode('coastal-col-4', 'cst_col_4');
}
add_action( 'init', 'register_shortcodes');



?>