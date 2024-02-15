<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <main class="auth-container">
        <header class="flex-column">
            <Link href="/">
                <ApplicationLogo class="logo" />
            </Link>
            <h1>vino</h1>
        </header>
        <!-- le slot principale, pour la page -->
        <section>
            <slot />
        </section>
    </main>
</template>
