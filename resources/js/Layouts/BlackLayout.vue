<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="auth-container">
        <header class="flex-column">
            <Link href="/">
                <ApplicationLogo class="logo white" />
            </Link>
            <h1>vino</h1>
        </header>   
            
        <main
        >
            <slot /> 
        </main>
    </div>
</template>
