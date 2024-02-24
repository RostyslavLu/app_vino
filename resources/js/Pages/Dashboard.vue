<script setup>

import SearchInput from '@/Components/SearchInput.vue';
import { ref, computed } from 'vue';
import WineList from '@/Components/WineList.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const userCellar = usePage().props.userCellar;
const cellarContents = usePage().props.cellarContents;
const wines = usePage().props.wines;

const search = ref('');

// fonction pour rechercher des vins dans le cellier par nom
const searchWine = () => {
    return cellarContents.filter(content => content.name.includes(search.value));
};
// les vins filtrés
const filteredCellarContents = computed(() => searchWine());
</script>

<template>
    <Head title="Mon compte" />
    <MainLayout>
        <section class="user-account">
            <div class="user-cellars">
            <h2 v-for="cellar in userCellar" :key="cellar.id">{{ cellar.name }}</h2>
                <Link :href="route('add-wine-cellar')">
                    <svg style="display: inline-block; vertical-align: middle; cursor: pointer;" width="24" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </Link>
            </div>
            <div>
                <search-input v-model="search" @input="searchWine" placeholder="Rechercher un vin dans les celliers" />
            </div>
            <div v-if="filteredCellarContents.length > 0">
                <wine-list :cellarContent="filteredCellarContents" :wines="wines" />
            </div>
            <div v-else>
                <p>Vous n'avez pas encore de vin dans votre cellier</p>
            </div>
        </section>
    </MainLayout>
</template>

