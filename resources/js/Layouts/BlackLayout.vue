<script setup>
import ApplicationLogoFondNoir from '@/Components/ApplicationLogoFondNoir.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="auth-container">
        <header class="flex-column">
            <Link href="/">
                <ApplicationLogoFondNoir class="logo" />
            </Link>
            <h1>vino</h1>
        </header>   
            
        <main
        >
            <slot /> 
        </main>
    </div>
</template>
