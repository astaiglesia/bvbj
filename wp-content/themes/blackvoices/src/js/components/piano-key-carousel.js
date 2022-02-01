import { gsap } from 'gsap'
import { Draggable } from 'gsap/Draggable'
import { getParent } from '../lib/utils'
import { breakpoints } from '../lib/constants'
class gsapCarousel {
  constructor(el) {
    gsap.registerPlugin(Draggable)
    this.el = el
    this.prevBtn = this.el.querySelector('.piano-key__button--prev')
    this.nextBtn = this.el.querySelector('.piano-key__button--next')
    this.subsliderInterval = null
    this.scrollToSlideRatio = 1
    this.slides = el.querySelectorAll('.carousel__card')
    this.slideContainer = this.el.querySelector('.piano-key-carousel__slide-container')
    this.track = this.el.querySelector('.piano-key-carousel__progress-track')
    this.slider = null
    this.handle = this.el.querySelector('.piano-key-carousel__progress-handle')
    this.subslideTimeline = null

    this.init()
  }

  init() {
    this.setUpScrollbar()
    this.setUpSlider()
    this.setRatio()
    this.handleButtonVisibility()

    window.addEventListener('resize', () => {
      this.closeAllSlides()
      this.recalcParams()
    })

    this.nextBtn.addEventListener('click', () => {
      this.handleNextBtn(this)
    })

    this.prevBtn.addEventListener('click', () => {
      this.handlePrevBtn(this)
    })
  }

  setUpSlider() {
    const self = this
    // make slider draggable
    this.slider = Draggable.create(this.slideContainer, {
      type: 'x',
      bounds: {
        minX: this.getSlideContainerWidth() - this.getSliderWidth(),
        maxX: 0
      },
      zIndexBoost: false,
      onDrag: function() {
        self.updateScrollbarPosition(this.x)
      },
      onDragEnd: function() {
        self.handleButtonVisibility()
      }
    })
    
    gsap.set('.piano-key-carousel__progress-handle', {x: this.getScrollbarCenter()})

    // add click events
    this.slides.forEach(slide => {
      slide.addEventListener('click', () => {
        if(!slide.classList.contains('carousel__card--active')) {
          this.closeAllSlides()
          this.openSlide(slide)
        }
      })

      slide.querySelector('.carousel__card-close').addEventListener('click', () => {
        console.log('ok')
        this.closeSlide(slide)
      })
    })
  }

  setUpScrollbar() {
    const self = this
    this.setHandleSize()
    Draggable.create(this.handle, {
      type: 'x',
      bounds: this.track,
      onDrag: function() {
        self.updateSliderPosition(this.x)
      },
      onDragEnd: function() {
        self.handleButtonVisibility()
      }
    })

    gsap.set('.piano-key-carousel__slide-container', {x: this.getSlideContainerCenter()})
  }

  getSlideContainerWidth() {
    let width = 0
    const style = getParent(this.slideContainer, '.container').currentStyle || window.getComputedStyle(getParent(this.slideContainer, '.container'))
    width += getParent(this.slideContainer, '.container').offsetWidth - parseFloat(style.paddingLeft) - parseFloat(style.paddingRight)
    return width
  }

  getSliderWidth() {
    // ignore the hover state on inactive slides when calculating overall slider width
    let width = 0
    let minWidth = null
    let slideCount = 0
    this.slides.forEach(slide =>  {
      const style = slide.currentStyle || window.getComputedStyle(slide)
      if(slide.classList.contains('carousel__card--active')) {
        width += slide.offsetWidth + parseFloat(style.marginRight) + parseFloat(style.marginLeft)
      } else {
        slideCount++
        if (minWidth) {
          minWidth = (slide.offsetWidth + parseFloat(style.marginRight) + parseFloat(style.marginLeft) > minWidth) ? minWidth : slide.offsetWidth + parseFloat(style.marginRight) + parseFloat(style.marginLeft)
        } else {
          minWidth = slide.offsetWidth + parseFloat(style.marginRight) + parseFloat(style.marginLeft)
        }
      }
    })
    width += minWidth * slideCount

    return width
  }

  getSlideContainerCenter() {
    let xPos = 0
    xPos = (this.getSlideContainerWidth() - this.getSliderWidth()) /2
    return xPos
  }

  getScrollbarCenter() {
    let xPos = 0
    xPos = (this.track.offsetWidth/2) - (this.handle.offsetWidth/2)
    return xPos
  }

  updateSliderBounds() {
    Draggable.get(this.slideContainer).applyBounds({minX: this.getSlideContainerWidth() - this.getSliderWidth(), maxX: 0,})
  }

