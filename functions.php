<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Coastal_Wh' );
define( 'CHILD_THEME_URL', 'http://www.stnsvn.com/' );
define( 'CHILD_THEME_VERSION', '2.1.1' );

//Configure one click install
require get_stylesheet_directory() .'/lib/plugins/radium-one-click-demo-install/init.php';

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'coastal_google_fonts' );
function coastal_google_fonts() {
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:400,700', array(), CHILD_THEME_VERSION );
}

/*  Remove Admin Bar
/* ------------------------------------ */ 
    add_filter('show_admin_bar', '__return_false');

//Initialize the update checker.
// require ('lib/plugins/automatic-theme-updates/theme-updates/theme-update-checker.php');
// $coastal_update_checker = new ThemeUpdateChecker(
//     'coastal',
//     'http://updates.stnsvn.com/coastal/coastal-theme-updates.json'
// );   

//Include shortcodes
require_once('lib/shortcodes.php');


//Configure ACF PRO

    // 1. customize ACF path
    add_filter('acf/settings/path', 'coastal_acf_settings_path');
     
    function coastal_acf_settings_path( $path ) {
     
        // update path
        $path = get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields-pro/';
        
        // return
        return $path;
        
    }
     
    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'coastal_acf_settings_dir');
     
    function coastal_acf_settings_dir( $dir ) {
     
        // update path
        $dir = get_stylesheet_directory_uri() . '/lib/plugins/advanced-custom-fields-pro/';
        
        // return
        return $dir;
        
    }
     
    // 3. Hide ACF field group menu item
    add_filter('acf/settings/show_admin', '__return_false');
    
    // 4. Include ACF
    include_once( get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields-pro/acf.php' );
    require_once('lib/plugins/coastal-acf-pro-settings.php');

//Configure ACF
    define( 'ACF_LITE', false );
    include_once('lib/plugins/advanced-custom-fields/acf.php');
    require_once('lib/plugins/coastal-acf-settings.php');




//Configure third party plugins
require_once('lib/plugins/tgm-plugin-activation/tgm-plugin-activation-config.php');

//* Register images 
add_image_size( 'blog-featured', 840, 2000, FALSE );
add_image_size( 'latest-featured', 767, 850, TRUE );


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//*Enqueue ACF admin scripts
function load_custom_wp_admin_scripts() {
        wp_enqueue_script( 'acf_script', get_stylesheet_directory_uri() . '/lib/js/admin-scripts.js', array( 'jquery' ) );
}
add_action( 'acf/input/admin_footer', 'load_custom_wp_admin_scripts' );

//* Enqueue Viewport Units Buggyfill and theme JS
function coastal_enqueue_scripts() {
    wp_enqueue_script( 'isotopes', get_stylesheet_directory_uri() . '/lib/js/jquery.isotope.min.js', '', '', true );
    wp_enqueue_script( 'viewport-units-buggyfill', get_stylesheet_directory_uri() . '/lib/js/viewport-units-buggyfill.js', '', '0.5.0', true );
    wp_enqueue_script( 'viewport-units-buggyfill.hacks', get_stylesheet_directory_uri() . '/lib/js/viewport-units-buggyfill.hacks.js', '', '0.5.0', true );
    wp_enqueue_script( 'viewport-units-buggyfill-hacks-init', get_stylesheet_directory_uri() . '/lib/js/viewport-units-buggyfill-hacks-init.js', '', '0.5.0', true );
    wp_enqueue_script('jquery-masonry');
    wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/lib/js/main.js', '', '0.1.0', true );
    
}
add_action( 'wp_enqueue_scripts', 'coastal_enqueue_scripts' );
 
 
// Set default attachment display settings
function coastal_setup() {
    // Set default values for the upload media box
    update_option('image_default_align', 'center' );
    update_option('image_default_link_type', 'none' );
    update_option('image_default_size', 'full' );
}
add_action('after_setup_theme', 'coastal_setup');

//Set content width
if ( ! isset( $content_width ) )
    $content_width = 840;

//* Set default layout as full width
genesis_set_default_layout( 'full-width-content' );

/* Header Structure */
add_action( 'genesis_before_header', 'coastal_header_fill' );

/**
 * This function adds the fill bar at the top of the site.
 */
function coastal_header_fill() {
    echo '<div class="header-fill" id="top">' . '</div>';
}

//*Add theme support for woocommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}

//Add featured image support to shop page
add_action('woocommerce_before_main_content', 'coastal_shop_featured', 25);

function coastal_shop_featured() {
    if ( class_exists( 'WooCommerce' ) ) {
        $page_id = wc_get_page_id('shop');
        if ( is_shop() && has_post_thumbnail($page_id) ) {
        echo get_the_post_thumbnail( $page_id, 'full' );
        } 
    }
}

//Add shop class to shop page
if (class_exists( 'WooCommerce' )) {
    add_filter( 'body_class', 'coastal_shop_class' );
    function coastal_shop_class( $classes ) {
            if ( is_shop( ) ) {
                $classes[] = 'shop-page';
            } 
            return $classes;
        }
}

//Fix smooth scroll conflict with WC
add_action('wp_footer','coastal_WCSmoothScrollFix');
function coastal_WCSmoothScrollFix() {
    if (class_exists( 'WooCommerce' ) && is_product()) {
        wp_localize_script( 'main', 'SmoothScroll', array('scroll' => '1') );
    } else {
        wp_localize_script( 'main', 'SmoothScroll', array('scroll' => '0') );
    }
}

//Add placeholder text to WooCommerce fields
if (class_exists( 'WooCommerce' )) {
    add_action( 'genesis_before_footer', 'coastal_review_inputs' );
    function coastal_review_inputs() {
        if (is_product()) {
         ?>       <script>
                jQuery(document).ready(function() {
                  jQuery('#author').attr('placeholder','Name');
                  jQuery('#email').attr('placeholder','Email');
                });
                </script>
        <?php 
            }
    }
}


// Control number of footer columns
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_theme_support('genesis-footer-widgets', 4);

add_action( 'genesis_before_footer', 'coastal_footer_widget_areas' );
function coastal_footer_widget_areas() {
    
    global $footer_col_number, $footer_widget_columns;  
    $footer_col_number = 3; //Add a default for column number so there's no need to add value for 3 columns
    $footer_widget_columns = get_theme_mod( 'footer_col_number', 'footer-col-varied-3' );//Get column number value from theme customizer
    switch ($footer_widget_columns) { //For columns 2, 3, 4: Adds a class to reflect new style for width, which should no longer be a varied width
        case 'footer-col-1':
            
            $cs_col_class = "one-col";
            $footer_col_number = 1;
            
            break;
            
        case 'footer-col-2':
                
            $cs_col_class = "one-2-cols";
            $footer_col_number = 2;
            
            break;
            
        case 'footer-col-3':
            $cs_col_class = "one-3-cols";
            
            break;
            
        case 'footer-col-4':
            
            $cs_col_class = "one-4-cols";
            $footer_col_number = 4;
            
            break;
            
            
        default:
            
            
    }
    
    $cs_footer_widgets = $footer_col_number;
    if ( ! is_active_sidebar( 'footer-1' ) )
        return;
    $cs_inside  = '';
    $cs_output  = '';
    $cs_counter = 1;
    
    while ( $cs_counter <= $cs_footer_widgets ) {
        
        ob_start();
        dynamic_sidebar( 'footer-' . $cs_counter );
        
        $cs_widgets = ob_get_clean();
        if ($footer_widget_columns == "footer-col-varied-3") {
            $cs_inside .= sprintf( '<div class="footer-widgets-%d widget-area">%s</div>', $cs_counter, $cs_widgets );
        }
        else {
            $cs_inside .= sprintf( '<div class="col %s widget-area">%s</div>', $cs_col_class, $cs_widgets );
        }
        $cs_counter++;
    }
    if ( $cs_inside ) {
    
        $cs_output .= genesis_markup( array(
            'html5'   => '<div %s>',
            'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
            'context' => 'footer-widgets',
        ) );
    
        $cs_output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );
        
        $cs_output .= $cs_inside;
        
        $cs_output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );
        
        $cs_output .= '</div>';
    }
    echo $cs_output; //**Removed apply filters and directly echo the output
     
}
//* Full width footer widget area 
genesis_register_sidebar ( 
    array(
        'id' => 'full-width-footer',
        'name' => _('Full Width Footer'),
        'description' => __('This is a full width widget area that displays before the footer.'),
        )
);

