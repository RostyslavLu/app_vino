<template>
    <div class="guest-register">
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogo class="logo"/>
            </Link>

        </div>
        <div class="register-page-title">
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

