/**
 * Mailchimp script
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	let viewportWidth = window.innerWidth || document.documentElement.clientWidth;
	if (viewportWidth < 480) {
		document.getElementById("submitMc").value = ">";
	}

	window.addEventListener(
		"resize",
		() => {
			viewportWidth = window.innerWidth || document.documentElement.clientWidth;
			if (viewportWidth < 480) {
				document.getElementById("submitMc").value = ">";
			} else {
				document.getElementById("submitMc").value = "Submit";
			}
		},
		false
	);
});