//* Add a full-width footer widget area
add_action( 'genesis_before_footer', 'coastal_full_width_footer_widget', 5 );
function coastal_full_width_footer_widget() {
    genesis_widget_area( 'full-width-footer',
        array(
            'before' => '<div class="full-width-footer widget-area">',
            'after' => '</div>',
        )
    );
}

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'coastal_do_subnav' );

function coastal_do_subnav() {
    echo '<div class="nav-container nav-transparent">';
    genesis_do_subnav();
    echo '</div>';
}

//* Register navigation menus
add_theme_support ( 'genesis-menus' , 
                array ( 
                        'primary' => __('Primary Navigation Menu') , 
                        'secondary' => __('Secondary Navigation Menu') , 
                ) 
        );

//Enable or Disable transparency for secondary menu
add_action('wp_footer','coastal_transparent_secondary_nav');
function coastal_transparent_secondary_nav() {
    if ( has_nav_menu( 'secondary' ) ) {
        if (is_front_page()) {
            $coastal_activate_transparent_secondary_menu = get_theme_mod( 'transparent_secondary_menu', 0 );
            } else {
            $coastal_activate_transparent_secondary_menu = 1;
        }
        $coastal_activate_sticky_secondary_menu = get_theme_mod( 'sticky_secondary_menu', 0 );
            wp_localize_script( 'main', 'SecondaryNavParams', array('transparency' => $coastal_activate_transparent_secondary_menu , 'sticky' => $coastal_activate_sticky_secondary_menu) );
      } else {
            wp_localize_script( 'main', 'SecondaryNavParams', array('transparency' => '1' , 'sticky' => '1') );
      }
}

/** Add support for custom header **/
add_action( 'after_setup_theme', 'coastal_register_header', 5 );

function coastal_register_header() {
    add_theme_support( 'genesis-custom-header', array( 'width' => '1400', 'height' => '800' ) );
}

/*Remove existing custom header function*/
remove_action( 'wp_head', 'genesis_custom_header_style', 10 );

add_action( 'wp_head', 'coastal_custom_header_style', 10 );

/**
 * Add custom header callback.
 * It outputs special CSS to the document head, modifying the look of the header based on user input.
 * @since 1.0.0
 * @uses genesis_html() Check for HTML5 support.
 * @return null Return null on if custom header not supported, user specified own callback, or no options set.
 */

function coastal_custom_header_style() {
    //* Do nothing if custom header not supported
    if ( ! current_theme_supports( 'custom-header' ) )
        return;
    //* Do nothing if user specifies their own callback
    if ( get_theme_support( 'custom-header', 'wp-head-callback' ) )
        return;
    $output = '';
    $header_image = get_header_image();
    global $text_color;
    if (is_front_page()) {
            if (get_theme_mod('header_txt_color') != "") {
            $text_color = ltrim (get_theme_mod('header_txt_color', '#333'), '#');//get_header_textcolor();
        }
        else {
            $text_color = "333";
        }
    }
    else {
        $text_color = get_header_textcolor();
    }

    
    //* If no options set, don't waste the output. Do nothing.
    if ( empty( $header_image ) && ! display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
        return;
    $header_selector = get_theme_support( 'custom-header', 'header-selector' );
    $title_selector  = genesis_html5() ? '.custom-header .site-title'       : '.custom-header #title';
    $desc_selector   = genesis_html5() ? '.custom-header .site-description' : '.custom-header #description';
    //* Header selector fallback
    if ( ! $header_selector )
        $header_selector = genesis_html5() ? '.custom-header .site-header' : '.custom-header #header';
    //* Header image CSS, if exists
    if ( $header_image && is_front_page() ) 
        $output .= sprintf( '%s { background: url(%s) no-repeat; background-size: cover!important; height: 800px; height: 100vh; background-attachment: fixed; }', $header_selector, esc_url( $header_image ) );
    //* Header image CSS, if exists
    if ( $header_image && is_404() ) 
        $output .= sprintf( '%s { background: url(%s) no-repeat; background-size: cover!important; height: 800px; height: 100vh; background-attachment: fixed; }', $header_selector, esc_url( $header_image ) );
    //* Header text color CSS, if showing text
    if ( display_header_text() && $text_color !== get_theme_support( 'custom-header', 'default-text-color' ) )
        $output .= sprintf( '%2$s a, %2$s a:hover, %3$s { color: #%1$s !important; }', esc_html( $text_color ), esc_html( $title_selector ), esc_html( $desc_selector ) );
    if ( $output )
        printf( '<style type="text/css">%s</style>' . "\n", $output );
}
//*Manage Genesis defaults
        //* Unregister sidebar/content layout setting
        genesis_unregister_layout( 'sidebar-content' );
        
        //* Unregister content/sidebar/sidebar layout setting
        genesis_unregister_layout( 'content-sidebar-sidebar' );
        
        //* Unregister sidebar/sidebar/content layout setting
        genesis_unregister_layout( 'sidebar-sidebar-content' );
        
        //* Unregister sidebar/content/sidebar layout setting
        genesis_unregister_layout( 'sidebar-content-sidebar' );
       
        //* Remove breadcrumbs
        remove_theme_support( 'genesis-breadcrumbs' );
        
        //* Remove the header right widget area
        unregister_sidebar( 'header-right' );
        
        //* Remove sidebar alt widget area
        unregister_sidebar( 'sidebar-alt' );
        
    // Removing sections from Genesis Theme Settings page
        if (is_admin()) :
          function coastal_remove_settings($pagehook) {
            remove_meta_box( 'genesis-theme-settings-blogpage', $pagehook, 'main' ); 
          }
          add_action( 'genesis_theme_settings_metaboxes' , 'coastal_remove_settings');
        endif;
        
        /** Force full width layout */
        add_filter( 'genesis_pre_get_option_site_layout', 'stnsvn_do_layout' );
        function stnsvn_do_layout( $opt ) {
            if ( is_page() ) { // Modify the conditions to apply the layout to here
                $opt = 'full-width-content'; // You can change this to any Genesis layout
                return $opt;
            }
        }

/* Footer Structure */
//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'coastal_custom_footer' );
function coastal_custom_footer() {
    $coastal_display_copyright = get_theme_mod( 'copyright-footer' );
    $coastal_stnsvn_credit = get_theme_mod( 'stnsvn-credit' );
    if ( $coastal_display_copyright == '' ) {
        echo '<p>Copyright ' , date("Y ") , bloginfo("name");
        }
    else { 
        echo '<p>' , get_theme_mod( 'copyright-footer' ) , '</p>'; 
        }
}

/*Blog Structure*/

// Add id="content" attributes to <main> element
add_filter( 'genesis_attr_content', 'stnsvn_attr_content' );
function stnsvn_attr_content( $attr ) {
     $attr['id'] = 'index-content';
     return $attr;
}

//Enable infinite scroll
function stnsvn_infinite_scroll_init() {
 add_theme_support( 'infinite-scroll', array(
    'container'      => 'index-content',
    'footer'         => false,
    'type'           => 'click',
    'footer_widgets' => true,
    'wrapper'        => true,
    'render'         => 'genesis_do_loop'
 ) );
}
add_action( 'after_setup_theme', 'stnsvn_infinite_scroll_init' );
    if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) :
        remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
    else :
        // do nothing        
    endif;

