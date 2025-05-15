<?php
/**
 * Common utility functions.
 *
 * @package TimedVisibilityBlock
 */

/**
 * Checks if the current time is within the time range.
 *
 * @param string $start_timestamp  Start datetime string.
 * @param string $end_timestamp End datetime string.
 *
 * @return bool True if current time within range, else false.
 */
function timed_vblck_is_datetime_within_range( $start_timestamp = '', $end_timestamp = '' ) {

	// Convert datetime strings to timestamps.
	$start_timestamp = ! empty( $start_timestamp ) ? strtotime( $start_timestamp ) : false;
	$end_timestamp   = ! empty( $end_timestamp ) ? strtotime( $end_timestamp ) : false;

	// If start time is not valid.
	if ( false === $start_timestamp ) {
		return true;
	}

	// Get current time.
	$current_timestamp = current_time( 'timestamp' ); // phpcs:ignore WordPress.DateTime.CurrentTimeTimestamp.Requested

	if ( $current_timestamp < $start_timestamp ) {
		return false;
	}

	if ( false === $end_timestamp || $current_timestamp <= $end_timestamp ) {
		return true;
	}

	// Otherwise, not within range.
	return false;
}
