/**
 * Press - View more
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	const pressList = document.querySelector("#pressList");
	const items = Array.from(pressList.querySelectorAll(".post"));
	const loadMore = document.getElementById("loadMore");
	const maxItems = 12;
	const loadItems = 3;
	const hiddenClass = "hiddenPost";

	items.forEach((item, index) => {
		if (index > maxItems - 1) {
			item.classList.add(hiddenClass);
		}
	});

	loadMore.addEventListener("click", () => {
		[].forEach.call(document.querySelectorAll(`.${hiddenClass}`), (item, index) => {
			if (index < loadItems) {
				item.classList.remove(hiddenClass);
			}

			if (document.querySelectorAll(`.${hiddenClass}`).length === 0) {
				loadMore.style.display = "none";
			}
		});
	});
});
