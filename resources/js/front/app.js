import 'popper.js'
import 'bootstrap'
import Vue from 'vue'
import SongSingle from './components/SongSingle'
import HomeModal from './include/home-modal'

if (document.getElementById('app')) {
  new Vue({
    el: '#app',
    components: {
      SongSingle
    }
  })
}

const modalElement = document.getElementById('home-modal')
const modalButtonElement = document.getElementById('home-modal-link')

if (modalElement && modalButtonElement) {
  HomeModal.create(modalElement, modalButtonElement)
}
