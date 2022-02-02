import 'svg-classlist-polyfill'
import './polyfills/ie11-foreach.js'
import './polyfills/ie11-object-fit.js'
import './polyfills/ie11-element-matches'
import './polyfills/ie11-prepend'
import { init } from './lib/init-components'

document.addEventListener('DOMContentLoaded', () => {
  // Init components for front end
  init({
    component: 'components'
  }).mount()
})
