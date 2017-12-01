<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

if (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) :
?>
<div class="col-md-12 hide-sm-down" id="sub-menu">
	<?php dynamic_sidebar( 'left-sidebar' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
