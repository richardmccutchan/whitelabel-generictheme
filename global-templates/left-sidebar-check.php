<?php
/**
 * Left sidebar check.
 *
 * @package understrap
 */

?>

<?php
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
	<?php get_sidebar( 'left' ); ?>
<?php endif; ?>

<?php {
	$html = '';
	if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {
		$html = '<div class="';
		if (strpos($_SERVER['REQUEST_URI'], "online-bestellen") !== false) {
			$html .= 'col-md-9 content-area" id="content">';
		} else {
			$html .= 'col-md-12 content-area" id="content">';
		}
		echo $html; // WPCS: XSS OK.
	} elseif ( is_active_sidebar( 'right-sidebar' ) && is_active_sidebar( 'left-sidebar' ) ) {
		$html = '<div class="';
		if ( 'both' === $sidebar_pos ) {
			$html .= 'col-md-6 content-area" id="primary">';
		} else {
			$html .= 'col-md-12 content-area" id="primary">';
		}
		echo $html; // WPCS: XSS OK.
	} else {
	    echo '<div class="col-md-12 content-area" id="primary">';
	}
}
