<template>
  <div ref="songel">
    <video ref="fullscreenvideo"
           class="fullscreen-video"
           autoplay muted>
      <source :src="videoUrl"
              type="video/mp4">
    </video>

    <div v-if="song"
         class="page-content">
      <div class="tracks"
           :style="tracksStyle">
        <div v-for="track in song.tracks"
             :key="track.id"
             class="track">
          <img :src="`/${track.image}`"
               alt=""
               :style="trackStyle">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Howl, Howler } from 'howler'

export default {
  data () {
    return {
      windowHeight: 0,
      baseUrl: null,
      song: {},
      sound: null,
      tracks: []
    }
  },
  computed: {
    videoUrl () {
      return this.song.hasOwnProperty('video') ? `/${this.song.video}` : null
    },
    tracksStyle () {
      console.log(this.windowHeight)

      return {
        width: 'auto',
        height: `${this.windowHeight}px`
      }
    },
    trackStyle () {
      return {
        width: 'auto',
        height: `${this.windowHeight / 9}px`
      }
    }
  },
  methods: {
    initialize () {
      // this.baseUrl = window.baseUrl
      // this.song = window.song
      // let tracks = []
      //
      // this.song.tracks.forEach(track => {
      //   tracks.push(`${this.baseUrl}/${track.audio}`)
      // })
      //
      // console.log(tracks)
      //
      // this.sound = new Howl({
      //   src: tracks
      // })

      // const id1 = this.sound.play()
      // const id2 = this.sound.play()

      // this.sound.play()

      this.windowHeight = window.innerHeight
      this.baseUrl = window.baseUrl
      this.song = window.song
      let tracks = []

      this.song.tracks.forEach(track => {
        tracks.push(new Howl({ src: `${this.baseUrl}/${track.audio}` }))
      })

      this.tracks = tracks

      this.tracks.forEach(track => {
        track.on('end', trackId => {

        })
        track.play()
        const duration = track.duration()
        console.log(duration)
      })
    }
  },
  mounted () {
    this.initialize()

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
    top: 5px;
    right: 30px;
  }

  .track img {
    display: block;
    height: 10%;
    width: auto;
  }
</style>
