// TODO: migrate this to post-slider cmp
import Glide from '@glidejs/glide/dist/glide.esm'

const doubleFeature = (el) => {
    const slider = new Glide(el.querySelector('.glide'),{
        perView: 1,
      })
      slider.mount()
  }
  
  export default function (el) {
    doubleFeature(el)
  }