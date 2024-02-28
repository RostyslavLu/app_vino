<script setup>
import ApplicationLogoBlack from '@/Components/ApplicationLogoBlack.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="black-layout">
        <header class="flex-column">
            <Link href="/">
                <ApplicationLogoBlack class="logo" />
            </Link>
            <h1>vino</h1>
        </header>   
            
        <main
        >
            <slot /> 
        </main>
    </div>
</template>
