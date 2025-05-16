<?php
/**
 * Plugin Name:       Timed Visibility Block
 * Description:       Control when your content shines. Perfect for announcements, promotions, and time-sensitive information!
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Hackkzy
 * Author URI:        https://github.com/Hackkzy
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       timed-visibility-block
 *
 * @package Timed_Visibility_Block
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Defining Constants.
 *
 * @package Timed_Visibility_Block
 */
if ( ! defined( 'TIMED_VBLCK_VERSION' ) ) {
	/**
	 * The version of the plugin.
	 */
	define( 'TIMED_VBLCK_VERSION', '1.0.0' );
}

if ( ! defined( 'TIMED_VBLCK_PATH' ) ) {
	/**
	 *  The server file system path to the plugin directory.
	 */
	define( 'TIMED_VBLCK_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'TIMED_VBLCK_URL' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'TIMED_VBLCK_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'TIMED_VBLCK_BASE_NAME' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'TIMED_VBLCK_BASE_NAME', plugin_basename( __FILE__ ) );
}

/**
 * Sets translated strings for a script.
 *
 * @return void
 */
function timed_vblck_script_translations() {
	wp_set_script_translations( 'timed-vblck-timed-visibility-block-editor-script', 'timed-visibility-block' );
}
add_action( 'init', 'timed_vblck_script_translations' );

/**
 * Apply translation file as per WP language.
 */
function timed_vblck_text_domain_loader() {

	// Get mo file as per current locale.
	$mofile = trailingslashit( TIMED_VBLCK_PATH ) . 'languages/' . get_locale() . '.mo';

	// If file does not exists, then apply default mo.
	if ( ! file_exists( $mofile ) ) {
		$mofile = trailingslashit( TIMED_VBLCK_PATH ) . 'languages/default.mo';
	}

	load_textdomain( 'timed-visibility-block', $mofile );
}
add_action( 'plugins_loaded', 'timed_vblck_text_domain_loader' );

/**
 * Registers the Timed Visibility Block using the metadata loaded from the `block.json` file.
 */
function timed_vblck_block_init() {
	register_block_type( __DIR__ . '/build/timed-visibility-block' );
}
add_action( 'init', 'timed_vblck_block_init' );

require_once trailingslashit( TIMED_VBLCK_PATH ) . 'app/includes/common-functions.php';
