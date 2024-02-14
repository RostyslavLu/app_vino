<template>
    <div class="div-guest-register">

        <!-- le logo -->
        <div class="logo-container">
            <Link href="/">
                <ApplicationLogoReg/>
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
import ApplicationLogoReg from '@/Components/ApplicationLogoReg.vue';
import { Link } from '@inertiajs/vue3';
</script>

