<template>
  <div id="app">
    <component :is="$route.meta.layout">
      <router-view/>
    </component>
  </div>
</template>
<script>
  export default {
    name: 'App',
    watch: {
      '$route':{
        handler:(to, from) => {
          document.title = to.meta.title || 'My Web';
        },
        immediate:true
      }
    }
  };
</script>