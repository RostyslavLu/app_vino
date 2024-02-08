<template>
    <div class="div-guest">
        <div>
            <Link href="/">
                <ApplicationLogo class="application-logo" />
   
            </Link>
    
        </div>
        <div class="name">
            VINO
       </div>
        <div
        >
            <slot /> 
        </div>
    </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
@import '@/../css/styles.css';
</style>
