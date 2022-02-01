import { gsap } from 'gsap'
import { breakpoints, homeAnimationDelay, homeAnimationDuration } from '../lib/constants'
class header {
  constructor(el) {
    this.el = el
    this.pageY = window.pageYOffset
    this.scrollDirection = null
    this.nav = this.el.querySelector('.main-nav')
    this.logoMain = this.el.querySelector('.logo--main')
    this.logoScrolled = this.el.querySelector('.logo--scrolled')
    this.mobileTrigger =  this.el.querySelector('.mobile-nav__trigger')
    this.mobileNav =  this.el.querySelector('.mobile-nav')

    this.init()
  }

  init() {
    gsap.to(this.nav, {duration: homeAnimationDuration, top: 0, opacity: 1, delay: homeAnimationDelay})

    // set up logo transition and event handler
    this.handleDesktopScroll()
    this.logoMain.classList.add('transition-all', 'duration-500')
    this.logoScrolled.classList.add('transition-all', 'duration-500')

    window.addEventListener('scroll', () => this.handleDesktopScroll())
    this.mobileTrigger.addEventListener('click', () => this.handleMobileTrigger())
    window.addEventListener('resize', () => this.handleResize())
  }

  setScrollDirection() {
    this.scrollDirection = window.pageYOffset > this.pageY ? 'down' : 'up'
    this.pageY = window.pageYOffset
  }

  handleDesktopScroll() {
    this.setScrollDirection() //set this first
    if(window.pageYOffset > 250 || window.innerWidth < breakpoints.md) {
      this.logoMain.classList.remove('opacity-100')
      this.logoMain.classList.add('opacity-0')
      this.logoScrolled.classList.remove('opacity-0')
      this.logoScrolled.classList.add('opacity-100')
    } else {
      this.logoMain.classList.remove('opacity-0')
      this.logoMain.classList.add('opacity-100')
      this.logoScrolled.classList.remove('opacity-100')
      this.logoScrolled.classList.add('opacity-0')
    }

    if(this.scrollDirection === 'down') {}
  }

  handleMobileTrigger(closeAll = false) {
    if(this.mobileNav.classList.contains('active') || closeAll) {
      // close
      this.mobileTrigger.classList.remove('active')
      this.mobileNav.classList.add('opacity-0', 'pointer-events-none')
      this.mobileNav.classList.remove('active', 'opacity-100')
    } else {
      // open
      this.mobileTrigger.classList.add('active')
      this.mobileNav.classList.add('active', 'opacity-100')
      this.mobileNav.classList.remove('hidden', 'opacity-0', 'pointer-events-none')
    }
  }

  handleResize() {
    this.handleMobileTrigger(true)
  }

  openMenu() {
    this.trigger.classList.add('active')
    this.el.classList.add('menu-active')
  }

  closeMenu() {
    this.trigger.classList.remove('active')
    this.el.classList.remove('menu-active')
  }
}

export default function (el) {
  new header(el)
}