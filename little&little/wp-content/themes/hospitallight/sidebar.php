<?php
/**
 * The sidebar containing the main widget area
 *
 */
?>

<aside id="sidebar">

	<?php if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>
		<?php
			/**
			 * Display Widgets dragged in the 'Sidebar' Widget Area
			 */
		?>
		<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>

	<?php endif; ?>
	
</aside><!-- #sidebar -->