//* Customize the post info function
add_filter( 'genesis_post_info', 'coastal_info_filter' );
function coastal_info_filter($post_info) {
    $coastal_display_date = get_theme_mod( 'display_post_date', 1 );
    $coastal_display_byline = get_theme_mod( 'display_byline', 0 ); 
    $coastal_display_comment_count = get_theme_mod( 'display_comment_count', 0 );
    
    $blog_post_author="";$blog_post_date = ""; $blog_post_comment = "";
    
    if (is_singular('portfolio') ){
    //do nothing
    }

    else {
        if ( $coastal_display_date != '' ) {
        if ($coastal_display_byline == '' && $coastal_display_comment_count == '' ){
            $blog_post_date = '[post_date]';
        }
        else {
            $blog_post_date = '[post_date] &bull; ';
        }
    }
    
    
    if ( $coastal_display_byline != '' ) {
        if ( $coastal_display_comment_count == '' ) {
            $blog_post_author = '[post_author_posts_link]';
        }
        else {
            $blog_post_author = '[post_author_posts_link] &bull; ' ;
        }
        
    }
    
    if ( $coastal_display_comment_count != '' ) {
        $blog_post_comment = '[post_comments]';
    }
    
    
    $post_info = $blog_post_date.$blog_post_author.$blog_post_comment;
    return $post_info;
  }   
}

//*Modify the footer post meta
add_filter( 'genesis_post_meta', 'coastal_post_meta_filter' );
function coastal_post_meta_filter($post_meta) {
    
    $post_meta = '[post_categories before="'.__('Filed Under').': "] [post_tags before="'.__('Tagged with').': "]';
    if ( is_singular( 'post' )) {
        $coastal_display_categories = get_theme_mod( 'single_display_categories' );
        $coastal_display_tags = get_theme_mod( 'single_display_tags' );
        $blog_meta_categories = ""; $blog_meta_tags = "";
            
        if ( $coastal_display_categories != '' ) {
            $blog_meta_categories = '[post_categories before="'.__('Filed Under: ').'"]'; 
        }
        
        if ( $coastal_display_tags != '' ) {
            $blog_meta_tags = ' [post_tags before="'.__('Tagged with: ').'"]'; 
        }       
        $post_meta = $blog_meta_categories . $blog_meta_tags;
        return $post_meta;
    }
}

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'coastal_more_link' );
function coastal_more_link() {
    return '... <a class="more-link" href="' . get_permalink() . '">'.__('Read More').'</a>';
}

//* Hide the WordPress read more link for custom excerpts
add_filter( 'excerpt_more', 'coastal_custom_excerpt_more' );
function coastal_custom_excerpt_more( $more ) {
    //remove the default read more
}

//* Add custom read more for custom excerpts
add_action('genesis_entry_content', 'cstl2_custom_excerpt_more', 20);

function cstl2_custom_excerpt_more() {
    $archive_style = genesis_get_option('content_archive');
  if ( $archive_style == 'excerpts' ) {
    if (is_archive() or is_home() or is_search()) {
  echo '<a href="' . get_permalink() . '" class="more-link custom-more">' . __( 'Read More' ) . '</a>';
    }
  }
}

//Blog Layout

add_filter( 'genesis_pre_get_option_site_layout', 'coastal_blog_layout' );

function coastal_blog_layout( $opt ) {
    if ( is_home() || is_single()) {
        $opt = get_theme_mod( 'blog_layout' ); 
        return $opt;
    } 
}

//**Excerpt Length
add_filter( 'excerpt_length', 'coastal_excerpt_length' );
function coastal_excerpt_length( $length ) {
    $displayed_content = get_theme_mod( 'post_excerpt_limit' );
    if ($displayed_content != "") {
        return (int)$displayed_content; // pull first 50 words
    }
    else {
        return 400;
    }
}

//* Manage featured image display
add_action( 'genesis_entry_content', 'featured_post_image', 8 );
function featured_post_image() {
    if ( is_page() || is_singular('portfolio') || is_page_template( 'portfolio-page.php' ))  {
        //Do nothing
        } else {
        //Display on postsis enabled in customizer    
        if (is_singular( 'post' )){
            $display_featured_img = get_theme_mod('single_display_featured_image', 1);
            
            if ($display_featured_img != "") {
                the_post_thumbnail('blog-featured');
            }
        }
        else {
        //display on other templates
            the_post_thumbnail('blog-featured');
        }
    }
}

//Display featured image on single pages   
add_action( 'genesis_entry_header', 'coastal_page_featured_image', 5 );
function coastal_page_featured_image() {
        if ( is_page() && has_post_thumbnail() && !is_page_template( 'portfolio-page.php' ) ) {
            the_post_thumbnail('blog-featured');
            }
}


//* Style pagination
add_filter( 'genesis_prev_link_text', 'stnsvn_prev_link_text' );
function stnsvn_prev_link_text() {
        $prevlink = 'Newer';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'stnsvn_next_link_text' );
