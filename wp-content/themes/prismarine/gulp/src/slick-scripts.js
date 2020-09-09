/**
 * Slick Carousel
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */

document.addEventListener(
	"DOMContentLoaded",
	(function recipientsSlick($) {
		$(".carousel-r").slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 3,
			dots: true,
		});
	})(jQuery)
);
