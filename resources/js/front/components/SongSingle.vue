<template>
  <div>
    ...
  </div>
</template>

<script>
import { Howl, Howler } from 'howler'

export default {
  data () {
    return {
      baseUrl: null,
      song: null,
      sound: null,
      tracks: []
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
  }
}
</script>

<style scoped>

</style>