function stnsvn_next_link_text() {
        $nextlink = 'Older';
        return $nextlink;
}
/*Add share section to blog posts*/
add_action( 'genesis_entry_footer', 'blog_share_box', 10 );
function blog_share_box() { 
  
  
        if ( is_home() ) { 
            $display_blog_share_box = get_theme_mod( 'display_share_buttons', 1 );
            if ( $display_blog_share_box != '') {
                echo '
                    
            <div class="blog-share-box">
            <h1>' , _e('Share') , '</h1>
                <div class="addthis_toolbox addthis_default_style">
                <a class="addthis_button_facebook">Facebook</a>
                <a class="addthis_button_google_plusone_share">Google+</a>
                <a class="addthis_button_twitter">Twitter</a>
                <a class="addthis_button_pinterest_share">Pinterest</a>
                <a class="addthis_button_email">Email</a>
                </div>
        
              <!-- AddThis Button BEGIN -->
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
               <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.get_theme_mod( 'coastal_addthis_pub_id' ).'"></script>
                <!-- AddThis Button END -->
        
            </div>';}
        }
        elseif ( is_singular('post')  ) {
                $display_single_blog_share_box = get_theme_mod( 'single_display_share_buttons', 1 );
                if ( $display_single_blog_share_box != '') {
                 echo '
                        
                    <div class="blog-share-box">
                        <h1>' , _e('Share') , '</h1>
                        <div class="addthis_toolbox addthis_default_style">
                        <a class="addthis_button_facebook">Facebook</a>
                        <a class="addthis_button_google_plusone_share">Google+</a>
                        <a class="addthis_button_twitter">Twitter</a>
                        <a class="addthis_button_pinterest_share">Pinterest</a>
                        <a class="addthis_button_email">Email</a>
                        </div>
                
                      <!-- AddThis Button BEGIN -->
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.get_theme_mod( 'coastal_addthis_pub_id' ).'"></script>
                        <!-- AddThis Button END -->
                
                    </div>';
                }
            
        }
        else {
            if ( is_singular('portfolio')  ) {
                
                 echo '
                        
                    <div class="blog-share-box">
                        <h1>' , _e('Share') , '</h1>
                        <div class="addthis_toolbox addthis_default_style">
                        <a class="addthis_button_facebook">Facebook</a>
                        <a class="addthis_button_google_plusone_share">Google+</a>
                        <a class="addthis_button_twitter">Twitter</a>
                        <a class="addthis_button_pinterest_share">Pinterest</a>
                        <a class="addthis_button_email">Email</a>
                        </div>
                
                      <!-- AddThis Button BEGIN -->
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.get_theme_mod( 'coastal_addthis_pub_id' ).'"></script>
                        <!-- AddThis Button END -->
                
                    </div>';
                
            
            }
        }
        
}
    
//Post comments
// Reposition comment form
remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );
add_action( 'genesis_before_comments', 'genesis_do_comment_form' );
//* Modify comments title text in comments
add_filter( 'comment_form_defaults', 'stnsvn_comment_form_defaults' );
function stnsvn_comment_form_defaults( $defaults ) {
 
    $defaults['title_reply'] = __( 'Comments' );
    return $defaults;
}
add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
function sp_genesis_title_comments() {
    $title = '';
    return $title;
}
//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'stnsvn_remove_comment_form_allowed_tags' );
function stnsvn_remove_comment_form_allowed_tags( $defaults ) {
    $defaults['comment_notes_after'] = '';
    return $defaults;
}
//Edit comment form placeholder text
add_filter( 'comment_form_default_fields', 'stnsvn_comment_placeholders' );
function stnsvn_comment_placeholders( $fields )
{
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
            . _x(
                'Name',
                'comment form placeholder',
                'theme_text_domain'
                )
            . '"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input id="email" name="email" type="email"',
        '<input type="email" placeholder="'.__('Email').'"  id="email" name="email"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input id="url" name="url" type="url"',
        '<input placeholder="'.__('Url').'" id="url" name="url" type="url"',
        $fields['url']
    );
    return $fields;
}
//*Setup content page template
add_action( 'genesis_before_footer', 'back_to_top', 8 );
function back_to_top() { 
     if( is_page_template( 'portfolio-page.php' ) && !is_front_page()) { ?>
        <div class="back-to-top">
            <a href="<?php echo home_url(); ?>">
                <h4 class="button"><?php _e('Go Back')?></h4>
            </a>
        </div>
<?php }
}

//Setup Go Back button on single posts
add_action( 'genesis_after_comments', 'back_to_blog', 8);
function back_to_blog() {
    $display_go_back = get_theme_mod('single_display_go_back', 1);
    if( is_singular( 'post') && $display_go_back == 1 ) { ?>
    <div class="back-to-top">
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
                <h4 class="button"><?php _e('Back to Blog');?></h4>
        </a>
    </div>
<?php }
}

//* Remove Edit Link
add_filter( 'edit_post_link', '__return_false' );
//* Enable redirect for home page subpages
function homepage_template_redirect()
{
    if( is_page_template( 'page-home-section.php' ))
    {
        wp_redirect( home_url( '/' ) );
        exit();
    }
}
add_action( 'template_redirect', 'homepage_template_redirect' );

//********************* Portfolio post type ***************//
function coastal_portfolio() {
  $labels = array(
    'name'               => _x( 'Portfolio', 'post type general name' ),
    'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'portfolio' ),
    'add_new_item'       => __( 'Add New Portfolio Item' ),
    'edit_item'          => __( 'Edit Portfolio Item' ),
    'new_item'           => __( 'New Portfolio Item' ),
    'all_items'          => __( 'All Portfolio Items' ),
    'view_item'          => __( 'View Portfolio Item' ),
    'search_items'       => __( 'Search Portfolio Items' ),
    'not_found'          => __( 'No Portfolio Items found' ),
    'not_found_in_trash' => __( 'No Portfolio Items found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => __( 'Portfolio' )
  );
  $args = array(
    'labels'        => $labels,
    'description'   => __('Holds all portfolio items'),
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );
  register_post_type( 'portfolio', $args );
}
add_action( 'init', 'coastal_portfolio' );
function create_portfolio_category () {
    // Add category taxonomy
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
    );
  register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'create_portfolio_category', 0 );

