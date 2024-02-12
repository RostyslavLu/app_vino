<template>
    <div class="div-guest">
        <div>
            <Link href="/">
                <ApplicationLogo class="logo white" />
   
            </Link>
    
        </div>
        <h1 class="title">
            vino
        </h1>
            
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
