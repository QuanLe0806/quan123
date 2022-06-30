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

					<?php get_sidebar( 'footer' ); ?>

					<div class="clear">
					</div>

				</div><!-- #footer-content-wrapper -->

			</footer>
			<div id="footer-bottom-area">
				<div id="footer-bottom-content-wrapper">
					<div id="copyright">

						<p>
							<?php ayaphotography_show_copyright_text(); ?>
						 	<a href="<?php echo esc_url( 'https://ayatemplates.com/product/ayaphotography' ); ?>"
						 		title="<?php esc_attr_e( 'ayaphotography Theme', 'ayaphotography' ); ?>">
								<?php esc_html_e('ayaphotography Theme', 'ayaphotography'); ?>
							</a> 
							<?php
								/* translators: %s: WordPress name */
								printf( __( 'Powered by %s', 'ayaphotography' ), 'WordPress' ); ?>
						</p>
						
					</div><!-- #copyright -->
				</div>
			</div><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>