<script setup>
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { Link } from '@inertiajs/vue3';
import { useAttrs } from 'vue';
import { usePage } from '@inertiajs/vue3';

const userCellar = usePage().props.userCellar;
const attrs = useAttrs();

defineProps({
    showNavigation: {
        type: Boolean,
        default: false
    },
    userCellar: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <div v-bind="attrs">
        <header >
            <div class="flex-between">
                <Link href="/">
                    <ApplicationLogoWhite class="logo"/>
                </Link>
            <!-- Menu de navigation -->
            <NavigationMenu v-if="showNavigation" :userCellar="userCellar" class="main-nav"/>
            </div>
                
            <h1><slot name="header"></slot></h1>
        </header>
        
        <!-- le slot principale, pour la page -->
        <main class="__main-container">
            <slot /> 
        </main>
    </div>
</template>