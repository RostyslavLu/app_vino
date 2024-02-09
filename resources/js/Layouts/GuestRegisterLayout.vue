<template>
    <div class="div-guest-register">
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogoReg/>
   
            </Link>
    
        </div>
        <div class="namereg">
            enregistrement
       </div>
        <div
        >
            <slot /> 
        </div>
    </div>
</template>

<script setup>
import ApplicationLogoReg from '@/Components/ApplicationLogoReg.vue';
import { Link } from '@inertiajs/vue3';
</script>

