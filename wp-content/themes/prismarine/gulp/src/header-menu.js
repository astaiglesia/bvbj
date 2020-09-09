/**
 * Header Menu
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	let isActive = false;
	const btnClick = document.getElementsByClassName("toggleMenu")[0];
	const bodyEl = document.getElementsByTagName("BODY")[0];
	btnClick.addEventListener("click", function setActive() {
		if (isActive) {
			btnClick.classList.remove("--active");
			bodyEl.classList.remove("--menu-open");
		} else {
			btnClick.classList.add("--active");
			bodyEl.classList.add("--menu-open");
		}
		isActive = !isActive;
	});
});
