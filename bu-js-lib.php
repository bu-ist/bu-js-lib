<?php
/**
 * Plugin Name: BU Javascript Library
 * Plugin URI: http://www.bu.edu/nis
 * Description: Manages and registers several shared JavaScript libraries and themes, which may in turn be used by custom BU plugins to provide consistent theming and functionality.
 * Author: Boston University (IS&T)
 * Author URI: http://www.bu.edu/nis
 * Version: 2.0.7
 *
 * @package BU_Javascript_Library
 */

// This plugin is loaded (use this for graceful degradation).
define( 'BU_PLUGIN_JAVASCRIPT_LIBRARY', true );
define( 'BU_JS_LIB_VERSION', '2.0.7' );

/**
 * Class BU_Javascript_Library
 */
class BU_Javascript_Library {

	/**
	 * This is a blog-specific URL to the bu-js-lib root directory
	 *
	 * @var string
	 */
	protected static $url;

	/**
	 * Array to keep track of scripts registered by this plugin and if they were succesfully registered.
	 * i.e. 'bu-modal' => true.
	 *
	 * @var array
	 */
	public static $scripts = array();

	/**
	 * Array to keep track of styles registered by this plugin and if they were succesfully registered.
	 * i.e. 'bu-modal' => true.
	 *
	 * @var array
	 */
	public static $styles = array();

	/**
	 * Helper function to keep track of scripts registered. Very similar to wp_register_script()
	 *
	 * @param WP_Scripts       $wp_scripts The WP_Scripts object passed in by the wp_default_scripts action hook.
	 * @param string           $handle     See wp_register_script().
	 * @param string           $src        See wp_register_script().
	 * @param array            $deps       See wp_register_script().
	 * @param string|bool|null $ver        See wp_register_script().
	 * @param bool             $in_footer  See wp_register_script().
	 * @return bool Whether the script has been registered. True on success, false on failure.
	 */
	private static function register_script( &$wp_scripts, $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
		self::$scripts[ $handle ] = $wp_scripts->add( $handle, $src, $deps, $ver );
		if ( $in_footer ) {
			$wp_scripts->add_data( $handle, 'group', 1 );
		}
		return self::$scripts[ $handle ];
	}

	/**
	 * Helper function to keep track of styles registered. Very similar to wp_register_style()
	 *
	 * @param WP_Styles        $wp_styles  The WP_Styles object passed in by the wp_default_styles action hook.
	 * @param string           $handle     See wp_register_style().
	 * @param string           $src        See wp_register_style().
	 * @param array            $deps       See wp_register_style().
	 * @param string|bool|null $ver        See wp_register_style().
	 * @param bool             $media      See wp_register_style().
	 * @return bool Whether the style has been registered. True on success, false on failure.
	 */
	private static function register_style( &$wp_styles, $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
		self::$styles[ $handle ] = $wp_styles->add( $handle, $src, $deps, $ver, $media );
		return self::$styles[ $handle ];
	}

	/**
	 * Register scripts
	 *
	 * @param WP_Scripts $wp_scripts The WP_Scripts object passed in by the wp_default_scripts action hook.
	 * @return void
	 */
	public static function register_js( &$wp_scripts ) {

		self::$url = sprintf( '%s/mu-plugins/bu-js-lib', content_url() );
		$js = self::$url . '/js';

		self::register_script( $wp_scripts, 'jquery-qtip', $js . '/jquery.qtip-1.0.0-rc3.min.js', array( 'jquery' ), '1.0.0-rc3' );
		self::register_script( $wp_scripts, 'jquery-qtip-dev', $js . '/jquery.qtip-1.0.0-rc3.js', array( 'jquery' ), '1.0.0-rc3' );

		// Custom BU scripts.
		self::register_script( $wp_scripts, 'nav-autowidth', $js . '/nav-autowidth.js', array( 'jquery' ), BU_JS_LIB_VERSION );
		self::register_script( $wp_scripts, 'bu-modal', self::$url . '/packages/bu-modal/bu-modal.dev.js', array( 'jquery' ), '1.4' );
	}

	/**
	 * Register Styles
	 *
	 * @param WP_Styles $wp_styles  The WP_Styles object passed in by the wp_default_styles action hook.
	 * @return void
	 */
	public static function register_css( &$wp_styles ) {

		self::$url = sprintf( '%s/mu-plugins/bu-js-lib', content_url() );
		$css = self::$url . '/css';

		// Shared jQuery UI stylesheet
		// @see http://core.trac.wordpress.org/ticket/18909.
		// @see https://github.com/helenhousandi/wp-admin-jquery-ui.
		if ( function_exists( 'is_user_logged_in' ) && is_user_logged_in() && 'classic' == get_user_option( 'admin_color' ) ) {
			self::register_style( $wp_styles, 'bu-jquery-ui', $css . '/jquery-ui-classic.css', array(), BU_JS_LIB_VERSION );
		} else {
			self::register_style( $wp_styles, 'bu-jquery-ui', $css . '/jquery-ui-fresh.css', array(), BU_JS_LIB_VERSION );
		}

		// Custom BU scripts.
		self::register_style( $wp_styles, 'bu-modal', self::$url . '/packages/bu-modal/css/bu-modal.css', false, BU_JS_LIB_VERSION );

	}
}

add_action( 'wp_default_scripts', array( 'BU_Javascript_Library', 'register_js' ) );
add_action( 'wp_default_styles', array( 'BU_Javascript_Library', 'register_css' ) );
