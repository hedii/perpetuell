<template>
  <div @click="restart"
       class="track"
       :style="trackStyle">
    <img :src="imageUrl"
         :alt="trackAlt"
         :style="trackImageStyle">
  </div>
</template>

<script>
import { Howl } from 'howler'
import numberBetween from '../include/numberBetween'

export default {
  props: {
    track: {
      type: Object,
      required: true
    },
    windowHeight: {
      type: Number,
      required: true
    },
    baseUrl: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      howl: null,
      howlId: null,
      isPlaying: false,
      loopDelay: 8
    }
  },
  computed: {
    imageUrl () {
      return `${this.baseUrl}/${this.track.image}`
    },
    trackStyle () {
      return {
        opacity: this.isPlaying ? 1 : 0
      }
    },
    trackImageStyle () {
      return {
        width: 'auto',
        height: `${this.windowHeight / 10}px`
      }
    },
    trackAlt () {
      return `Track ${this.track.id}`
    }
  },
  methods: {
    incrementLoopDelay () {
      this.loopDelay = this.loopDelay + 1
    },
    restart () {
      this.isPlaying = false
      this.howl.stop(this.howlId)
      setTimeout(() => {
        this.howl.play(this.howlId)
      }, 1000)
    }
  },
  mounted () {
    this.howl = new Howl({ src: `${this.baseUrl}/${this.track.audio}` })

    this.howlId = this.howl.play()

    this.howl.once('load', () => {
      this.howl.seek(numberBetween(1, this.track.duration))
    })

    this.howl.on('seek', () => {
      this.howl.fade(0, 1, 3000)
    })

    this.howl.on('play', trackId => {
      this.isPlaying = true
      console.log(`started playing track ${trackId} (#${this.track.id})`)
    })

    this.howl.on('end', trackId => {
      this.isPlaying = false

      setTimeout(() => {
        this.howl.play(trackId)
      }, this.loopDelay * 1000)
      console.log(`stopped playing track ${trackId} (#${this.track.id})`)
      this.incrementLoopDelay()
    })
  }
}
</script>

<style scoped>
  .track {
    transition: opacity 1s;
  }

  .track:hover {
    cursor: pointer;
  }

  .track img {
    display: block;
    height: 10%;
    width: auto;
  }
</style>
