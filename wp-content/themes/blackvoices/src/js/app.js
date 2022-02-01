import 'svg-classlist-polyfill'
import './polyfills/ie11-foreach.js'
import './polyfills/ie11-object-fit.js'
import './polyfills/ie11-element-matches'
import './polyfills/ie11-prepend'
import {init, editorInit} from './lib/init-components'

// Initialize Vue.
import Vue from 'vue/dist/vue.js';
import Vuex from 'vuex';
// import CompanyIndexState from './vuex/CompanyIndexState';
Vue.use(Vuex);

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('#vue-app')) {
    /* Vue Components -- DO-NOT-DELETE-THIS-LINE */
    Vue.component('vue-demo', require('./components/vue/VueDemo.vue').default)
    const store = new Vuex.Store({
      /* Vuex Modules -- DO-NOT-DELETE-THIS-LINE */
      modules: {
        // CompanyIndexState
      }
    });

    new Vue({
      el: '#vue-app',
      store
    })
  }

  if(document.querySelector('body').classList.contains('block-editor-page')) {
    if( window.acf ) {
      const blocks = [ /* DO-NOT-DELETE-THIS-LINE */
        "block-demo"
      ]

      blocks.forEach(blockName => {
        window.acf.addAction( `render_block_preview/type=${blockName}`, function() {
          editorInit({
            component: blockName
          }, blockName).mount()
        })
      })
    }
  } else {
    // Init components for front end
    init({
      component: 'components'
    }).mount()
  }
})
