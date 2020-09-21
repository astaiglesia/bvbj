/**
 * Thank You page
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	document.addEventListener(
		"wpcf7mailsent",
		() => {
			window.location.href = "/thank-you";
		},
		false
	);
});
