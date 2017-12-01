<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}

// Register shop menu
function register_my_menu() {
  register_nav_menu('shop-menu',__( 'Shop Menu' ));
}
add_action( 'init', 'register_my_menu' );

/*********
* Whitelabel scripts
************/

// Add scripts to wp_head()
function child_theme_head_script() { ?>
    <link rel="stylesheet" id="wppizza-css" href="https://pizzadewl201.wpengine.com/wp-content/themes/bober_child/wppizza-addingredients.min.css?ver=1.0.0" type="text/css" media="all">
    <link rel="stylesheet" id="wppizza-css" href="https://pizzadewl201.wpengine.com/wp-content/themes/bober_child/style.css?ver=1.0.4" type="text/css" media="all">
    <link rel="stylesheet" id="wppizza-css" href="https://pizzadewl201.wpengine.com/wp-content/themes/bober_child/asia-new.css?ver=1.0.1" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|PT+Serif" rel="stylesheet">
<?php }
add_action( 'wp_head', 'child_theme_head_script' );


// Adds 'odd' and 'even' classes to each post
function wpsd_oddeven_post_class ( $classes ) {
    global $current_class;
    $classes[] = $current_class;
    $current_class = ($current_class == 'odd') ? 'even' : 'odd';
    return $classes;
}
add_filter ('post_class', 'wpsd_oddeven_post_class');
global $current_class;
$current_class = 'odd';


// Shortcode to output dynamic page titel in Visual Composer
function titel( $atts ) {
    echo the_title( '<h1 id="category-headline" class="b_entry__title">', '</h1>' );

}
add_shortcode( 'titel_output', 'titel');
remove_filter('the_content', 'wpautop');

// Shortcode to output imprint page titel in Visual Composer
function imprint( $atts ) {
    // Get the current site's URL
    $url = get_bloginfo( 'url' );
    $imprint = unserialize(get_option('wppizza_dowant_imprint'));
    echo '<p id="imprint"><span id="knd-option">' .
      '<a title="Shop-Impressum" href="' . $url . '/impressum">IMPRESSUM</a>&nbsp;|' .
      '&nbsp;</span>' . $imprint['restaurant_name'] . '&nbsp;|&nbsp;' .
      $imprint['address_street_name'] . '&nbsp;' . $imprint['address_street_number'] . '&nbsp;|&nbsp;' .
      $imprint['address_zipcode'] . '&nbsp;' . $imprint['address_city'] . '</p>';

}
add_shortcode( 'imprint_output', 'imprint');
remove_filter('the_content', 'wpautop');


// Shortcode to output dynamic imprint data in Visual Composer
function imprint_data( $atts ) {
    $imprint = unserialize(get_option('wppizza_dowant_imprint'));
    echo '<p><b>' . $imprint['restaurant_name'] . '</b><br>' . $imprint['address_street_name'] . '&nbsp;' . $imprint['address_street_number'] . '<br>' .
        $imprint['address_zipcode'] . '&nbsp;' . $imprint['address_city'] . '</p><p><b>Verantwortlich:</b><br>' . $imprint['restaurant_owner'] . '</p><p><b>Telefon:</b><br>' . $imprint['address_phone'] . '</p>';
}
add_shortcode( 'imprint_data_output', 'imprint_data');
remove_filter('the_content', 'wpautop');

// Shortcode to output dynamic shoplogo in Visual Composer
function shoplogo( $atts ) {
    $shoplogo_url = unserialize(get_option('wppizza_dowant_restaurant_info'));
    echo "<div class='logo'><a href='/' ><img width='120' height='120' src='" . $shoplogo_url['logo_uri'] . "'></a></div>";
}
add_shortcode( 'shoplogo_output', 'shoplogo');
remove_filter('the_content', 'wpautop');


//Add GTM to header
function add_custom_gtm(){
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KF6FFSH');</script>
<!-- End Google Tag Manager -->
<?php
}
add_action('wp_head', 'add_custom_gtm');

//Add GTM to body
add_filter( 'body_class', 'gtm_add', 10000 );
function gtm_add( $classes ) {
$block = <<<'BLOCK'
<!-- Google Tag Manager -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KF6FFSH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager -->
BLOCK;
$classes[] = '">' . $block . '<br style="display:none';
return $classes;
}
