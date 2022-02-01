import Glide from '@glidejs/glide/dist/glide.esm'


const ImageCopySlider = (el) => {
  const next = el.querySelector('.slide-btn--next')
  const prev = el.querySelector('.slide-btn--prev')
  const slider = new Glide('.glide',{
    startAt: 0,
    perView: 2,
    bound: true,
    breakpoints: {
      991: {
        perView: 1
      }
    }
  })
  slider.mount()
  next.addEventListener('click', () => slider.go('>'))
  prev.addEventListener('click', () => slider.go('<'))
}

export default function(el) {
  ImageCopySlider(el)
}