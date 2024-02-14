<template>
    <div class="div-guest-register">
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogo/>

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
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

