<?php
/**
 * Renders the Timed Visibility Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 *
 * @package TimedVisibilityBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Timed Visibility Block – hello from a dynamic block!', 'timed-visibility-block' ); ?>
</p>
