<template>
  <div>
    <template v-if="isLoading">
      <div class="loader-wrap"
           :style="loaderWrapStyle">
        <p v-if="error">
          An error has occurred during tracks preload, please <a :href="homeUrl">go back to home</a>
        </p>
        <PulseLoader v-else
                     :loading="isLoading"
                     color="black"/>
      </div>
    </template>
    <template v-else>
      <video ref="fullscreenvideo"
             class="fullscreen-video"
             autoplay muted loop>
        <source :src="videoUrl"
                type="video/mp4">
      </video>

      <BackToHome/>

      <div v-if="song"
           class="page-content">
        <div class="tracks"
             :style="tracksStyle">
          <TrackComponent v-for="track in song.tracks"
                          :key="track.id"
                          :track="track"
                          :window-height="windowHeight"
                          :base-url="baseUrl"/>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import BackToHome from './BackToHome'
import TrackComponent from './TrackComponent'
import PulseLoader from 'vue-spinner/src/PulseLoader'
import axios from 'axios'

export default {
  components: {
    BackToHome,
    TrackComponent,
    PulseLoader
  },
  data () {
    return {
      windowHeight: 0,
      homeUrl: '/',
      baseUrl: window.containerUrl,
      song: {},
      isLoading: true,
      loadedCount: 0,
      error: false
    }
  },
  computed: {
    videoUrl () {
      return this.song.hasOwnProperty('video') ? `${this.baseUrl}/${this.song.video}` : null
    },
    tracksStyle () {
      return {
        height: `${this.windowHeight}px`
      }
    },
    loaderWrapStyle () {
      return {
        height: `${this.windowHeight}px`
      }
    }
  },
  methods: {
    initialize () {
      this.windowHeight = window.innerHeight
      this.baseUrl = window.containerUrl
      this.song = window.song
    },
    preloadFiles () {
      // preload song video
      axios.get(`${this.baseUrl}/${song.video}`).then(() => {
        this.loadedCount = this.loadedCount + 1
        if (this.loadedCount === this.song.tracks.length) {
          this.isLoading = false
        }
      }).catch((error) => {
        console.log(error)
        this.error = true
      })

      // preload tracks audio
      this.song.tracks.forEach(track => {
        axios.get(`${this.baseUrl}/${track.audio}`).then(() => {
          this.loadedCount = this.loadedCount + 1
          if (this.loadedCount === this.song.tracks.length) {
            this.isLoading = false
          }
        }).catch((error) => {
          console.log(error)
          this.error = true
        })
      })
    }
  },
  mounted () {
    this.initialize()
    this.preloadFiles()

    window.addEventListener('resize', event => {
      this.windowHeight = window.innerHeight
    })
  }
}
</script>

<style scoped>
  html, body {
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .fullscreen-video {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -1000;
    overflow: hidden;
  }

  .page-content {
    color: #fff;
    overflow: hidden;
  }

  .tracks {
    position: absolute;
    top: 15px;
    right: 30px;
    width: auto;
  }

  .loader-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
  }
</style>
