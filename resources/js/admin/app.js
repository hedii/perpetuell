import 'popper.js'
import 'jquery'
import 'bootstrap'

if (document.body.classList.contains('song-create')) {
  const loading = document.getElementById('loading')
  document.getElementById('song-create-form').addEventListener('submit', () => {
    loading.classList.remove('d-none')
    window.scrollTo(0, 0)
  })
}
