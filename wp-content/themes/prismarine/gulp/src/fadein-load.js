/**
 * Fadein load
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Engineer Esteban Rocha
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
	// Cache html element Nodes
	const fadeMeIn = document.querySelectorAll(".fadeIntoView");

	/**
	 * λ isScrolled() ~ Iterates all matching Nodes and modifies classList.
	 *
	 * @return  {undefined} undefined
	 */
	const isScrolled = () => fadeMeIn.forEach(el => el.classList.add("in-view"));

	/**
	 * λ getScrollY() ~ Gets window.scrollY value.
	 *
	 * @return  {number} window.scrollY
	 */
	const getScrollY = () => window.scrollY;

	/**
	 * λ scrolledPage() ~ Determines if viewport is scrolled.
	 *
	 * @return  {boolean} boolean
	 */
	const scrolledPage = () => getScrollY() >= 10;

	/**
	 * λ isVisible() ~ Returns true if the element is visible on the viewport.
	 *
	 * @param    {object} ele
	 * @return   {boolean} boolean
	 */
	const isVisible = ele => {
		const { top, bottom } = ele.getBoundingClientRect();
		const vHeight = window.innerHeight || document.documentElement.clientHeight;
		return (top > 0 || bottom > 0) && top < vHeight + 100;
	};

	/**
	 * λ unFadeToView() ~ Modifies classList for all fadeIntoView NodeList and triggers,
	 * CSS transitions.
	 *
	 * @param       {object} j
	 * @return      {undefined} undefined
	 */
	const unFadeToView = j => j.forEach(el => isVisible(el) && el.classList.add("in-view"));

	// Trigger in-view state for visible element Nodes
	unFadeToView(fadeMeIn);

	// Invoke isScrolled() if scrolledPage() == truthy
	scrolledPage() && isScrolled();

	// Add event for scroll if scrolledPage() == truthy
	// eslint-disable-next-line
	!scrolledPage() &&
		window.addEventListener("scroll", function x() {
			unFadeToView(fadeMeIn);
		});

	return null;
});