//* Enable theme customizer and settings
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function coastal_customizer( $wp_customize ) {
  // Remove unused sections 
   $wp_customize->remove_section( 'colors'); 
   $wp_customize->remove_section( 'background_image'); 
   $wp_customize->remove_control( 'display_header_text'); 
   $wp_customize->remove_section( 'genesis_layout'); 
   $wp_customize->remove_section( 'static_front_page'); 
   $wp_customize->remove_control( 'genesis_content_archive_thumbnail'); 
   $wp_customize->remove_control( 'genesis_image_size'); 
   $wp_customize->remove_control( 'genesis_image_alignment'); 
   $wp_customize->remove_control( 'genesis_posts_nav');
   $wp_customize->remove_section( 'genesis_archives');
   
  // Update postMessage on existing settings
   $wp_customize->get_setting('blogname')->transport='postMessage';
   $wp_customize->get_setting('blogdescription')->transport='postMessage';

//-----------------------Landing Header Section -----------------------//
   // Update description on header image section
   $wp_customize->get_section('header_image')->title=__('Landing Header');
   $wp_customize->get_section('header_image')->priority=20;
   $wp_customize->get_control('header_image')->priority=20;

        //Homepage header headline text box
        $wp_customize->add_setting( 
            'header-headline-box', 
            array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
        $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'header-headline-box',
        array(
            'label'          => __('Headline Text'),
            'section'        => 'header_image',
            'settings'       => 'header-headline-box',
            'type'           => 'text',
            'description'    => __('Use this field to display a boxed headline in the header section'),
                )
            )
        );
        //Homepage header text box
        $wp_customize->add_setting( 
            'header-textbox', 
            array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
        $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'header-textbox',
        array(
            'label'          => __('Header Overlay Text'),
            'section'        => 'header_image',
            'settings'       => 'header-textbox',
            'type'           => 'textarea',
            'description'    => __('Use this field to add any additional overlay content to the header area, like a button or a call to action. Accepts html tags like &#12296;h1&#12297;&#12296;strong&#12297;&#12296;img&#12297;&#12296;a&#12297; etc.'),
                )
            )
        );
        
        //Homepage Header Text Color
            $wp_customize->add_setting(
            'header_txt_color',
            array(
                'default' => '#333',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'header_txt_color',
                array(
                    'label' => __('Homepage Header Text Color'),
                    'section' => 'header_image',
                    'settings' => 'header_txt_color',
                )
            )
        );
        

        //Control fixed background
        $wp_customize->add_setting(
            'fix_header',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(
            'fix_header',
            array(
                'type' => 'checkbox',
                'label' => __('Fix header image on scroll'),
                'section' => 'header_image',
            )
        );
        
        //Logo upload section
        $wp_customize->add_setting( 
            'logo_upload',
            array(
                'transport'         => 'postMessage',
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'logo_upload',
                array(
                    'label' => __('Logo Upload'),
                    'section' => 'title_tagline',
                    'settings' => 'logo_upload'
                )
            )
        );

//-----------------------Theme Style Section -----------------------//        
  // Add Theme Styles section  
    $wp_customize->add_section(
        'theme-style',
        array(
            'title' => __('Theme Colors'),
            'description' => __('Note: home page section colors are controlled individually via the page editor.'),
            'priority' => 21,
        )
    );

        //Border color
            $wp_customize->add_setting(
            'coastal-border-color',
            array(
                'default' => '#333333',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'refresh',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'coastal-border-color',
                array(
                    'label' => __('Element Border Color'),
                    'section' => 'theme-style',
                    'settings' => 'coastal-border-color',
                )
            )
        );
        //Footer background color
            $wp_customize->add_setting(
            'footer-background-color',
            array(
                'default' => '#edf4f4',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'footer-background-color',
                array(
                    'label' => __('Footer Background Color'),
                    'section' => 'theme-style',
                    'settings' => 'footer-background-color',
                )
            )
        );
        //Primary background color
            $wp_customize->add_setting(
            'primary-background-color',
            array(
                'default' => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary-background-color',
                array(
                    'label' => __('Primary Background Color'),
                    'section' => 'theme-style',
                    'settings' => 'primary-background-color',
                )
            )
        );
        //Secondary background color
            $wp_customize->add_setting(
            'secondary-background-color',
            array(
                'default' => '#edf4f4',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'secondary-background-color',
                array(
                    'label' => __('Secondary Background Color'),
                    'section' => 'theme-style',
                    'settings' => 'secondary-background-color',
                )
            )
        );
        //Button hover color
            $wp_customize->add_setting(
            'btn-hover-color',
            array(
                'default' => '#edf4f4',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'btn-hover-color',
                array(
                    'label' => __('Button Hover Color'),
                    'section' => 'theme-style',
                    'settings' => 'btn-hover-color',
                )
            )
        );  
        
//-----------------------Typography Section -----------------------//
      // Add Typography section  
        $wp_customize->add_section(
            'typography',
            array(
                'title' => __('Typography'),
                'description' => __('Customize the site typography here. Insert Google Fonts code (eg. http://fonts.googleapis.com/css?family=Lora) and then enter the font name (eg. Lora) in the desired section.'),
                'priority' => 22,
            )
        );
      //Typography Settings
      //Google Font Link Field
        $wp_customize->add_setting(
            'google_font_code',
            array(
            'sanitize_callback' => 'esc_url_raw',
            )
        );
        $wp_customize->add_control(
            'google_font_code',
            array(
                'type' => 'text',
                'label' => __('Google Font Link Code'),
                'section' => 'typography',
            )
        );
        //Primary Font
        $wp_customize->add_setting(
            'primary_font_family',
            array(
            'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
        $wp_customize->add_control(
            'primary_font_family',
            array(
                'label' => __('Primary Font Family'),
                'section' => 'typography',
            )
        );
        //Secondary Font
        $wp_customize->add_setting(
            'secondary_font_family',
            array(
            'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
        $wp_customize->add_control(
            'secondary_font_family',
            array(
                'label' => __('Body Text Font Family'),
                'section' => 'typography',
            )
        );
         //Primary text color
            $wp_customize->add_setting(
            'primary-text-color',
            array(
                'default' => '#333333',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary-text-color',
                array(
                    'label' => __('Text Color'),
                    'section' => 'typography',
                    'settings' => 'primary-text-color',
                    'description' => __('Note: home page section text colors are controlled individually via the page editor.'),
                )
            )
        );
        //Link color
            $wp_customize->add_setting(
            'link-color',
            array(
                'default' => '#333333',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'link-color',
                array(
                    'label' => __('Link Color'),
                    'section' => 'typography',
                    'settings' => 'link-color',
                )
            )
        );

//-----------------------Portfolio Pages Section -----------------------//
    $wp_customize->add_section(
            'portfolio_pages',
            array(
                'title' => __('Portfolio Pages'),
                'description' => __('These settings apply for Portfolio pages only.'),
                'priority' => 24,
            )
        );

        // Add portfolio sidebar layout selector
        $wp_customize->add_setting(
            'portfolio_sidebar',
            array(
                'default' => 'full-width-content',
            )
        );
         
        $wp_customize->add_control(
            'portfolio_sidebar',
            array(
                'type' => 'select',
                'label' => 'Select portfolio sidebar style:',
                'section' => 'portfolio_pages',
                'choices' => array(
                    'content-sidebar' => 'Content, Primary Sidebar',
                    'full-width-content' => 'Full Width Content',
                ),
            )
        );
        
        //Go Back button URL
        $wp_customize->add_setting( 
            'backbtn-url',
                        array(
                'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'backbtn-url',
                array(
                    'label' => __('Back Button URL'),
                    'section' => 'portfolio_pages',
                    'settings' => 'backbtn-url',
                    'type' => 'text'
                )
            )
        );
        
        //Go Back button Text
        $wp_customize->add_setting( 
            'backbtn-text',
                        array(
                'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'backbtn-text',
                array(
                    'label' => __('Back Button Text'),
                    'section' => 'portfolio_pages',
                    'settings' => 'backbtn-text',
                    'type' => 'text'
                )
            )
        );
        
        //Display author by line
            $wp_customize->add_setting(
            'portf_display_share_buttons',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
            )
        );
        $wp_customize->add_control(
            'portf_display_share_buttons',
            array(
                'type' => 'checkbox',
                'label' => __('Display share buttons'),
                'section' => 'portfolio_pages',
            )
        );

//----------------------- Blog Index Section -----------------------//
       
        $wp_customize->add_section(
            'blog_post',
            array(
                'title' => __('Blog Index'),
                'description' => __('These settings apply to main blog index or blog archive page only.'),
                'priority' => 25,
            )
        );

        //Add default Genesis controls
        $wp_customize->get_control('genesis_content_archive')->section='blog_post';
        $wp_customize->get_control('genesis_content_archive_limit')->section='blog_post';
        
        //Default layout
        $wp_customize->add_setting(
            'blog_layout',
            array(
                'default' => genesis_get_default_layout(),
            )
        );

        $wp_customize->add_control(
            'blog_layout',
            array(
                'label'    => __( 'Select Default Layout', 'genesis' ),
                'section'  => 'blog_post',
                'settings' => 'blog_layout',
                'type'     => 'select',
                'priority' => 10,
                'choices'  => genesis_get_layouts_for_customizer(),
            )
        );
        
        //Displaypost date
            $wp_customize->add_setting(
            'display_post_date',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
            )
        );
        $wp_customize->add_control(
            'display_post_date',
            array(
                'type' => 'checkbox',
                'label' => __('Display post date'),
                'section' => 'blog_post',
            )
        );
        
        //Display author by line
            $wp_customize->add_setting(
            'display_byline',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'display_byline',
            array(
                'type' => 'checkbox',
                'label' => __('Display author byline'),
                'section' => 'blog_post',
            )
        );
        
        //Comment count     
         $wp_customize->add_setting(
            'display_comment_count',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
             )
        );
        $wp_customize->add_control(
            'display_comment_count',
            array(
                'type' => 'checkbox',
                'label' => __('Display comment count'),
                'section' => 'blog_post',
            )
        );
        
        //Display Share buttons on blog index       
         $wp_customize->add_setting(
            'display_share_buttons',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
            )
        );
        $wp_customize->add_control(
            'display_share_buttons',
            array(
                'type' => 'checkbox',
                'label' => __('Display share links on main blog page'),
                'section' => 'blog_post',
            )
        );
        
        //AddThis Publisher ID
        $wp_customize->add_setting(
            'coastal_addthis_pub_id',
            array(
            'sanitize_callback' => 'coastal_sanitize_text',
            'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            'coastal_addthis_pub_id',
            array(
                'label' => __('AddThis Publisher ID'),
                'section' => 'blog_post',
                'description' => __('Paste your AddThis publisher ID here to get analytics on how your content is shared.'),
            )
        );
        
//----------------------- Single Blog Posts Section -----------------------//
        
        $wp_customize->add_section(
            'single_blog_post',
            array(
                'title' => __('Single Blog Posts
'),
                'description' => __('These settings apply to individual blog posts only.'),
                'priority' => 26,
            )
        );
        
        //Display Share buttons on blog index       
         $wp_customize->add_setting(
            'single_display_featured_image',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
            )
        );
        $wp_customize->add_control(
            'single_display_featured_image',
            array(
                'type' => 'checkbox',
                'label' => __('Display featured image on single posts'),
                'section' => 'single_blog_post',
            )
        );
        
        //Display Categories        
         $wp_customize->add_setting(
            'single_display_categories',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
            )
        );
        $wp_customize->add_control(
            'single_display_categories',
            array(
                'type' => 'checkbox',
                'label' => __('Display categories'),
                'section' => 'single_blog_post',
            )
        );
        
        //Display Tags      
         $wp_customize->add_setting(
            'single_display_tags',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
               )
        );
        $wp_customize->add_control(
            'single_display_tags',
            array(
                'type' => 'checkbox',
                'label' => __('Display tags'),
                'section' => 'single_blog_post',
            )
        );
        
        //Display Share buttons on single blog post     
         $wp_customize->add_setting(
            'single_display_share_buttons',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
                
            )
        );
        $wp_customize->add_control(
            'single_display_share_buttons',
            array(
                'type' => 'checkbox',
                'label' => __('Display share links on single posts'),
                'section' => 'single_blog_post',
            )
        );

        //Display Go Back button on single blog post     
         $wp_customize->add_setting(
            'single_display_go_back',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
                
            )
        );
        $wp_customize->add_control(
            'single_display_go_back',
            array(
                'type' => 'checkbox',
                'label' => __('Display "Go Back" button on posts'),
                'section' => 'single_blog_post',
            )
        );
        

        //-----------------------Footer Settings Section -----------------------//
        // Add Footer Settings section  
        $wp_customize->add_section(
            'footer_settings',
            array(
                'title' => __('Footer'),
                'priority' => 200,
            )
        );

        //Change number of columns
         $wp_customize->add_setting(
            'footer_col_number',
            array(
                'default' => 'footer-col-varied-3',
            )
        );
         
        $wp_customize->add_control(
            'footer_col_number',
            array(
                'type' => 'select',
                'label' => __('Choose number of columns for footer'),
                'section' => 'footer_settings',
                'choices' => array(
                    'footer-col-1' => __('1 column'),
                    'footer-col-2' => __('2 columns'),
                    'footer-col-3' => __('3 columns'),
                    'footer-col-varied-3' => __('3 columns varied width'),
                    'footer-col-4' => __('4 columns'),
                ),
            )
        );

       //Copyright footer text section
        $wp_customize->add_setting( 
            'copyright-footer',
                        array(
                'sanitize_callback' => 'coastal_sanitize_text',
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'copyright-footer',
                array(
                    'label' => __('Footer Copyright Text'),
                    'section' => 'footer_settings',
                    'settings' => 'copyright-footer',
                    'type' => 'text',
                    'description' => __('Add text to display in the footer copyright section.')
                )
            )
        );
        

        //Remove stnsvn footer credit
        $wp_customize->add_setting( 
            'stnsvn-credit',
                        array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'stnsvn-credit',
                array(
                    'label' => __('Hide Station Seven credit?'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn-credit',
                    'type' => 'checkbox',
                    'description' => __('While of course not required, we appreciate any support as we grow our business :)')
                )
            )
        );

