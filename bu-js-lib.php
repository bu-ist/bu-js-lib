<?php
/*
Plugin Name: BU Javascript Library
Plugin URI: http://www.bu.edu/nis
Description: Manages and registers several shared JavaScript libraries and themes, which may in turn be used by custom BU plugins to provide consistent theming and functionality.
Author: NIS
Author URI: http://www.bu.edu/nis
Version: 1.0
*/

// This plugin is loaded (use this for graceful degradation).
define('BU_PLUGIN_JAVASCRIPT_LIBRARY', true);

class BuJavascriptLib
{

	// This is a blog-specific URL to the bu-js-lib root directory.
	protected static $url;

	public static function registerJS(&$scripts)
	{
		self::$url = sprintf('%s/mu-plugins/bu-js-lib', WP_CONTENT_URL);
		$js = self::$url . '/js/';
		

		/* jquery plugins and addons */
		
		$scripts->add('jquery-dev', $js . 'jquery-1.3.2.dev.js', array(), '1.3.2');
		$scripts->add('jquery-nested-sortable', $js . 'inestedsortable-1.0.1.pack.js', array('jquery'), '1.0.1');
		$scripts->add('jquery-scrolling-tree', $js . 'jquery-scrolling-tree.js', array('jquery'), '1.0');
		$scripts->add('jquery-dimensions', $js . 'jquery-dimensions.1.0b2.js', array('jquery'), '1.0b2');
		$scripts->add('jquery-tooltip', $js . 'jquery-tooltip.1.3.js', array('jquery', 'jquery-dimensions'), '1.3');
		$scripts->add('jquery-qtip', $js . 'jquery.qtip-1.0.0-rc3.min.js', array('jquery'), '1.0.0-rc3');
		$scripts->add('jquery-qtip-dev', $js . 'jquery.qtip-1.0.0-rc3.js', array('jquery'), '1.0.0-rc3');	
		$scripts->add('jquery-tree', $js . 'jstree/jquery.tree.min.js', array('jquery'), 0.99);
		$scripts->add('jquery-tree-dev', $js . 'jstree/jquery.tree.js', array('jquery'), 0.99);
		$scripts->add('jquery-tree-contextmenu', $js . 'jstree/plugins/jquery.tree.contextmenu.js', array('jquery'), 0.99);
		$scripts->add('jquery-tree-checkbox', $js . 'jstree/plugins/jquery.tree.checkbox.js', array('jquery'), 0.99);
		$scripts->add('jquery-cookie', $js . 'jstree/lib/jquery.cookie.js', array('jquery'), 0.99);
		$scripts->add('jquery-tree-cookie', $js . 'jstree/plugins/jquery.tree.cookie.js', array('jquery','jquery-cookie'), 0.99);
		$scripts->add('jquery-metadata', $js . 'jstree/lib/jquery.metadata.cookie.js', array('jquery'), 0.99);
		$scripts->add('jquery-json', $js . 'json/jquery.json-2.2.js', array('jquery'), 2.2);
		$scripts->add('jquery-ui', $js . 'jquery-ui-1.7.2.custom.min.js', array('jquery'), 1.72);
		$scripts->add('jquery-validation', $js . 'jquery.validate.min.js', array('jquery', 'jquery-form'), 1.55);
		$scripts->add('jquery-validation-dev', $js . 'jquery.validate.js', array('jquery', 'jquery-form'), 1.55);
		$scripts->add('jquery-hoverintent', $js . 'jquery.hoverIntent.minified.js', array('jquery'), 5);
		$scripts->add('jquery-hoverintent-dev', $js . 'jquery.hoverIntent.js', array('jquery'), 5);
		$scripts->add('jquery-autocomplete', $js . 'jquery.autocomplete.min.js', array('jquery'), '1.1');
		$scripts->add('jquery-autocomplete-dev', $js . 'jquery.autocomplete.js', array('jquery'), '1.1');
		$scripts->add('jquery-scroller', $js . 'jquery.tools.scroller.min.js', array('jquery'), '1.1.2', array('group' => 1));

		/* primary navigation autowidth */
		$scripts->add('nav-autowidth', $js . 'nav-autowidth.js', array('jquery'), 1.0);
		
		// Mootools and friends.
		$scripts->add('mootools', $js . 'mootools-1.2.3-core.js', array(), '1.2.3');
		$scripts->add('mootools-dev', $js . 'mootools-1.2.3-core.dev.js', array(), '1.2.3');
	}

	public static function registerCSS(&$styles)
	{
		self::$url = sprintf('%s/mu-plugins/bu-js-lib', WP_CONTENT_URL);
		$js = self::$url . '/js/';
		$css = self::$url . '/css/';

		$styles->add('jquery-tree', $js . 'jstree/themes/default/style.css', FALSE, 0.99);
		$styles->add('jquery-tree-apple', $js . 'jstree/themes/apple/style.css', FALSE, 0.99);
		$styles->add('jquery-tree-checkbox', $js . 'jstree/themes/checkbox/style.css', FALSE, 0.99);
		$styles->add('jquery-tree-classic', $js . 'jstree/themes/classic/style.css', FALSE, 0.99);	
		$styles->add('jquery-ui', $css . 'jquery-ui-1.7.2.custom.css', FALSE, 1.72);
		$styles->add('jquery-ui-lightness', $css . 'ui-lightness/style.css', FALSE, 1);
		$styles->add('jquery-autocomplete', $css . 'jquery.autocomplete.css', FALSE, 1.1);
	}
}
add_action('wp_default_scripts', array('BuJavascriptLib', 'registerJS'));
add_action('wp_default_styles', array('BuJavascriptLib', 'registerCSS'));
?>
