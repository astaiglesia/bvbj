import { doesSupportObjectFit } from '../lib/utils'

class Image {
  constructor (el) {
    this.el = el
    this.objectFit = doesSupportObjectFit()
  }
}

export default function(el) {
  new Image(el)
}