//-----------------------Navigation Menu -----------------------//
      // Add Navigation section  
        $wp_customize->add_section(
            'navigation',
            array(
                'title' => __('Navigation Style'),
                'description' => __('Customize the look of the nav menus here.'),
                'priority' => 100,
            )
        );
        
        //Secondary nav menu background color
            $wp_customize->add_setting(
            'sec_nav_bg_color',
            array(
                'default' => '#FFF',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'sec_nav_bg_color',
                array(
                    'label' => __('Secondary Nav Background Color'),
                    'section' => 'navigation',
                    'settings' => 'sec_nav_bg_color',
                )
            )
        );

        //Secondary nav menu text color
            $wp_customize->add_setting(
            'sec_nav_text_color',
            array(
                'default' => '#333333',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'sec_nav_text_color',
                array(
                    'label' => __('Secondary Nav Text Color'),
                    'section' => 'navigation',
                    'settings' => 'sec_nav_text_color',
                )
            )
        );
        
        //Activate Secondary Menu   
         $wp_customize->add_setting(
            'sticky_secondary_menu',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'sticky_secondary_menu',
            array(
                'type' => 'checkbox',
                'label' => __('Disable secondary nav stickiness'),
                'section' => 'navigation',
            )
        );

        //Activate Secondary Menu transpareny effect  
         $wp_customize->add_setting(
            'transparent_secondary_menu',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'transparent_secondary_menu',
            array(
                'type' => 'checkbox',
                'label' => __('Disable secondary nav transparency'),
                'section' => 'navigation',
            )
        );

                            
//-----------------------Custom CSS Section -----------------------//
      // Add CSS section  
        $wp_customize->add_section(
            'coastal_css',
            array(
                'title' => __('Custom CSS'),
                'description' => __('Add any custom CSS here.'),
                'priority' => 100,
            )
        );
        $wp_customize->add_setting( 
            'coastal_css_box', 
            array(
                'sanitize_callback' => 'coastal_sanitize_text',
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'coastal_css_box',
        array(
            'label'          => __('Custom CSS'),
            'section'        => 'coastal_css',
            'settings'       => 'coastal_css_box',
            'type'           => 'textarea',
                )
            )
        );
    //Check to see if admin and using customizer before updating live css
        if ( $wp_customize->is_preview() && ! is_admin() ) { 
        add_action( 'wp_footer', 'customize_preview', 21);
    }
}
//Sanitize customizer inputs
        function sanitize_checkbox( $input ) {
            if ( $input == 1 ) {
                return 1;
            } else {
                return '';
            }
        }
        function coastal_sanitize_text( $input ) {
            return wp_kses_post( force_balance_tags( $input ) );
        }
