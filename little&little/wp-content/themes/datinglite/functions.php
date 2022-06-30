<?php

/**
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'DATINGLITE_MIN_PHP_VERSION', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'datinglite_test_for_min_php' );

/**
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function datinglite_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, DATINGLITE_MIN_PHP_VERSION, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'datinglite_min_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}

if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

/**
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function datinglite_min_php_not_met_notice() {
	?>
	<div class="notice notice-error is_dismissable">
		<p>
			<?php esc_html_e( 'You need to update your PHP version to run this theme.', 'datinglite' ); ?> <br />
			<?php
			printf(
				/* translators: 1 is the current PHP version string, 2 is the minmum supported php version string of the theme */
				esc_html__( 'Actual version is: %1$s, required version is: %2$s.', 'datinglite' ),
				PHP_VERSION,
				DATINGLITE_MIN_PHP_VERSION
			); // phpcs: XSS ok.
			?>
		</p>
	</div>
	<?php
}

if ( ! function_exists( 'datinglite_nav_wrap' ) ) :
	function datinglite_nav_wrap() {

		// open the <ul>, set 'menu_class' and 'menu_id' values
		$wrap  = '<ul id="%1$s" class="%2$s">';

	  	// get nav items as configured in /wp-admin/
	  	$wrap .= '%3$s';

	  	if ( class_exists( 'WooCommerce' ) ) {

	  		global $woocommerce;

			$wrap .= '<li><a class="cart-contents-icon" href="' . esc_attr( wc_get_cart_url() )
						. '" title="' . esc_attr( __('View your shopping cart', 'datinglite') )
					   .'"></a><div id="cart-popup-content"><div class="widget_shopping_cart_content"></div></div></li>';

		}

		// close the <ul>
		$wrap .= '</ul>';

		// return the result
		return $wrap;
	}
endif; // datinglite_nav_wrap


if ( ! function_exists( 'datinglite_fonts_url' ) ) :
	/**
	 *	Load google font url used in the datinglite theme
	 */
	function datinglite_fonts_url() {

	    $fonts_url = '';
	 
	    /* Translators: If there are characters in your language that are not
	    * supported by Questrial, translate this to 'off'. Do not translate
	    * into your own language.
	    */
	    $fontname = _x( 'on', 'Questrial font: on or off', 'datinglite' );

	    if ( 'off' !== $fontname ) {
	        $font_families = array();
	 
	        $font_families[] = 'Questrial';
	 
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( 'latin,latin-ext' ),
	        );
	 
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	    }
	 
	    return $fonts_url;
	}
endif; // datinglite_fonts_url

if ( ! function_exists( 'datinglite_load_css_and_scripts' ) ) :

	function datinglite_load_css_and_scripts() {

		wp_enqueue_style( 'datinglite-stylesheet', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'datinglite-child-style', get_stylesheet_uri(), array( 'datinglite-stylesheet' ) );

		wp_enqueue_style( 'datinglite-fonts', datinglite_fonts_url(), array(), null );

		// Load Slider JS Scripts
		wp_enqueue_script( 'jquery-cloud9carousel',
			get_stylesheet_directory_uri() . '/assets/js/jquery.cloud9carousel.js', array( 'jquery' ) );

		wp_enqueue_script( 'datinglite-utilities-js',
			get_stylesheet_directory_uri() . '/assets/js/utilities.js',
			array( 'jquery', 'jquery-cloud9carousel' ) );
	}

endif; // datinglite_load_css_and_scripts
add_action( 'wp_enqueue_scripts', 'datinglite_load_css_and_scripts' );

