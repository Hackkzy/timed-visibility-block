/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Local dependencies
 */
import DateTimeSelector from './Components/DateTimeSelector';

export default function Edit({ attributes, setAttributes }) {
	const {
		visibleFrom,
		visibleUntil,
		timeOnly,
		fallbackMessage,
		visibilityType,
	} = attributes;

	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps);
	return (
		<>
			<div {...innerBlocksProps} />
		</>
	);
}
