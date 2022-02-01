// import { getCookie, setCookie, checkCookie } from '../lib/utils'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { homeAnimationCookie, homeAnimationDuration, homeAnimationDelay } from '../lib/constants'

class Home {
  constructor(el) {
    gsap.registerPlugin(ScrollTrigger)
    this.heroAnimation = false
    this.cname = 'hero'
    this.button = el.querySelector('.modal__accept')
    this.date = new Date()
    this.date.setTime(this.date.getTime() + (30 * 24 * 60 * 60))
    this.heroText = el.querySelectorAll('.hero-animated-text')
    this.videoWrap = el.querySelector('.hero-video')
    this.videoOverlay = el.querySelector('.hero-video__overlay')
    this.scrollSection = el.querySelector('.scroll-over')
    this.scrollFrame = el.querySelector('.scroll-over__frame')
    this.scrollVideo = el.querySelector('.scroll-over__video')
    this.scrollLeftCurtain = el.querySelector('.scroll-over__curtain--left')
    this.scrollRightCurtain = el.querySelector('.scroll-over__curtain--right')
    this.scrollBackground = el.querySelector('.scroll-over__bg')

    // panel panels
    this.panelButtons = el.querySelectorAll('.panel__btn')
    this.panelContents = el.querySelectorAll('.panel__content')

    setTimeout(() => {
      this.init()
    }, 350)
  }

  init() {
    const url = `${window.location.protocol}//${window.location.host}/wp-json/insight/v1/get-cookie?cname=${this.cname}`
    window.fetch(url)
      .then(res => res.json())
      .then(data => {
        data = JSON.parse(data)

        if(data.response === 'true') {
          this.setupScrollTrigger()
        } else {
          this.buildHeroAnimation()
          this.heroAnimation.play()
          this.setupScrollTrigger()
          this.setCookie()
        }
      })

    // set up overlay for video on scroll
    const vidOverlayTL = gsap.timeline({
      scrollTrigger: {
        trigger: this.videoOverlay,
        start: 'bottom 40%',
        scrub: true
      }
    })

    vidOverlayTL.to(this.videoOverlay, {
      opacity: 1
    })

    // panel content in scrollover area
    this.panelButtons.forEach(btn => btn.addEventListener('click', () => this.setActivePanel(btn)))
  }

  setCookie() {
    const url = `${window.location.protocol}//${window.location.host}/wp-json/insight/v1/set-cookie?cname=${this.cname}&cval=true`
    window.fetch(url)
      .then(response => response.json())
      .then(data => console.log(JSON.parse(data)))
  }

  buildHeroAnimation() {
    this.heroAnimation = gsap.timeline({delay: homeAnimationDelay, paused: true, onComplete: () => {
      this.heroText[0].classList.add('hidden')
    }})
    
    this.heroAnimation.to(
      this.videoWrap,
      {
        height: '90vh',
        duration: homeAnimationDuration,
        onComplete: () => {
          this.setupScrollTrigger()
        }
      },
      'main'
    )
    gsap.set(this.heroText[1], {y: 300}, 'main')
    this.heroAnimation.to(this.heroText[0], {opacity: 0, y: -300, duration: homeAnimationDuration}, '<main')
    this.heroAnimation.to(this.heroText[1], {opacity: 1, y: 0, duration: homeAnimationDuration}, '<main')
  }

  setupScrollTrigger() {
    const scrollOverTL = gsap.timeline({
      scrollTrigger: {
        trigger: this.scrollFrame,
        endTrigger: this.scrollSection.querySelector('.scroll-over__content'),
        // pinSpacing: false,
        scrub: true,
        start: 'top bottom',
        end: 'top 120px',
        // markers: true,
      }
    })
    .to(this.scrollLeftCurtain, {width: 0}, 'A')
    .to(this.scrollRightCurtain, {width: 0}, 'A')
    .to(this.scrollBackground, {opacity: 0.75}, 'B')

    ScrollTrigger.create({
      trigger: this.scrollFrame,
      pin: true,
      pinSpacing: false,
      scrub: true,
      start: 'top-=120px',
      end: 'max',
    })

    ScrollTrigger.create({
      trigger: this.scrollSection.querySelector('.scroll-over__content'),
      pin: true,
      scrub: true,
      // pinSpacing: false,
      start: 'top-=150px',
      end: 'bottom top',
      // markers: true
    })

    // play video once user is ready
    ScrollTrigger.create({
      trigger: this.scrollSection,
      pinSpacing: false,
      start: 'top 80%',
      onEnter: () => {
        this.scrollVideo.play()
      }
    })
  }

  setActivePanel(activeBtn) {
    // deactivate all buttons
    this.panelButtons.forEach(btn => {
      btn.classList.remove('border-b-2', 'border-orange', 'text-white')
      btn.classList.add('text-cadet-blue')
    })
    
    // activate clicked button
    activeBtn.classList.remove('text-cadet-blue')
    activeBtn.classList.add('border-b-2', 'border-orange', 'text-white')
  
    // activate selected content
    this.panelContents.forEach(cnt => {
      if(cnt.getAttribute('id') === activeBtn.dataset.panel) {
        cnt.classList.remove('hidden')
      } else {
        cnt.classList.add('hidden')
      }
    })
  }
}

export default el => {
  new Home(el)
}