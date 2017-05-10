<?php
/**
 * Class BU_Javascript_Library_Test
 *
 * @package BU_Javascript_Library
 */

/**
 * Test BU_Javascript_Library script/style registering
 */
class BU_Javascript_Library_Test extends WP_UnitTestCase {

	/**
	 * Run once before runing the tests
	 *
	 * @return void
	 */
	public static function setUpBeforeClass() {
		// Instantiate wp_scripts and wp_styles.
		wp_scripts();
		wp_styles();
	}

	/**
	 * Check if the plugin main class is defined
	 *
	 * @return void
	 */
	public function test_class_is_defined() {
		$this->assertTrue( class_exists( 'BU_Javascript_Library' ), "Plugin's main class does not exist." );
	}

	/**
	 * Check that atleast one file is registered. There is no point in having this plugin if nothing is being registered
	 *
	 * @return void
	 */
	function test_files_are_being_registered() {
		// get handles that attempted to register.
		$scripts = BU_Javascript_Library::$scripts;
		$styles = BU_Javascript_Library::$styles;

		$this->assertNotEmpty( array_merge( $scripts, $styles ), 'No files are being registered' );
	}

	/**
	 * Check if all scripts were registered successfully
	 *
	 * @return void
	 */
	function test_scripts_registered_successfully() {
		// get handles that attempted to register.
		$scripts = BU_Javascript_Library::$scripts;

		// loop through handles.
		foreach ( $scripts as $handle => $registered ) {
			// assert registration was successfull.
			$this->assertTrue( ( true === $registered && wp_script_is( $handle, 'registered' ) ), "The file {$handle} failed to register" );
		}
	}

	/**
	 * Check if all styles registered successfully
	 *
	 * @return void
	 */
	function test_styles_registered_successfully() {
		// get handles that attempted to register.
		$styles = BU_Javascript_Library::$styles;

		// loop through handles.
		foreach ( $styles as $handle => $registered ) {
			// assert registration was successfull.
			$this->assertTrue( ( true === $registered && wp_style_is( $handle, 'registered' ) ), "The file {$handle} failed to register" );
		}
	}

	/**
	 * Make sure that every script actually points to an existing file
	 *
	 * @return void
	 */
	function test_scripts_exist() {
		global $wp_scripts;

		// Get plugin absolute path.
		$plugin_dirname = dirname( dirname( __FILE__ ) );

		// get handles that attempted to register.
		$scripts = BU_Javascript_Library::$scripts;

		// loop through handles.
		foreach ( $scripts as $handle => $registered ) {
			// get the WP_Dependency.
			$dependency = $wp_scripts->registered[ $handle ];
			// find the dependency relative path to the plugin directory.
			$dependency_path_relative_to_plugin_dirname = substr( $dependency->src, ( strpos( $dependency->src, basename( $plugin_dirname ) ) + strlen( basename( $plugin_dirname ) ) ) );
			// get the dependency absolute path.
			$dependency_path = $plugin_dirname . $dependency_path_relative_to_plugin_dirname;
			// assert the file exists.
			$this->assertFileExists( $dependency_path, "The file {$handle} does not exist" );
		}
	}

	/**
	 * Make sure that every style actually points to an existing file
	 *
	 * @return void
	 */
	function test_styles_exist() {
		global $wp_styles;

		// Get plugin absolute path.
		$plugin_dirname = dirname( dirname( __FILE__ ) );

		// get handles that attempted to register.
		$styles = BU_Javascript_Library::$styles;

		// loop through handles.
		foreach ( $styles as $handle => $registered ) {
			$dependency = $wp_styles->registered[ $handle ];
			$dependency_path_relative_to_plugin_dirname = substr( $dependency->src, ( strpos( $dependency->src, basename( $plugin_dirname ) ) + strlen( basename( $plugin_dirname ) ) ) );
			$dependency_path = $plugin_dirname . $dependency_path_relative_to_plugin_dirname;
			// assert the file exists.
			$this->assertFileExists( $dependency_path, "The file {$handle} does not exist" );
		}
	}
}
