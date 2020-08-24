"use strict";

/* global wp, jQuery */

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  }); // Header text color.

  wp.customize('header_textcolor', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.site-title, .site-description').css({
          clip: 'rect(1px, 1px, 1px, 1px)',
          position: 'absolute'
        });
      } else {
        $('.site-title, .site-description').css({
          clip: 'auto',
          position: 'relative'
        });
        $('.site-title a, .site-description').css({
          color: to
        });
      }
    });
  });
})(jQuery);

/* @Concat Next -> */

"use strict";

/**
 * Fadein load
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Engineer Esteban Rocha
 * @link        https://verypossible.com
 * @since       1.0.0
 */
document.addEventListener("DOMContentLoaded", function () {
  // Cache html element Nodes
  var fadeMeIn = document.querySelectorAll(".fadeIntoView");
  /**
   * λ isScrolled() ~ Iterates all matching Nodes and modifies classList.
   *
   * @return  {undefined} undefined
   */

  var isScrolled = function isScrolled() {
    return fadeMeIn.forEach(function (el) {
      return el.classList.add("in-view");
    });
  };
  /**
   * λ getScrollY() ~ Gets window.scrollY value.
   *
   * @return  {number} window.scrollY
   */


  var getScrollY = function getScrollY() {
    return window.scrollY;
  };
  /**
   * λ scrolledPage() ~ Determines if viewport is scrolled.
   *
   * @return  {boolean} boolean
   */


  var scrolledPage = function scrolledPage() {
    return getScrollY() >= 10;
  };
  /**
   * λ isVisible() ~ Returns true if the element is visible on the viewport.
   *
   * @param    {object} ele
   * @return   {boolean} boolean
   */


  var isVisible = function isVisible(ele) {
    var _ele$getBoundingClien = ele.getBoundingClientRect(),
        top = _ele$getBoundingClien.top,
        bottom = _ele$getBoundingClien.bottom;

    var vHeight = window.innerHeight || document.documentElement.clientHeight;
    return (top > 0 || bottom > 0) && top < vHeight + 100;
  };
  /**
   * λ unFadeToView() ~ Modifies classList for all fadeIntoView NodeList and triggers,
   * CSS transitions.
   *
   * @param       {object} j
   * @return      {undefined} undefined
   */


  var unFadeToView = function unFadeToView(j) {
    return j.forEach(function (el) {
      return isVisible(el) && el.classList.add("in-view");
    });
  }; // Trigger in-view state for visible element Nodes


  unFadeToView(fadeMeIn); // Invoke isScrolled() if scrolledPage() == truthy

  scrolledPage() && isScrolled(); // Add event for scroll if scrolledPage() == truthy

  !scrolledPage() && window.addEventListener("scroll", function x() {
    unFadeToView(fadeMeIn);
  });
  return null;
});

/* @Concat Next -> */

"use strict";

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isIe = /(trident|msie)/i.test(navigator.userAgent);

  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
          element;

      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }

      element = document.getElementById(id);

      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }

        element.focus();
      }
    }, false);
  }
})();

/* @Concat Next -> */

"use strict";

/**
 * Slick Carousel
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */
document.addEventListener("DOMContentLoaded", function () {
  jQuery('.carouselrrr').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 2,
    dots: true
  });
});