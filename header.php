<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php if ( is_home() || is_front_page() ) : ?>
	id="home"
<?php elseif (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) : ?>
	id="shop"
<?php else : ?>
	id="pages"
<?php endif; ?>
<?php body_class(); ?>>

<div class="hfeed site" id="page">
	<div class="container">

	<?php if (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) : ?>
		<!-- ******************* The Imprint Area ******************* -->
  	<div class="row">
  		<div class="col" id="imprint-wrapper">
				<?php echo do_shortcode("[imprint_output]"); ?>
			</div>
  	</div>
	<?php endif; ?>

		<!-- ******************* The Nav Area ******************* -->
		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
		'understrap' ); ?></a>

		<div class="row">
				<nav class="navbar navbar-expand-md col-md-9">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				<?php if (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) : ?>
						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'shop-menu',
								'container_class' => 'collapse navbar-collapse',
								'container_id'    => 'navbarNavDropdown',
								'menu_class'      => 'menu',
								'fallback_cb'     => '',
								'menu_id'         => 'menu-shop',
								'walker'          => new WP_Bootstrap_Navwalker(),
							)
						); ?>

					<?php else : ?>
								<!-- The WordPress Menu goes here -->
								<?php wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'container_class' => 'collapse navbar-collapse',
										'container_id'    => 'navbarNavDropdown',
										'menu_class'      => 'top-menu',
										'fallback_cb'     => '',
										'menu_id'         => 'menu-homepage',
										'walker'          => new WP_Bootstrap_Navwalker(),
									)
								); ?>
						<?php endif ; ?>
				</nav>
				<div class="col-md-3">
					<?php echo do_shortcode("[shoplogo_output]"); ?>
				</div>
  	</div>
		<div class="row">
				<?php get_sidebar( 'left' ); ?>
		</div>
	</div>
