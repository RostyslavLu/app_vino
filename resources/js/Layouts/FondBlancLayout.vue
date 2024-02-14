<template>
    <div class="div-guest-register">
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogo/>
            </Link>
        </div>
            <!-- Page Heading -->
            <header class="" v-if="$slots.header">
                <div class="">
                    <slot name="header" />
                </div>
            </header>
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

