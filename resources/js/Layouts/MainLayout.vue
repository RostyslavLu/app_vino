<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { usePage } from '@inertiajs/vue3';

const userCellar = usePage().props.userCellar;
</script>

<template>
    
        <header class="flex-between">
            <ApplicationLogoWhite class="logo"/>
            <!-- Menu de navigation -->
            <NavigationMenu :userCellar="userCellar" class="main-nav"/>    
        </header>

    <!-- Contenu principal de la page -->
    <main>
        <slot />
    </main>
</template>
