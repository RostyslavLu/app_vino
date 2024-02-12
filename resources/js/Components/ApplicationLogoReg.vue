<template>
    <img :src="logo" alt="logo vino" class="logoreg-image">
</template>
x
<script>
import logo from '@/../images/vinologo.png';


export default {
  data() {
    return {
      logo: logo
    }
  }
}
</script>
