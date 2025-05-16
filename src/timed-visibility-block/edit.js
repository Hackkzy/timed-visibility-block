/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import {
	Notice,
	PanelBody,
	SelectControl,
	TextControl,
	ToggleControl,
} from '@wordpress/components';

/**
 * Local dependencies
 */
import DateTimeSelector from './Components/DateTimeSelector';

/**
 * Editor Styles
 */
import './editor.scss';

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
					title={__('Schedule', 'timed-visibility-block')}
					initialOpen={true}
				>
					<ToggleControl
						__nextHasNoMarginBottom
						label={__(
							'Daily Schedule (Time Only)',
							'timed-visibility-block'
						)}
						help={__(
							'Enable to set a recurring daily schedule without specific dates',
							'timed-visibility-block'
						)}
						checked={timeOnly}
						onChange={(value) => {
							setAttributes({ timeOnly: value });
						}}
					/>
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
						placeholderText={
							visibleFrom
								? __('Forever', 'timed-visibility-block')
								: undefined
						}
					/>
					{visibleFrom > visibleUntil && (
						<Notice status="warning" isDismissible={false}>
							{__(
								'The visibility end time must be later than the start time to work correctly.',
								'timed-visibility-block'
							)}
						</Notice>
					)}
					{timeOnly && visibleFrom && !visibleUntil && (
						<Notice status="warning" isDismissible={false}>
							{__(
								'To ensure proper functionality, either specify an end time or disable "Daily Schedule (Time Only)".',
								'timed-visibility-block'
							)}
						</Notice>
					)}
				</PanelBody>
				<PanelBody
					title={__('Display Behavior', 'timed-visibility-block')}
					initialOpen={true}
				>
					<SelectControl
						label={__('Visibility Type', 'timed-visibility-block')}
						help={__(
							'Choose whether to show or hide content during your specified time period',
							'timed-visibility-block'
						)}
						value={visibilityType}
						options={[
							{
								label: __(
									'Display Content',
									'timed-visibility-block'
								),
								value: 'show',
							},
							{
								label: __(
									'Hide Content',
									'timed-visibility-block'
								),
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
						label={__('Alternative Text', 'timed-visibility-block')}
						help={__(
							"Control what visitors see when your content isn't live — leave it blank to show nothing at all.",
							'timed-visibility-block'
						)}
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
