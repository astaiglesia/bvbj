import Tweezer from 'tweezer.js'

const curry = (f, ...args) => args.length >= f.length ? f(...args) : curry.bind(this, f, ...args)

const matchHeight = (items) => {
  let height = 0
  // get the highest height value
  items.forEach(function (item) {
    height = (height < item.offsetHeight) ? item.offsetHeight : height
  })

  // set the heights to the set value
  items.forEach((item) => {
    item.style.height = `${height}px`
  })
}

const doesSupportObjectFit = () => {
  const i = document.createElement('img')
  return ('objectFit' in i.style)
}

const getUrlParameter = sParam => {
  const sPageURL = window.location.search.substring(1);
  const sURLVariables = sPageURL.split('&');
  for (let i = 0; i < sURLVariables.length; i++) {
    let sParameterName = sURLVariables[i].split('=');
    if (sParameterName[0] == sParam) {
      return sParameterName[1];
    }
  }
  return false;
}

const formatDate = str => {
  // Remove ordinals.
  const str2 = str.replace(/(\d+)(st|nd|rd|th)/, '$1');
  const date = new Date(str2);
  const monthNames = [
    'January', 'February', 'March',
    'April', 'May', 'June', 'July',
    'August', 'September', 'October',
    'November', 'December',
  ];
  const day = date.getDate();
  const monthIndex = date.getMonth();
  const year = date.getFullYear();
  return `${monthNames[monthIndex]} ${day}, ${year}`;
}

const isIOS = () => {
  return [
    'iPad Simulator',
    'iPhone Simulator',
    'iPod Simulator',
    'iPad',
    'iPhone',
    'iPod'
  ].includes(navigator.platform)
    // iPad on iOS 13 detection
    || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
}


const setCookie = (cname, cvalue, exdays = 30) => {
  var d = new Date()
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
  var expires = "expires=" + d.toUTCString()
  document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

const getCookie = cname => {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

const checkCookie = cname => {
  const cvalue = getCookie(cname);
  return (cvalue && cvalue != '') ? true : false;
}

const getComputedStyle = (el, style) => {
  return window.getComputedStyle(el, null).getPropertyValue(style)
}

const getParent = (elem, selector) => {
  for (; elem && elem !== document; elem = elem.parentNode) {
    if (selector) {
      if (elem.matches(selector)) {
        return elem
      }
      continue
    }
  }
}

const getParents = (elem, selector) => {
  // Set up a parent array
  var parents = []

  // Push each parent element to the array
  for (; elem && elem !== document; elem = elem.parentNode) {
    if (selector) {
      if (elem.matches(selector)) {
        parents.push(elem)
      }
      continue
    }
  }
  return parents
}

const getSibling = (elem, selector) => {
  return elem.parentNode.querySelector(selector)
}

const getWidth = () => {
  if (typeof window.innerWidth != 'undefined') {
    return window.innerWidth;
  }
  else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0) {
    return document.documentElement.clientWidth;
  }
  else {
    return document.getElementsByTagName('body')[0].clientWidth;
  }
}

const toArray = (nodes) => {
  return Array.prototype.slice.call(nodes)
}

const scrollTo = (location, opts = {}, offset = 0, tickCallback = null, completedCallback = null) => {
  const config = {
    start: opts.start ? opts.start : window.pageYOffset,
    end: opts.end ? opts.end : location.getBoundingClientRect().top + window.pageYOffset - offset,
    duration: opts.duration ? opts.duration : 750,
    easing: opts.easing ? opts.easing : (t, b, c, d) => {
      if ((t/=d/2) < 1) return c/2*t*t + b
      return -c/2 * ((--t)*(t-2) - 1) + b
    }
  }
  const scroller = new Tweezer(config)
    .on('tick', v => {
      if(tickCallback) tickCallback()
      window.scrollTo(0, v)
    })
    .on('done', () => {
      if(completedCallback) completedCallback()
    })
    
  scroller.begin()
}

const getPosition = el => {
  let xPosition = 0;
  let yPosition = 0;

  while (el) {
    xPosition += (el.offsetLeft - el.scrollLeft + el.clientLeft);
    yPosition += (el.offsetTop - el.scrollTop + el.clientTop);
    el = el.offsetParent;
  }

  return { x: xPosition, y: yPosition };
}

const isAboveFold = el => {
  const rect = el.getBoundingClientRect()

  return rect.top < window.innerHeight
}

const isInView = el => {
  const rect = el.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}

const isInVerticalView = el => {
  const rect = el.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
  )
}

const isScrolledPast = (el, useParent = false) => {
  return useParent ? window.pageYOffset > (el.offsetParent.offsetTop + el.offsetHeight) : window.pageYOffset > (el.offsetTop + el.offsetHeight)
}



const pipe = (...funcs) => function (val) { return funcs.reduce((acc, f) => f.apply(this, [acc]), val) }

export {
  curry,
  doesSupportObjectFit,
  getCookie,
  setCookie,
  checkCookie,
  formatDate,
  getComputedStyle,
  getWidth,
  getParent,
  getParents,
  getPosition,
  getSibling,
  getUrlParameter,
  isAboveFold,
  isInView,
  isInVerticalView,
  isIOS,
  isScrolledPast,
  matchHeight,
  pipe,
  scrollTo,
  toArray
}

