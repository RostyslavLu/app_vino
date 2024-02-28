<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { usePage } from '@inertiajs/vue3';

const cellar = usePage().props.cellar;

</script>

<template>
    <div class="__layout">
        <header class="flex-between">
            <ApplicationLogoWhite class="logo"/>
            <!-- Menu de navigation -->
            <NavigationMenu :cellar="cellar"/>    
        </header>

    <!-- Contenu principal de la page -->
        <main>
            <slot />
        </main>
    </div>
 
</template>