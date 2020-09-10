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
			slidesToScroll: 5,
			dots: true,
			lazyLoad: "ondemand",
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						arrows: false,
						slidesToShow: 4,
					},
				},
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						slidesToShow: 3,
					},
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						centerMode: true,
						centerPadding: "60px",
						slidesToShow: 1,
					},
				},
			],
		});
	})(jQuery)
);
