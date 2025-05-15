<?php
/**
 * Plugin Name:       Timed Visibility Block
 * Description:       Control when your content shines—perfect for time-sensitive promotions and special events!
 * Version:           1.0.0
 * Requires at least: 6.7
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
 * Registers the Timed Visibility Block using the metadata loaded from the `block.json` file.
 */
function timed_vblck_block_init() {
	register_block_type( __DIR__ . '/build/timed-visibility-block' );
}
add_action( 'init', 'timed_vblck_block_init' );

require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'app/includes/common-functions.php';