  updateScrollbarBounds() {
    Draggable.get(this.handle).applyBounds(this.track)
  }

  updateSliderPosition(x) {
    const sld = Draggable.get(this.slideContainer)
    gsap.set('.piano-key-carousel__slide-container', {x: -(x * this.scrollToSlideRatio)})
    sld.update()
  }

  updateScrollbarPosition(x) {
    const scr = Draggable.get(this.handle)
    gsap.set('.piano-key-carousel__progress-handle', {x: -(x / this.scrollToSlideRatio)})
    scr.update()
  }

  setRatio() {
    const sld = Draggable.get(this.slideContainer)
    const scr = Draggable.get(this.handle)
    this.scrollToSlideRatio = -(sld.minX / scr.maxX)
  }

  closeAllSlides () {
    this.slideContainer.querySelectorAll('.carousel__card--active').forEach(slide => {
      this.closeSlide(slide)
    })
  }

  closeSlide(slide) {
    const end = window.innerWidth >= breakpoints.lg ? 240 : 160
    const closeTl = gsap.timeline({
      paused: true,
      onStart: () => {
        this.resetInnerSlider(slide)
      },
      ease: "power4.out",
      onUpdate: () => this.recalcParams(),
      onComplete: () => {
        slide.classList.remove('carousel__card--active')
        slide.style.removeProperty('width')
      }
    })
    closeTl.set(slide, {width: slide.offsetWidth})
    closeTl.set(slide.querySelector('.subcard__progress-track'), {opacity: 1, y: 0})
    closeTl.to(slide, {width: end, duration: 1}, 0)
    closeTl.to(slide.querySelector('.carousel__subcard'), {opacity: 0, duration: 0.7}, 0.5)
    closeTl.to(slide.querySelector('.carousel__card-label'), {opacity: 1, duration: 1}, 0)
    closeTl.to(slide.querySelector('.subcard__icon'), {x: -100, y: 100, duration: 1}, 0)
    closeTl.to(slide.querySelector('.subcard__eyebrow'), {x: 50, y: -30, opacity: 0.2, duration: 1}, 0)
    closeTl.to(slide.querySelector('.subcard__progress-track'), {opacity: 0, y: 100, duration: 1}, 0)
    closeTl.to(slide.querySelector('.subcard__tags'), {opacity: 0, duration: 1}, 0)
    closeTl.play()
  }
  
  openSlide(slide) {
    const end = window.innerWidth >= breakpoints.lg ? 740 : getParent(slide, '.container').offsetWidth
    const openTl = gsap.timeline({
      paused: true,
      ease: "power1.out",
      onStart: () => {
        this.slides.forEach(sld => sld.classList.add('pointer-events-none'))
        slide.classList.add('carousel__card--active')
      },
      onUpdate: () => {
        this.recalcParams()
        this.centerOnSlide(slide)
      },
      onComplete: () => {
        this.slides.forEach(sld => sld.classList.remove('pointer-events-none'))
        this.recalcParams()
        this.startInnerSlider(slide)
        slide.querySelector('.subcard__modal-link').addEventListener('click', evt => {
          evt.preventDefault()
          this.triggerModal(evt.target)
        })
      }
    })
    openTl.set(slide, {width: slide.offsetWidth})
    openTl.set(slide.querySelector('.subcard__icon'), {x: -100, y: 100})
    openTl.set(slide.querySelector('.subcard__eyebrow'), {x: 50, y: -30, opacity: 0.2})
    openTl.set(slide.querySelector('.subcard__progress-track'), {opacity: 0, y: 100})
    openTl.set(slide.querySelector('.subcard__tags'), {opacity: 0})
    openTl.to(slide, {width: end, duration: 1}, 0)
    openTl.to(slide.querySelector('.carousel__subcard'), {opacity: 1, duration: 0.3}, 0)
    openTl.to(slide.querySelector('.carousel__card-label'), {opacity: 0, duration: 1}, 0)
    openTl.to(slide.querySelector('.subcard__icon'), {x: 0, y: 0, duration: 1}, 0)
    openTl.to(slide.querySelector('.subcard__eyebrow'), {x: 0, y: 0, opacity: 1, duration: 1}, 0)
    openTl.to(slide.querySelector('.subcard__progress-track'), {opacity: 1, y: 0, duration: 1}, 0)
    openTl.to(slide.querySelector('.subcard__tags'), {opacity: 1, duration: 1}, 0)
    openTl.play()
  }

  setHandleSize() {
    this.handle.style.width = this.track.offsetWidth/this.slides.length + 'px'
  }

