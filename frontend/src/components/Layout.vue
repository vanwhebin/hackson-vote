<template>
  <a-layout class="layout">
    <header></header>
    <a-layout-content class="content-layout" style="margin-top: 80px"></a-layout-content>
    <footer></footer>
  </a-layout>
</template>

<script>
import Header from './Header'
import Footer from './Footer'
export default {
  name: 'Layout',
  components: {
    Header,
    Footer
  }
}
</script>

<style scoped>
  .layout {
    background: white;
  }

  h1 {
    font-size: 2em;
  }
</style>
