/**
 * Nomination form
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	const targetInput = document.querySelectorAll(".wpcf7-list-item input");
	[].forEach.call(targetInput, inputForm => {
		const div = document.createElement("div");
		div.className = "radioIndicator";
		inputForm.parentNode.insertBefore(div, inputForm.nextSibling);
	});
});
