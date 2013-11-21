<?php
/*
Plugin Name: BU Javascript Library
Plugin URI: http://www.bu.edu/nis
Description: Manages and registers several shared JavaScript libraries and themes, which may in turn be used by custom BU plugins to provide consistent theming and functionality.
Author: Boston University (IS&T)
Author URI: http://www.bu.edu/nis
Version: 1.0
*/

// This plugin is loaded (use this for graceful degradation).
define( 'BU_PLUGIN_JAVASCRIPT_LIBRARY', true );

class BU_Javascript_Library {

	// This is a blog-specific URL to the bu-js-lib root directory.
	protected static $url;

	public static function register_js( &$scripts ) {

		self::$url = sprintf('%s/mu-plugins/bu-js-lib', WP_CONTENT_URL);
		$js = self::$url . '/js/';

		$scripts->add('jquery-qtip', $js . 'jquery.qtip-1.0.0-rc3.min.js', array('jquery'), '1.0.0-rc3');
		$scripts->add('jquery-qtip-dev', $js . 'jquery.qtip-1.0.0-rc3.js', array('jquery'), '1.0.0-rc3');
		$scripts->add('jquery-scroller', $js . 'jquery.tools.scroller.min.js', array('jquery'), '1.1.2', array('group' => 1));

		// Custom BU scripts
		$scripts->add('nav-autowidth', $js . 'nav-autowidth.js', array('jquery'), 1.0);
		$scripts->add('bu-modal', self::$url . '/packages/bu-modal/bu-modal.dev.js', array('jquery'), '1.4');
	}

	public static function register_css( &$styles ) {

		self::$url = sprintf('%s/mu-plugins/bu-js-lib', WP_CONTENT_URL);
		$js = self::$url . '/js/';
		$css = self::$url . '/css/';

		// Custom BU scripts
		$styles->add('bu-modal', self::$url . '/packages/bu-modal/css/bu-modal.css', FALSE, '0.1');
	}
}

add_action( 'wp_default_scripts', array( 'BU_Javascript_Library', 'register_js' ) );
add_action( 'wp_default_styles', array( 'BU_Javascript_Library', 'register_css' ) );

?>
