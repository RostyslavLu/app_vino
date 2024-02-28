<script setup>
import { ref, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const props = defineProps({
    cellar: Object
});

let showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};
</script>

<template>
    <div>
        <img v-if="!showMenu" src="/img/icons/menu.svg" alt="menu" class="logo" @click="toggleMenu"/>
        <img v-else src="/img/icons/x.svg" alt="close" class="logo" @click="toggleMenu"/>
        <div v-if="showMenu" class="navigation-menu">
            <section>
                <h2>Cellier</h2>
                <div class="flex-row">
                    <svg class="icon" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333.23 333.23">
                        <g id="Calque_1-2" data-name="Calque 1">
                            <path class="__white" d="m173.19 180.84 72.58 72.58-7.07 7.07-72.58-72.58-71.41 71.4-7.07-7.07 71.41-71.4-72.35-72.35 7.07-7.07 72.35 72.35 73.52-73.53 7.07 7.07-73.52 73.53z"/>
                            <circle class="__white" cx="166.24" cy="101.25" r="28.5"/>
                            <circle class="__white" cx="87.53" cy="180.96" r="28.5"/>
                            <circle class="__white" cx="245.71" cy="180.71" r="28.5"/>
                            <circle cx="166.62" cy="166.62" r="161.62" style="fill:none;stroke:var(--secondary);stroke-miterlimit:10;stroke-width:10px"/>
                        </g>
                    </svg>    
                    <Link href="/dashboard">{{ cellar.name }}</Link>
                </div>
            </section>
                <div class="flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <Link href="/profile">Profil</Link>
            </div>
            <div class="flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <ResponsiveNavLink :href="route('logout')" method="post">Déconnexion </ResponsiveNavLink>
            </div>
        </div>
    </div>
</template>