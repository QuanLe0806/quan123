<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 */
?>
			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<nav id="footer-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'footer', ) ); ?>
					</nav>

					<div class="clear">
					</div>

				</div><!-- #footer-content-wrapper -->

			</footer>
			<div id="footer-bottom-area">
				<div id="footer-bottom-content-wrapper">
					<div id="copyright">

						<p>
							<?php

								$footerText = get_theme_mod('hospitallight_footer_copyright', null);

								if ( !empty( $footerText ) ) {

									echo esc_html( $footerText ) . ' | ';		
								}

							?>
						 	<a href="<?php echo esc_url( 'https://customizablethemes.com/product/hospitallight' ); ?>"
						 		title="<?php esc_attr_e( 'HospitalLight Theme', 'hospitallight' ); ?>">
								<?php esc_html_e('HospitalLight Theme', 'hospitallight'); ?>
							</a> 
							<?php
								/* translators: %s: WordPress name */
								printf( __( 'Powered by %s', 'hospitallight' ), 'WordPress' ); ?>
						</p>
						
					</div><!-- #copyright -->
				</div>
			</div><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>