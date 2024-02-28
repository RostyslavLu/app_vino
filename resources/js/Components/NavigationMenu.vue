<script setup>
import { ref, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const props = defineProps({
    userCellar: Array
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
            <h3>Celliers</h3>
            <Link v-for="cellar in props.userCellar" :key="cellar.id" href="/dashboard">{{ cellar.name }}</Link>
            <Link href="/profile">Profil</Link>
            <ResponsiveNavLink :href="route('logout')" method="post">Déconnexion </ResponsiveNavLink>
        </div>
    </div>
</template>
