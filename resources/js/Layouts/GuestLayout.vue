<template>
    <main class="auth-container">
        <header class="flex-column">
            <Link href="/">
                <ApplicationLogo class="logo white" />
            </Link>
            <h1>vino</h1>
        </header>   
            
        <section
        >
            <slot /> 
        </section>
    </main>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
