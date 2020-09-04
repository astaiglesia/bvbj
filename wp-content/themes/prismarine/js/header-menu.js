"use strict";

/**
 * Header Menu
 *
 * @package     bvbj
 * @subpackage  src
 * @author      Very - Andres Posada
 * @link        https://verypossible.com
 * @since       1.0.0
 */
document.addEventListener("DOMContentLoaded", function () {
  var isActive = false;
  jQuery('.js-menu').on('click', function () {
    if (isActive) {
      jQuery(this).removeClass('active');
      jQuery('body').removeClass('menu-open');
    } else {
      jQuery(this).addClass('active');
      jQuery('body').addClass('menu-open');
    }

    isActive = !isActive;
  });
});