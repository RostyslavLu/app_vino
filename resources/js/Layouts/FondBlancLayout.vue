<template>
    <div class="div-guest-register">

        <!-- le logo -->
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogo/>
            </Link>
        </div>

        <!-- un slot pour l'entête de la page -->
        <header class="" v-if="$slots.header">
            <div class="">
                <slot name="header" />
            </div>
        </header>

        <!-- le slot principale, pour la page -->
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

