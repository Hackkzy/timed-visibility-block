/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			{ __( 'Timed Visibility Block – hello from the editor!', 'timed-visibility-block' ) }
		</p>
	);
}