if ( ! function_exists( 'datinglite_display_slider' ) ) :
	/**
	 * Displays the slider
	 */
	function datinglite_display_slider() {
?>
		<div class="cloud9-wrapper">
			<div id="cloud9-carousel">
				<?php
						// display slides
						for ( $i = 1; $i <= 5; ++$i ) {
							
							$defaultSlideImage = get_stylesheet_directory_uri().'/assets/img/' . $i .'.jpg';

							$slideImage = get_theme_mod( 'datinglite_slide'.$i.'_image', $defaultSlideImage );
				?>
								<div class="cloud9-item">
									<img src="<?php echo esc_attr( $slideImage ); ?>" />
								</div><!-- .cloud9-item -->
				<?php
						} // end of for
?>
				<button class="cloud9-nav noselect left">
			      <i class="fa fa-angle-double-left" aria-hidden="true"></i>
			    </button>
			    <button class="cloud9-nav noselect right">
			      <i class="fa fa-angle-double-right" aria-hidden="true"></i>
			    </button>
			</div><!-- #cloud9-carousel -->
		</div><!-- .cloud9-wrapper -->
<?php 
	}
endif; // datinglite_display_slider

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function datinglite_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'datinglite_skip_link_focus_fix' );

if ( ! function_exists( 'datinglite_sanitize_checkbox' ) ) :
	/**
	 * Checkbox sanitization callback example.
	 * 
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function datinglite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif; // End of datinglite_sanitize_checkbox

if ( ! function_exists( 'datinglite_show_social_sites' ) ) :

	function datinglite_show_social_sites() {

		$socialURL = get_theme_mod('datinglite_social_facebook');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Facebook', 'datinglite') ) . '" class="facebook16"></a></li>';
		}

		$socialURL = get_theme_mod('datinglite_social_twitter');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Twitter', 'datinglite') ) . '" class="twitter16"></a></li>';
		}

		$socialURL = get_theme_mod('datinglite_social_instagram');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Instagram', 'datinglite') ) . '" class="instagram16"></a></li>';
		}

		$socialURL = get_theme_mod('datinglite_social_rss');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow our RSS Feeds', 'datinglite') ) . '" class="rss16"></a></li>';
		}

		$socialURL = get_theme_mod('datinglite_social_reddit');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Reddit', 'datinglite') ) . '" class="reddit16"></a>';
		}

		$socialURL = get_theme_mod('datinglite_social_xing');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Xing', 'datinglite') ) . '" class="xing16"></a>';
		}

		$socialURL = get_theme_mod('datinglite_social_slack');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on Slack', 'datinglite') ) . '" class="slack16"></a>';
		}

		$socialURL = get_theme_mod('datinglite_social_wechat');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on WeChat', 'datinglite') ) . '" class="wechat16"></a>';
		}

		$socialURL = get_theme_mod('datinglite_social_snapchat');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( __('Follow us on SnapChat', 'datinglite') ) . '" class="snapchat16"></a>';
		}
	}
endif; // datinglite_show_social_sites

if ( ! function_exists( 'datinglite_customize_register' ) ) :

	/**
	 * Register theme settings in the customizer
	 */
	function datinglite_customize_register( $wp_customize ) {

		/**
		 * Add Slider Section
		 */
		$wp_customize->add_section(
			'datinglite_slider_section',
			array(
				'title'       => __( 'Slider', 'datinglite' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add display slider option
		$wp_customize->add_setting(
				'datinglite_slider_display',
				array(
						'default'           => 0,
						'sanitize_callback' => 'datinglite_sanitize_checkbox',
				)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_slider_display',
								array(
									'label'          => __( 'Display Slider on a Static Front Page', 'datinglite' ),
									'section'        => 'datinglite_slider_section',
									'settings'       => 'datinglite_slider_display',
									'type'           => 'checkbox',
								)
							)
		);

		for ($i = 1; $i <= 5; ++$i) {
		
			$slideImageId = 'datinglite_slide'.$i.'_image';
			$defaultSliderImagePath = get_stylesheet_directory_uri().'/assets/img/'.$i.'.jpg';
			
			// Add Slide Background Image
			$wp_customize->add_setting( $slideImageId,
				array(
					'default' => $defaultSliderImagePath,
					'sanitize_callback' => 'datinglite_slug_sanitize_image'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
					array(
						'label'   	 => sprintf( esc_html__( 'Slide #%s Image', 'datinglite' ), $i ),
						'section' 	 => 'datinglite_slider_section',
						'settings'   => $slideImageId,
					) 
				)
			);
		}

		/**
		 * Add Social Sites Section
		 */
		$wp_customize->add_section(
			'datinglite_social_section',
			array(
				'title'       => __( 'Social Sites', 'datinglite' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add facebook url
		$wp_customize->add_setting(
			'datinglite_social_facebook',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_facebook',
	        array(
	            'label'          => __( 'Facebook Page URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_facebook',
	            'type'           => 'url',
	            )
	        )
		);

		// Add Twitter url
		$wp_customize->add_setting(
			'datinglite_social_twitter',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_twitter',
	        array(
	            'label'          => __( 'Twitter URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_twitter',
	            'type'           => 'url',
	            )
	        )
		);

		// Add Instagram url
		$wp_customize->add_setting(
			'datinglite_social_instagram',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_instagram',
	        array(
	            'label'          => __( 'LinkedIn URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_instagram',
	            'type'           => 'url',
	            )
	        )
		);

		// Add RSS Feeds url
		$wp_customize->add_setting(
			'datinglite_social_rss',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_rss',
	        array(
	            'label'          => __( 'RSS Feeds URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_rss',
	            'type'           => 'url',
	            )
	        )
		);

		// Add Reddit url
		$wp_customize->add_setting(
			'datinglite_social_reddit',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_reddit',
	        array(
	            'label'          => __( 'Reddit URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_reddit',
	            'type'           => 'url',
	            )
	        )
		);

		// Add Xing url
		$wp_customize->add_setting(
			'datinglite_social_xing',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_xing',
	        array(
	            'label'          => __( 'Xing URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_xing',
	            'type'           => 'url',
	            )
	        )
		);

		// Add Slack url
		$wp_customize->add_setting(
			'datinglite_social_slack',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_slack',
	        array(
	            'label'          => __( 'Slack URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_slack',
	            'type'           => 'url',
	            )
	        )
		);

		// Add WeChat url
		$wp_customize->add_setting(
			'datinglite_social_wechat',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_wechat',
	        array(
	            'label'          => __( 'WeChat URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_wechat',
	            'type'           => 'url',
	            )
	        )
		);

		// Add SnapChat url
		$wp_customize->add_setting(
			'datinglite_social_snapchat',
			array(
			    'sanitize_callback' => 'datinglite_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'datinglite_social_snapchat',
	        array(
	            'label'          => __( 'SnapChat URL', 'datinglite' ),
	            'section'        => 'datinglite_social_section',
	            'settings'       => 'datinglite_social_snapchat',
	            'type'           => 'url',
	            )
	        )
		);
	}
endif; // datinglite_customize_register
add_action('customize_register', 'datinglite_customize_register');

if ( ! class_exists( 'datinglite_Customize' ) ) :
	/**
	 * Singleton class for handling the theme's customizer integration.
	 */
	final class datinglite_Customize {

		// Returns the instance.
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}

			return $instance;
		}

		// Constructor method.
		private function __construct() {}

		// Sets up initial actions.
		private function setup_actions() {

			// Register panels, sections, settings, controls, and partials.
			add_action( 'customize_register', array( $this, 'sections' ) );

			// Register scripts and styles for the controls.
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
		}

		// Sets up the customizer sections.
		public function sections( $manager ) {

			// Load custom sections.

			// Register custom section types.
			$manager->register_section_type( 'hospitallight_Customize_Section_Pro' );

			// Register sections.
			$manager->add_section(
				new hospitallight_Customize_Section_Pro(
					$manager,
					'datinglite',
					array(
						'title'    => esc_html__( 'DatingPro', 'datinglite' ),
						'pro_text' => esc_html__( 'Upgrade', 'datinglite' ),
						'pro_url'  => esc_url( 'https://customizablethemes.com/product/datingpro' )
					)
				)
			);
		}

		// Loads theme customizer CSS.
		public function enqueue_control_scripts() {

			wp_enqueue_script( 'hospitallight-customize-controls', trailingslashit( get_template_directory_uri() ) . 'assets/js/customize-controls.js', array( 'customize-controls' ) );

			wp_enqueue_style( 'hospitallight-customize-controls', trailingslashit( get_template_directory_uri() ) . 'assets/css/customize-controls.css' );
		}
	}
endif; // datinglite_Customize

// Doing this customizer thang!
datinglite_Customize::get_instance();

/**
 * Remove Parent theme Customize Up-Selling Section
 */
if ( ! function_exists( 'datinglite_remove_parent_theme_upsell_section' ) ) :

	function datinglite_remove_parent_theme_upsell_section( $wp_customize ) {

		// Remove Parent-Theme Upsell section
		$wp_customize->remove_section('hospitallight');
	}

endif; // datinglite_remove_parent_theme_upsell_section
add_action( 'customize_register', 'datinglite_remove_parent_theme_upsell_section', 100 );

if ( ! function_exists( 'datinglite_slug_sanitize_image' ) ) :

	function datinglite_slug_sanitize_image( $image, $setting ) {
		/*
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
	    $mimes = array(
	        'jpg|jpeg|jpe' => 'image/jpeg',
	        'gif'          => 'image/gif',
	        'png'          => 'image/png',
	        'bmp'          => 'image/bmp',
	        'tif|tiff'     => 'image/tiff',
	        'ico'          => 'image/x-icon'
	    );
		// Return an array with file extension and mime_type.
	    $file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
	    return ( $file['ext'] ? $image : $setting->default );
	}

endif; // datinglite_slug_sanitize_image

if ( ! function_exists( 'datinglite_sanitize_url' ) ) :

	function datinglite_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}

endif; // datinglite_sanitize_url

if ( ! function_exists( 'datinglite_setup' ) ) :
	/**
	 * datinglite setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */
	function datinglite_setup() {

		// add WooCommerce support
		add_theme_support( 'woocommerce' );

		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(

			'widgets' => array(
				'sidebar-widget-area' => array(
					'search',
					'recent-posts',
					'categories',
					'archives',
				),


			),

			'posts' => array(
				'home',
				'blog',
				'about',
				'contact'
			),

			// Default to a static front page and assign the front and posts pages.
			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			// Set the front page section theme mods to the IDs of the core-registered pages.
			'theme_mods' => array(
				'datinglite_slider_display' => 1,
				'datinglite_slide1_image' => esc_url( get_stylesheet_directory_uri() . '/assets/img/1.jpg' ),
				'datinglite_slide2_image' => esc_url( get_stylesheet_directory_uri() . '/assets/img/2.jpg' ),
				'datinglite_slide3_image' => esc_url( get_stylesheet_directory_uri() . '/assets/img/3.jpg' ),
				'datinglite_slide4_image' => esc_url( get_stylesheet_directory_uri() . '/assets/img/4.jpg' ),
				'datinglite_slide5_image' => esc_url( get_stylesheet_directory_uri() . '/assets/img/5.jpg' ),
				'datinglite_social_facebook' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_twitter' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_instagram' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_rss' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_reddit' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_xing' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_slack' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_wechat' => _x( '#', 'Theme starter content', 'datinglite' ),
				'datinglite_social_snapchat' => _x( '#', 'Theme starter content', 'datinglite' ),
			),

			'nav_menus' => array(

				// Assign a menu to the "primary" location.
				'primary' => array(
					'name' => __( 'Primary Menu', 'datinglite' ),
					'items' => array(
						'link_home',
						'page_blog',
						'page_contact',
						'page_about',
					),
				),

				// Assign a menu to the "footer" location.
				'footer' => array(
					'name' => __( 'Footer Menu', 'datinglite' ),
					'items' => array(
						'link_home',
						'page_blog',
						'page_contact',
						'page_about',
					),
				),
			),
		);

		$starter_content = apply_filters( 'datinglite_starter_content', $starter_content );
		add_theme_support( 'starter-content', $starter_content );	
	}
endif; // datinglite_setup
add_action( 'after_setup_theme', 'datinglite_setup' );