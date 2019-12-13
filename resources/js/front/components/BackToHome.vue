<template>
  <div class="back-to-home">
    <a :href="baseUrl"
       title="back to home">
      <img src="/images/arrow.png"
           alt="back to home">
    </a>
  </div>
</template>

<script>
export default {
  props: {
    baseUrl: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>
  .back-to-home {
    background: #fff;
    position: absolute;
    top: 10px;
    left: 10px;
    width: 60px;
    padding: 10px;
    z-index: 9999;
  }

  .back-to-home img {
    width: 100%;
    height: auto;
  }
</style>