  handlePrevBtn(self) {
    const increment = window.innerWidth >= breakpoints.lg ? 240 : 160
    const sld = Draggable.get(self.slideContainer)
    const x = sld.x < sld.maxX ? sld.x + increment : sld.maxX
    gsap.to(this.slideContainer, {
      duration: 0.4,
      x: x,
      ease: "power1.out",
      onComplete: () => {
        sld.update()
      },
      onUpdate: () => {
        this.updateScrollbarPosition(x)
        this.recalcParams()
      }
    })
  }
  
  handleNextBtn(self) {
    const increment = window.innerWidth >= breakpoints.lg ? 240 : 160
    const sld = Draggable.get(self.slideContainer)
    const x = sld.x - increment > sld.minX ? sld.x - increment : sld.minX
    gsap.to(this.slideContainer, {
      duration: 0.4,
      x: x,
      ease: "power1.out",
      onComplete: () => {
        sld.update()
      },
      onUpdate: () => {
        this.updateScrollbarPosition(x)
        this.recalcParams()
      }
    })
    
  }

  handleButtonVisibility() {
    if(window.innerWidth >= breakpoints.lg) {
      const sld = Draggable.get(this.slideContainer)
      this.prevBtn.classList.remove('pointer-events-none')
      this.nextBtn.classList.remove('pointer-events-none')

      if(sld.x === sld.minX) {
        this.nextBtn.classList.remove('opacity-100')
        this.nextBtn.classList.add('opacity-0')
        this.prevBtn.classList.add('opacity-100')
      } else if(sld.x === sld.maxX) {
        this.prevBtn.classList.remove('opacity-100')
        this.prevBtn.classList.add('opacity-0')
        this.nextBtn.classList.add('opacity-100')
      } else {
        this.prevBtn.classList.remove('opacity-0')
        this.nextBtn.classList.remove('opacity-0')
        this.prevBtn.classList.add('opacity-100')
        this.nextBtn.classList.add('opacity-100')
      }
    } else {
      this.prevBtn.classList.remove('opacity-100')
      this.nextBtn.classList.remove('opacity-100')
      this.prevBtn.classList.add('opacity-0')
      this.nextBtn.classList.add('opacity-0')
      this.prevBtn.classList.add('pointer-events-none')
      this.nextBtn.classList.add('pointer-events-none')
    }
  }
  
  centerOnSlide(slide) {
    const sld = Draggable.get(this.slideContainer)
    const sldCnt = getParent(slide, '.piano-key-carousel__slide-container').getBoundingClientRect()
    let x = slide.offsetLeft - ((sldCnt.width - slide.offsetWidth)/2)

    if(x > -sld.minX) {
      x = sld.minX
    } else if(x < -sld.maxX) {
      x = sld.maxX
    } else {
      x = -x
    }

    gsap.to(this.slideContainer, {x: x, duration: 1, ease: "power1.out", onComplete: () => this.recalcParams()})
    this.updateScrollbarPosition(x)
  }

  startInnerSlider(slide) {
    const subslides = slide.querySelectorAll('.subcard__fact')
    if(this.subslideTimeline) {
      this.resetInnerSlider(slide)
    }
    if(subslides.length > 1) {
      this.subslideTimeline = gsap.timeline({repeat: -1})
      subslides.forEach(fact => {
        this.subslideTimeline
          .to(fact, {opacity: 1, duration: 0.5, onStart: () => fact.classList.remove('hidden')})
          .to(slide.querySelector('.subcard__progress'), {width: slide.querySelector('.subcard__progress-track').offsetWidth, duration: 5, ease: 'none'}, '>')
          .to(fact, {opacity: 0, duration: 0.35, onComplete: () => fact.classList.add('hidden')}, '>')
          .set(slide.querySelector('.subcard__progress'), {width: 0}, '>')
      })
    }
  }

  resetInnerSlider(slide) {
    const subslides = slide.querySelectorAll('.subcard__fact')
    subslides.forEach((sld, i) => {
      if(i === 0) {
        sld.style.opacity = 1
      } else {
        sld.style.opacity = 0
      }
      slide.querySelector('.subcard__progress').style.width = 0
    })

    if(this.subslideTimeline) {
      this.subslideTimeline.kill()
    }
    this.subslideTimeline = null
  }

  recalcParams() {
    const sld = Draggable.get(this.slideContainer)
    
    this.setHandleSize()
    this.updateSliderBounds()
    this.updateScrollbarBounds()
    this.setRatio()
    this.handleButtonVisibility()
    sld.update()
  }

  triggerModal(btn) {
    console.log('post id', btn)
    this.el.querySelector('#piano-key-modal-cnt').dataset.activeCard = btn.dataset.post
  }
}

export default el => {
  new gsapCarousel(el)
}