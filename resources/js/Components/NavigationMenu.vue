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
        <img src="/img/icons/menu.svg" alt="menu" class="logo" @click="toggleMenu"/>
        <div v-if="showMenu" class="main-nav">
            <h3>Celliers</h3>
            <Link v-for="cellar in userCellar" :key="cellar.id" href="/dashboard">{{ cellar.name }}</Link>
            <ResponsiveNavLink :href="route('logout')" method="post">déconnexion </ResponsiveNavLink>
            <Link href="/profile">Profil</Link>
        </div>
    </div>
</template>
