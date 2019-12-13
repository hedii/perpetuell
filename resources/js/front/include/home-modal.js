import $ from 'jquery'
import numberBetween from './numberBetween'

export default {
  state: {
    textElements: [],
    currentTextNumber: 1
  },

  create (modalElement, buttonElement) {
    this.textElements = document.querySelectorAll('.home-modal-text')
    this.currentTextNumber = numberBetween(1, this.textElements.length)

    buttonElement.addEventListener('click', event => {
      event.preventDefault()
      $(modalElement).modal('show')
    })

    $(modalElement).on('show.bs.modal', () => {
      this.randomiseText()
    })
  },

  randomiseText () {
    const oldTextNumber = this.currentTextNumber
    const newTextNumber = numberBetween(1, this.textElements.length)

    if (oldTextNumber === newTextNumber) {
      return this.randomiseText()
    }

    this.currentTextNumber = newTextNumber

    this.textElements.forEach(text => {
      if (text.id !== `home-modal-text-${this.currentTextNumber}`) {
        text.classList.add('d-none')
      } else {
        text.classList.remove('d-none')
      }
    })
  }
}
