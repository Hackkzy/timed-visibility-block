=== Timed Visibility Block ===
Contributors:      hackkzy404
Tags:              visibility, schedule content, timed content, content expiration, block
Requires at least: 6.5
Tested up to:      6.8.1
Requires PHP:      7.4
Stable tag:        1.0.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Control when your content shines—perfect for time-sensitive promotions and special events!

== Description ==
Timed Visibility Block is a powerful wrapper block for the Block Editor (Gutenberg) that allows you to **schedule when content is shown or hidden** based on various time-based rules.

**Key Features:**
- **Date-Time Range Visibility:** Show or hide content between a start and end date-time.
- **Daily Schedule Mode:** Repeat visibility daily between a set time range (e.g., from 9:00 AM to 5:00 PM every day).
- **Show/Hide Mode:** Decide whether to **show or hide content** during the selected schedule (inverted logic support).
- **Fallback Message:** Optionally display a custom message (e.g., “This content is no longer available”) when the content is hidden.
- **No Output on Expiry:**  When hidden, content is **not rendered at all**, keeping the HTML clean and optimized.

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/timed-visibility-block` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==
= Can I put any kind of block inside the Timed Visibility Block? =
Yes, this block is a wrapper block that supports nesting any type of blocks inside.

= What happens to the content when it’s hidden? Is it just visually hidden or completely removed? =
The content is completely removed from the front-end HTML and will not be rendered, ensuring it’s not visible or accessible.

= Can I show a fallback message instead of hiding the content completely? =
Yes, you can set a custom fallback message to display in place of the content when it’s hidden.

= What time zone does the scheduling use? =
The scheduling uses the WordPress site’s configured time zone.

== Changelog ==
= 1.0.0 =
* Release
