<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';

</script>


<template>
    <header class="navigation">
        <ApplicationLogoWhite class="logo"/>
        <!-- Menu de navigation -->
        <NavigationMenu class="icon"/>
    </header>
    

    <!-- Contenu principal de la page -->
    <main>
        <slot />
    </main>
</template>
