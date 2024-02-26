<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { ref } from 'vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { Link } from '@inertiajs/vue3';

</script>


<template>
    <header class="navigation">
        <ApplicationLogoWhite class="logo"/>
        <!-- Menu de navigation -->
        <NavigationMenu class="icon"/>
    </header>
    

    <!-- Slot pour entête de page -->
    <h1 v-if="$slots.header">
            <slot name="header" />
    </h1>

    <!-- Contenu principal de la page -->
    <main>
        <slot />
    </main>
</template>
