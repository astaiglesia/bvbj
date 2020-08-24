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