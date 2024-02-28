<script setup>
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useAttrs } from 'vue';

const cellar = usePage().props.cellar;
const attrs = useAttrs();
console.log(cellar);
defineProps({
    showNavigation: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <div v-bind="attrs">
        <header >
            <div class="flex-between">
                <ApplicationLogoWhite class="logo"/>
                <!-- Menu de navigation -->
                <NavigationMenu v-if="showNavigation" :cellar="cellar" />
            </div>
                
            <h1><slot name="header"></slot></h1>
        </header>
        
        <!-- le slot principale, pour la page -->
        <main class="__main-container">
            <slot /> 
        </main>
    </div>
</template>