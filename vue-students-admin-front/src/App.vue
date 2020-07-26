<template>
  <div id="app">
    <Menu/>   
    <router-view class="top-padding" />
  </div>
</template>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' />

<script>
import Menu from './components/Menu.vue'

export default {
  name: 'App',
  components: {
     Menu
  }
}
</script>

<style>

@import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
@import url('https://fonts.googleapis.com/css?family=Poppins');

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.top-padding{
  padding-top: 20px;
}

</style>
