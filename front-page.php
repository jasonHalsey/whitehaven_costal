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

$layout = get_page_template();
if (basename($layout, ".php") == "front-page-main") {
	get_template_part( 'front-page', "main" );
}
else
{
	get_template_part( 'front-page', "default" );
}


?>
