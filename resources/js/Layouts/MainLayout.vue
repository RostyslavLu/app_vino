<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { Link, usePage } from '@inertiajs/vue3';

const cellar = usePage().props.cellar;

</script>

<template>
    <div class="__layout">
        <header >
            <div class="flex-between">
                <!-- logo -->
                <Link href="/" ><ApplicationLogoWhite class="logo"/></Link>
                <!-- Menu de navigation -->
                <NavigationMenu :cellar="cellar"/> 
            </div>
            
            <h1><slot name="header"></slot></h1>
   
        </header>

    <!-- Contenu principal de la page -->
        <main>
            <slot />
        </main>
    </div>
 
</template>