//Register CSS changes from customizer
add_action( 'customize_register', 'coastal_customizer', 20 );
//-----------------------Get CSS----------------------------//
//* Add fixed-image body class to the head
$fix_header = get_theme_mod( 'fix_header' );
if( $fix_header != '' ) {
    add_filter( 'body_class', 'fixed_image' );
    function fixed_image( $classes ) {
        
        $classes[] = 'fixed-image';
        return $classes;
    }
}
//* Get uploaded logo
$logo_upload = get_theme_mod( 'logo_upload' );
if( $logo_upload != '' ) {
 add_action('genesis_header', 'coastal_custom_logo', 5);
 function coastal_custom_logo() {
    echo '<div class="header-logo"><a href="' . home_url() . '"><img src="' . get_theme_mod('logo_upload') . '" alt="' . get_bloginfo ( 'name' ) . '"></a></div>';
     //Remove site title and description
    remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
    remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
     }
}
//* Get header headline box
$header_headline_box = get_theme_mod( 'header-headline-box' );
if( $header_headline_box != '') {
 add_action('genesis_header', 'coastal_header_headline_box', 10);
 function coastal_header_headline_box() {
    if (is_front_page()) {
        if (get_theme_mod('header_txt_color') != "") {
            $text_color = get_theme_mod('header_txt_color');//get_header_textcolor();
        }
        else {
            $text_color = "#333";
        }
    echo '<div class="header-headline-box"><h2 style="border-color:'.$text_color.'; color:'.$text_color.'">' . get_theme_mod('header-headline-box') . '</h2></div>';
        }
     }
}
//* Get header textarea
$header_text = get_theme_mod( 'header-textbox' );
if( $header_text != '') {
 add_action('genesis_header', 'coastal_header_text', 10);
 function coastal_header_text() {
    if (is_front_page()) {
    echo '<div class="header-text">' . get_theme_mod('header-textbox') . '</div>';
        }
     }
}
//* Color options
function coastal_customizer_head_styles() {
    echo '<style type="text/css">';
    $main_nav_color = "";
    if (is_front_page()) {
            if (get_theme_mod('header_txt_color') != "") {
                $main_nav_color = get_theme_mod('header_txt_color');
            }
        else {
                $main_nav_color = "#333";
        }

    }

?>
    .nav-primary .genesis-nav-menu a { color: <?php echo $main_nav_color; ?>;}
    .title-area { color: <?php echo $main_nav_color; ?>;}
<?php
    
    $coastal_border_color = get_theme_mod( 'coastal-border-color', '#333333' ); 
    if ( $coastal_border_color != '#333333' ) :
    ?>
    .site-footer, .archive-pagination a, .archive-pagination li a, .site-header .header-headline-box h2, .bloglink-bg h2, 
    .wpcf7 .contact-input input, .wpcf7 textarea.wpcf7-form-control.wpcf7-textarea, .wpcf7 input.wpcf7-form-control.wpcf7-submit, form#subscribe, .enews input#subbutton, .enews input, .simple-social-icons ul li a, .button, textarea#comment, input[type="submit"], .comment-respond input[type="email"], .comment-respond input[type="text"], .comment-respond input[type="url"], input[type="search"], 
    #index-content #infinite-handle span, aside #subscribe-email input {
                border-color: <?php echo $coastal_border_color; ?>;
            } 
            button.menu-toggle, button.sub-menu-toggle {
                color: <?php echo $coastal_border_color; ?>;
           }
    <?php
    endif;
    $footer_background_color = get_theme_mod( 'footer-background-color', '#edf4f4' ); 
    if ( $footer_background_color != '#edf4f4' ) :
    ?>
            .footer-widgets, .site-footer {
                background-color: <?php echo $footer_background_color; ?>;
            }
    <?php
    endif;
    $primary_bg = get_theme_mod( 'primary-background-color', '#ffffff' ); 
    if ( $primary_bg != '#ffffff' ) :
    ?>
            body {
                background-color: <?php echo $primary_bg; ?>;
            }
    <?php
    endif;
    $secondary_bg = get_theme_mod( 'secondary-background-color', '#edf4f4' ); 
    if ( $secondary_bg != '#edf4f4' ) :
    ?>
            .home-section.home-content, .woocommerce-page .woocommerce .woocommerce-error, .woocommerce-page .woocommerce .woocommerce-info, .woocommerce-page .woocommerce .woocommerce-message, .woocommerce-page.woocommerce-checkout #payment {
                background-color: <?php echo $secondary_bg; ?>;
            }
    <?php
    endif;
    $primary_text = get_theme_mod( 'primary-text-color', '#333333' ); 
    if ( $primary_text != '#333333' ) :
    ?>
            body, .enews input#subbox, .back-to-top h4, .footer-widgets, .footer-widgets a, .site-footer, .archive-pagination a, .wpcf7 input.wpcf7-form-control.wpcf7-submit, .enews input#subbutton, .item:hover h4 {
                color: <?php echo $primary_text; ?>;
            }
            blockquote {
                border-color: <?php echo $primary_text; ?>;
            }
    <?php
    endif;
    $link_color = get_theme_mod( 'link-color', '#333333' ); 
    if ( $link_color != '#333333' ) :
    ?>
            p a {
                color: <?php echo $link_color; ?>;
            }
    <?php
    endif;
    $btn_hover = get_theme_mod( 'btn-hover-color', '#edf4f4' ); 
    if ( $btn_hover != '#edf4f4' ) :
    ?>
            button:hover, input:hover[type="button"], input:hover[type="reset"], input:hover[type="submit"], .button:hover, .bloglink-bg h2:hover, .enews input#subbutton:hover, .archive-pagination a:hover, .archive-pagination .active a, input:hover[type="submit"], .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover, .back-to-top h4:hover, .comment-respond input#submit:hover, #index-content #infinite-handle span:hover, .more-link.custom-more:hover,
            .woocommerce-page.woocommerce #respond input#submit:hover, .woocommerce-page .woocommerce a.button:hover, .woocommerce-page.woocommerce a.button:hover, .woocommerce-page.woocommerce button.button:hover, .woocommerce-page .woocommerce input.button:hover, .woocommerce.woocommerce-page  nav.woocommerce-pagination ul li a:focus, .woocommerce.woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce.woocommerce-page nav.woocommerce-pagination ul li span.current {
                background-color: <?php echo $btn_hover; ?>;
            }
    <?php
    endif;
    $primary_font_family = get_theme_mod( 'primary_font_family', '' ); 
    if ( $primary_font_family != '' ) :
    ?>
                h1, h2, h3, h4, h5, h6, .site-title, .site-description, .genesis-nav-menu, .addthis_toolbox a, .wp-caption-text, a.more-link, input, textarea, .entry-title, .entry-meta, blockquote p, .wpcf7-response-output, .sidebar li, .widget select, #index-content #infinite-handle span, .entry-comments .comment-author span, .comment-reply-link, #reply-title, .back-to-top h4, .button-group button, 
                .woocommerce .woocommerce-ordering select, .woocommerce div.product form.cart .variations select, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page.woocommerce div.product .woocommerce-tabs ul.tabs li a, .product_meta {
                font-family: <?php echo $primary_font_family; ?>;
            }
    <?php
    endif;
    $secondary_font_family = get_theme_mod( 'secondary_font_family', '' ); 
    if ( $secondary_font_family != '' ) :
    ?>
                body {
                font-family: <?php echo $secondary_font_family; ?>;
            }
    <?php
    endif;
    $coastal_css_box = get_theme_mod( 'coastal_css_box', '' ); 
    if ( $coastal_css_box != '' ) :
    echo $coastal_css_box; 
    endif;
    
    $secondary_nav_background = get_theme_mod( 'sec_nav_bg_color', '#ffffff' ); 
    if ( $secondary_nav_background != '#ffffff' ) {
    ?>
                .nav-secondary, .nav-container, .nav-container button.menu-toggle {
                      background-color: <?php echo $secondary_nav_background; ?>;
                }
    <?php
    }

    $secondary_nav_text = get_theme_mod( 'sec_nav_text_color', '#333333' ); 
    if ( $secondary_nav_text != '#333333' ) {
    ?>
                .nav-secondary a, .nav-secondary, .nav-container button.menu-toggle, .nav-container button.sub-menu-toggle {
                      color: <?php echo $secondary_nav_text; ?>;
                }
    <?php
    }

    echo '</style>';
