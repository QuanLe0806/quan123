<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "body-content-wrapper" div.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<?php
            if ( is_singular() && pings_open() ) :
                printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
            endif;
        ?>
		<meta name="viewport" content="width=device-width" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<a class="skip-link screen-reader-text" href="#main-content-wrapper">
			<?php _e( 'Skip to content', 'datinglite' ); ?>
		</a>
		<div id="body-content-wrapper">
			<header id="header-main-fixed">
				<div id="header-content-wrapper">
					<div id="header-top">
						<div id="header-top-inner">
				            <ul class="header-social-widget">
								<?php datinglite_show_social_sites(); ?>
							</ul><!-- .header-social-widget -->
							<div class="clear">
							</div><!-- .clear -->
						</div><!-- #header-top-inner -->
					</div><!-- #header-top -->

					<div id="header-logo">
						<?php
							if ( function_exists( 'the_custom_logo' ) ) :

								the_custom_logo();

							endif;

							$header_text_color = get_header_textcolor();

						    if ( 'blank' !== $header_text_color ) :
						?>    
						        <div id="site-identity">

						        	<a href="<?php echo esc_url( home_url('/') ); ?>"
						        		title="<?php esc_attr( get_bloginfo('name') ); ?>">

						        		<h1 class="entry-title">
						        			<?php echo esc_html( get_bloginfo('name') ); ?>
										</h1>
						        	</a>
						        	<strong>
						        		<?php echo esc_html( get_bloginfo('description') ); ?>
						        	</strong>
						        </div><!-- #site-identity -->
						<?php
						    endif;
						?>
					</div><!-- #header-logo -->

					<nav id="navmain">
						<?php wp_nav_menu( array( 'theme_location' => 'primary',
												  'fallback_cb'    => 'wp_page_menu',
												  'items_wrap'      => datinglite_nav_wrap(),
												  
												  ) ); ?>
						<div class="clear">
						</div><!-- .clear -->
					</nav><!-- #navmain -->
					<div class="clear">
					</div><!-- .clear -->
				</div><!-- #header-content-wrapper -->
			</header><!-- #header-main-fixed -->
			<div class="clear">
			</div><!-- .clear -->
			<?php if ( is_front_page() && get_option( 'show_on_front' ) == 'page' ) :

						if ( get_theme_mod('datinglite_slider_display', 0) == 1 ) :

							datinglite_display_slider();

						endif;
			
				  endif; ?>

