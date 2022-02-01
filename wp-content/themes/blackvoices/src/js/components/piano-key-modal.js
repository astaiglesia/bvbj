import { gsap } from 'gsap'
import axios from 'axios'

function pianoKeyModal(el) {

  this.el = el
  this.animation = null
  const self = this

  this.init = function(){
    this.inner = this.el.querySelector('.piano-key-modal__inner')
    this.closeBtn = this.el.querySelector('.piano-key-modal__close')
    this.nextBtn = this.el.querySelector('.piano-key-modal__next')
    this.prevBtn = this.el.querySelector('.piano-key-modal__prev')
    this.bg = this.el.querySelector('.piano-key-modal__bg')
    this.index = this.el.querySelector('.piano-key-modal__index')
    this.slides = this.el.querySelectorAll('.piano-key-modal__container')
    this.postId = this.el.querySelector('#piano-key-modal-cnt')
    this.slideIndex = 1
    this.buildAnimation()

    // set up the buttons
    this.nextBtn.addEventListener('click', () => {
      if(this.slideIndex + 1 <= this.slides.length) {
        this.slideIndex++
        this.slides.forEach(slide => {
          slide.classList.add('hidden')
          if(this.slideIndex === parseInt(slide.dataset.slideIndex)) {
            slide.classList.remove('hidden')
          }
          this.index.innerHTML = this.slideIndex
        })
      }
    })

    this.prevBtn.addEventListener('click', () => {
      if(this.slideIndex - 1 >= 1) {
        this.slideIndex--
        this.slides.forEach(slide => {
          slide.classList.add('hidden')
          if(this.slideIndex === parseInt(slide.dataset.slideIndex)) {
            slide.classList.remove('hidden')
          }
          this.index.innerHTML = this.slideIndex
        })
      }
    })

    // set up the observer
    const options = {
      attributes: true
    }

    const observer = new MutationObserver(this.callback)
    observer.observe(this.el, options)

    // add close button
    this.closeBtn.addEventListener('click', () => {
      this.closeModal()
    })
  }

  this.buildAnimation = () => {
    this.animation = gsap.timeline({
      paused: true,
      ease: "power1.out",
      onStart: () => {
        this.el.classList.remove('hidden')
      },
      onUpdate: () => {},
      onComplete: () => {},
      onReverseComplete: () => {
        this.el.classList.add('hidden')
      }
    })

    this.animation.to(this.inner, {opacity: 1, duration: 0.6}, 'modal-open')
    this.animation.to(this.bg, {width: '100%', height: '100vh', duration: 0.7}, 'modal-open-=0.1')
  }

  this.callback = function(mutationList) {
    mutationList.forEach(function(mutation) {
      if (mutation.type === 'attributes' && mutation.attributeName === 'data-active-card' && self.el.dataset.activeCard) {
        // handle class change
        self.getModalData(self.el.dataset.activeCard, true)
        // self.openModal(self.el.dataset.activeCard)
      }
    })
  }

  this.getModalData = (id, open = false) => {
    this.postId = id
    const url = `${window.location.protocol}//${window.location.hostname}/wp-json/insight/v1/get-case-studies?id=${this.postId}`
    axios.get(url)
      .then((response) => {
        let data = JSON.parse(response.data)
        console.log(data)
        this.el.innerHTML = data.content
        if(open) {
          this.init()
          this.buildAnimation()
          this.openModal()
        }
      })
  }

  this.closeModal = () => {
    this.el.dataset.activeCard = ''
    this.postId = null
    this.animation.reverse()
  }
  
  this.openModal = () => {
    // run the open animation
    this.animation.play()
  }

  this.init()
}

export default el => {
  new pianoKeyModal(el)
}