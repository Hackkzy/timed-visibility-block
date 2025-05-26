/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { getSettings as getDateSettings, format } from '@wordpress/date';
import {
	Button,
	BaseControl,
	DateTimePicker,
	Popover,
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { closeSmall } from '@wordpress/icons';

export default function DateTimeSelector({
	label,
	currentDate,
	isCompact,
	onChange,
	placeholderText = __('Pick Date & Time', 'timed-visibility-block'),
	...additionalProps
}) {
	const [pickerOpen, setPickerOpen] = useState(false);

	const dateSettings = getDateSettings();
	const is12Hour = /a(?!\\)/i.test(
		dateSettings.formats.time
			.toLowerCase() // Test only for the lower case "a".
			.replace(/\\\\/g, '') // Replace "//" with empty strings.
			.split('')
			.reverse()
			.join('') // Reverse the string and test for "a" not followed by a slash.
	);

	const datePickerProps = {
		startOfWeek: dateSettings.l10n.startOfWeek,
		currentDate: currentDate,
		__nextRemoveHelpButton: true,
		__nextRemoveResetButton: true,
		is12Hour,
		onChange,
		...additionalProps,
	};

	const datetimeformat = isCompact
		? dateSettings.formats.time || 'g:i a' // Only Time
		: dateSettings.formats.datetime || 'F j, Y g:i a'; // Full Date and Time

	const dateTimeDisplay = currentDate
		? format(datetimeformat, currentDate)
		: placeholderText;

	return (
		<BaseControl
			label={label || ''}
			help={__(
				"The time shown is based on the site's timezone. Please choose the date and time accordingly.",
				'timed-visibility-block'
			)}
			__nextHasNoMarginBottom
		>
			<div className="tvb-date-time__field">
				<Button
					className="tvb-date-time__button"
					title={__('Pick date/time', 'timed-visibility-block')}
					onClick={() => setPickerOpen(true)}
					variant="link"
				>
					<span>{dateTimeDisplay}</span>
				</Button>

				{currentDate && (
					<Button
						icon={closeSmall}
						className="tvb-date-time__clear-button"
						title={__('Clear date/time', 'timed-visibility-block')}
						onClick={() => {
							onChange(null);
							setPickerOpen(false);
						}}
						size="small"
					/>
				)}
			</div>

			{pickerOpen && (
				<Popover
					className="tvb-date-time__popover"
					focusOnMount={true}
					onClose={() => setPickerOpen(false)}
					placement={'left-start'}
					offset={36}
					expandOnMobile={true}
				>
					<div className="tvb-date-time__popover-header">
						<h2>{label}</h2>
						<Button
							label={__('Close', 'timed-visibility-block')}
							onClick={() => setPickerOpen(false)}
							icon={closeSmall}
							size="small"
						/>
					</div>
					<DateTimePicker {...datePickerProps} />
				</Popover>
			)}
		</BaseControl>
	);
}
