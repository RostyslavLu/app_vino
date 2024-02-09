<template>
    <img :src="logo" alt="logo vino" class="logo-image">
</template>
x
<script>
import logo from '@/../images/vinologoblanc.png';


export default {
  data() {
    return {
      logo: logo
    }
  }
}
</script>
