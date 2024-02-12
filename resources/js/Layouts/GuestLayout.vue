<template>
    <div class="div-guest">
        <div>
            <Link href="/">
                <ApplicationLogo class="logo" />
   
            </Link>
    
        </div>
        <div class="name">
            vino
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
