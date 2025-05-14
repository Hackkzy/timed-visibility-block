/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	PanelBody,
	SelectControl,
	TextControl,
	ToggleControl,
} from '@wordpress/components';
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
			{/* Sidebar Settings */}
			<InspectorControls>
				<PanelBody
					title={__('Date & Time Settings', 'timed-visibility-block')}
					initialOpen={true}
				>
					<DateTimeSelector
						label={__('Visible From', 'timed-visibility-block')}
						currentDate={visibleFrom}
						isCompact={timeOnly}
						onChange={(value) =>
							setAttributes({
								visibleFrom: value,
							})
						}
					/>
					<DateTimeSelector
						label={__('Visible Until', 'timed-visibility-block')}
						currentDate={visibleUntil}
						isCompact={timeOnly}
						onChange={(value) =>
							setAttributes({ visibleUntil: value })
						}
					/>
				</PanelBody>
				<PanelBody
					title={__('Customizations', 'timed-visibility-block')}
					initialOpen={true}
				>
					<SelectControl
						label={__('Visibility Type', 'timed-visibility-block')}
						value={visibilityType}
						options={[
							{
								label: __('Show', 'timed-visibility-block'),
								value: 'show',
							},
							{
								label: __('Hide', 'timed-visibility-block'),
								value: 'hide',
							},
						]}
						onChange={(value) =>
							setAttributes({ visibilityType: value })
						}
						__next40pxDefaultSize
						__nextHasNoMarginBottom
					/>
					<TextControl
						label={__('Fallback Message', 'timed-visibility-block')}
						value={fallbackMessage}
						onChange={(value) =>
							setAttributes({ fallbackMessage: value })
						}
						__next40pxDefaultSize
						__nextHasNoMarginBottom
					/>
				</PanelBody>
			</InspectorControls>
			<div {...innerBlocksProps} />
		</>
	);
}