//*--------------------------------------------*//

    // Get typography options, add to wp_head
    $ggl_link = get_theme_mod( 'google_font_code' ); 
    if ( $ggl_link != '' ) :
        echo '<link href="' , $ggl_link , '" rel="stylesheet" type="text/css">';
    endif;
}
add_action( 'wp_head', 'coastal_customizer_head_styles' );
//*------------WOOCOMMERCE modifications*//
// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
// Disable woocommerce stylesheet
add_filter( 'woocommerce_enqueue_styles', 'coastal_woo_dequeue_styles' );
function coastal_woo_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    //unset( $enqueue_styles['woocommerce-layout'] );       // Remove the layout
    //unset( $enqueue_styles['woocommerce-smallscreen'] );  // Remove the smallscreen optimisation
    return $enqueue_styles;
}
function wp_enqueue_woocommerce_style(){
    wp_register_style( 'coastal-woocommerce', get_stylesheet_directory_uri() . '/woocommerce/woocommerce.css' );
    
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style( 'coastal-woocommerce' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );


//------------------------Setup live preview for customizer--------------------//
function customize_preview() {
    ?>
    <script type="text/javascript">
        ( function( $ ) {
            wp.customize('sec_nav_bg_color',function( value ) {
                value.bind(function(to) {
                    $('.nav-secondary, .nav-container').css('background-color', to ? to : '#FFF' );
                });
            });
            wp.customize('sec_nav_text_color',function( value ) {
                value.bind(function(to) {
                    $('.nav-secondary a, .nav-secondary, .nav-container button.menu-toggle, .nav-container button.sub-menu-toggle').css('color', to ? to : '#333' );
                });
            });
            wp.customize('blogname',function( value ) {
                value.bind(function(to) {
                    if( to != '' ) {
                    $( '.site-title' ).remove();
                    $( '.title-area' ).prepend('<h1 class="site-title"><a></a></h1>');
                    $('.site-title a').html(to);
                   } else {
                    $( '.site-title' ).remove();
                    }
                });
            });
             wp.customize('blogdescription',function( value ) {
                value.bind(function(to) {
                    if( to != '' ) {
                    $( '.site-description' ).remove();
                    $( '.title-area' ).append('<h2 class="site-description"></h2>');
                    $('.site-description').html(to);
                   } else {
                    $( '.site-description' ).remove();
                    }
                });
            });
            wp.customize( 'header_textcolor', function( value ) {
                value.bind( function( to ) {
                    $('#site-title a, #site-description').css('color', to ? to : '' );
                });
            });
            wp.customize('fix_header',function( value ) {
                value.bind(function(to) {
                            if ( true === to ) {
                        $( 'body' ).addClass( 'fixed-image' );
                    } else {
                        $( 'body' ).removeClass( 'fixed-image' );
                    }
                });
            });
            wp.customize( 'footer-background-color', function( value ) {
                value.bind( function( to ) {
                    $('.footer-widgets, .site-footer').css('background-color', to ? to : '' );
                });
            });
            wp.customize( 'primary-background-color', function( value ) {
                value.bind( function( to ) {
                    $('body').css('background-color', to ? to : '' );
                });
            });
            wp.customize( 'secondary-background-color', function( value ) {
                value.bind( function( to ) {
                    $('.home-section.home-content, .woocommerce-page .woocommerce .woocommerce-error, .woocommerce-page .woocommerce .woocommerce-info, .woocommerce-page .woocommerce .woocommerce-message, .woocommerce-page.woocommerce-checkout #payment').css('background-color', to ? to : '' );
                });
            });
            wp.customize( 'primary-text-color', function( value ) {
                value.bind( function( to ) {
                    $('body, .enews input#subbox, .back-to-top h4, .footer-widgets, .footer-widgets a, .site-footer, .archive-pagination a, .wpcf7 input.wpcf7-form-control.wpcf7-submit, .enews input#subbutton, .item:hover h4').css('color', to ? to : '' );
                    $('blockquote').css('border-color', to ? to : '' );
                });
            });
            wp.customize( 'link-color', function( value ) {
                value.bind( function( to ) {
                    $('p a').css('color', to ? to : '' );
                });
            });
            wp.customize( 'coastal_css_box', function( value ) {
                value.bind( function( to ) {
                    if( to != '' ) {
                    $('#coastal-temp-style').remove();
                    $('head').append('<style id="coastal-temp-style" type="text/css"></style>');
                    $('#coastal-temp-style').html( to);
                    } else {
                    $('#coastal-temp-style').remove();
                    }
                });
            });
            wp.customize('logo_upload',function( value ) {
                   value.bind(function(to) {
                    if( to != '' ) {
                    $( 'header .header-logo' ).remove();
                    $( 'header' ).prepend('<div class="header-logo"><a href="/"><img></a></div>');
                    $( 'header .header-logo img' ).attr("src", to);
                    $( 'header .header-logo img' ).addClass('header-img-temp');
                    $( '.title-area').addClass('hidden');
                   } else {
                    $( 'header .header-logo' ).remove();
                    $( '.title-area' ).removeClass('hidden');
                   }
                });
            });
            wp.customize('header-headline-box',function( value ) {
                   value.bind(function(to) {
                    if( to != '' ) {
                    $( 'header .header-headline-box' ).remove();
                    $( 'header' ).append('<div class="header-headline-box"><h2></h2></div>');
                    $( 'header .header-headline-box h2' ).html( to );
                   } else {
                    $( 'header .header-headline-box' ).remove();
                   }
                });
            });
            wp.customize('header-textbox',function( value ) {
                   value.bind(function(to) {
                    if( to != '' ) {
                    $( 'header .header-text' ).remove();
                    $( 'header' ).append('<div class="header-text"></div>');
                    $( 'header .header-text' ).html( to );
                   } else {
                    $( 'header .header-text' ).remove();
                   }
                });
            });
        } )( jQuery )
    </script>
    
    <?php
}  // End function example_customize_preview()