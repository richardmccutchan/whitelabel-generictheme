<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
<?php elseif (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) : ?>
<div class="col-md-3 widget-area" id="cart" role="complementary">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
	<?php endif; ?>


</div><!-- #secondary -->
