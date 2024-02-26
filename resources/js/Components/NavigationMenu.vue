<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cellarName: String
});

let showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};
</script>

<template>
    <div>
        <img src="/img/icons/menu.svg" alt="menu" class="logo" @click="toggleMenu"/>
        <div v-if="showMenu" class="">
            <h3>Celliers</h3>
            <Link href="/dashboard">{{ cellarName }}</Link>
            <Link href="/logout">Déconnexion</Link>
            <Link href="/profile">Profil</Link>
        </div>
    </div>
</template>