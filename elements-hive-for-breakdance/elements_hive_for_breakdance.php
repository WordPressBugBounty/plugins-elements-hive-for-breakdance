<?php
/**
 * @package     ElementsHiveForBreakdance
 * @author      Elements Hive
 * @copyright   2025 RELYzIT SRL
 * @license     GPLv3+
 *
 * @wordpress-plugin
 * Plugin Name: Elements Hive For Breakdance
 * Plugin URI: https://wordpress.org/plugins/elements-hive-for-breakdance
 * Description: The most unique, and creative elements, and extensions library for the Breakdance website builder
 * Author: Elements Hive
 * Author URI: https://elementshive.com/
 * License: GPLv3+
 * Text Domain: elementshive
 * Domain Path: /languages/
 * Version: 1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$breakdance_file = WP_PLUGIN_DIR . '/breakdance/plugin.php';
$breakdance_exists = file_exists( $breakdance_file );

if ( ! $breakdance_exists || ! is_plugin_active( 'breakdance/plugin.php' ) ) {
	deactivate_plugins( plugin_basename( __FILE__ ) );

	// Add admin notice
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Elements Hive requires Breakdance to function properly. Elements Hive has been deactivated. Please install and activate Breakdance, then reactivate Elements Hive.</p></div>';
	});

	// If this is a plugin activation request, stop it
	if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		unset( $_GET['activate'] );
	}

	return false;
}


if ( ! class_exists( 'EHForBreakdance' ) ) {

	class EHForBreakdance {

		public function __construct() {

			define( 'ELEMENTS_HIVE_DIR', plugin_dir_url( __FILE__ ) );

			define( 'ELEMENTS_HIVE_ASSETS_DIR', plugin_dir_url( __FILE__ ) . 'assets/' );
		}

		/**
		 * Initialize the plugin
		 *
		 * @return void
		 */
		public function initialize() {

			add_action( 'breakdance_loaded', function () {
				$this->breakdance_loaded_handler();
			}, 9 );

			// $this->appsero_init_tracker_elements_hive_for_breakdance();

			add_action( 'init', function () {
				$this->appsero_init_tracker_elements_hive_for_breakdance();
			}, 10 );
		}

		/**
		 * Initialize the plugin tracker
		 *
		 * @return void
		 */
		private function appsero_init_tracker_elements_hive_for_breakdance() {

			if ( ! class_exists( 'Appsero\Client' ) ) {
				require_once __DIR__ . '/includes/lib/appsero/src/Client.php';
			}

			$client = new Appsero\Client( '7e7ade80-f6ed-4b5a-8ddc-484611ef8658', 'Elements Hive for Breakdance', __FILE__ );

			// Active insights
			$client->insights()->init();
		}

		/**
		 * Register save locations with Breakdance
		 *
		 * @return void
		 */
		private function register_save_locations() {

			\Breakdance\ElementStudio\registerSaveLocation(
				\Breakdance\Util\getDirectoryPathRelativeToPluginFolder( __DIR__ ) . '/elements',
				'ElementsHiveForBreakdance',
				'element',
				'ElementsHive Elements',
				false
			);

			\Breakdance\ElementStudio\registerSaveLocation(
				\Breakdance\Util\getDirectoryPathRelativeToPluginFolder( __DIR__ ) . '/macros',
				'ElementsHiveForBreakdance',
				'macro',
				'ElementsHive Macros',
				false,
			);

			\Breakdance\ElementStudio\registerSaveLocation(
				\Breakdance\Util\getDirectoryPathRelativeToPluginFolder( __DIR__ ) . '/presets',
				'ElementsHiveForBreakdance',
				'preset',
				'ElementsHive Presets',
				false,
			);
		}

		/**
		 * Register Elements Hive categories with Breakdance
		 *
		 * @return void
		 */
		private function register_plugin_categories() {

			\Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory( 'elements_hive', 'Elements Hive' );
		}

		private function breakdance_loaded_handler() {

			$this->register_save_locations();

			$this->register_plugin_categories();

			require_once __DIR__ . '/extensions/base.php';

			require_once __DIR__ . '/includes/twig_functions.php';

			require_once __DIR__ . '/includes/design-library/base.php';

			require_once __DIR__ . '/includes/builder-tricks/base.php';

			require_once __DIR__ . '/includes/cloudflare-turnstile/base.php';

			require_once __DIR__ . '/admin/base.php';
		}
	}

	$EhInstance = new EHForBreakdance();
	$EhInstance->initialize();
}
