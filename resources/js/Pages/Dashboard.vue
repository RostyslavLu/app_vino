<script setup>

import SearchInput from '@/Components/SearchInput.vue';
import { ref, computed } from 'vue';
import WineList from '@/Components/WineList.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const userCellar = usePage().props.userCellar;
const cellarContents = usePage().props.cellarContents;
const wines = usePage().props.wines;

// const search = ref('');

// fonction pour rechercher des vins dans le cellier par nom
// const searchWine = () => {
//     return cellarContents.filter(content => content.name.includes(search.value));
// };
// les vins filtrés par la recherche de l'utilisateur par nom
//const filteredCellarContents = computed(() => searchWine());
const searchWines = () => {
    router.get(`/saq-search/${search.value}`);
};
</script>

<template>
    
        <Head title="Mon compte" />
        <div class="dashboard">
        <MainLayout>
            <section class="user-account">
            <div class="user-cellars">
            <h2 v-for="cellar in userCellar" :key="cellar.id">{{ cellar.name }}</h2>
                <Link :href="route('addWineToCellar')">
                <svg style="display: inline-block; vertical-align: middle; cursor: pointer;" width="24" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </Link>
        </div>
        <div class="cadd-wine-filters">
            <h3>Filtres</h3>
            <div class="add-wine-filters-list">
                <Link style="color: var(--primary);" href="/dates">Dates</Link>
                <Link style="color: var(--primary);" href="/pays">Pays</Link>
                <Link style="color: var(--primary);" href="/millesime">Millésime</Link>
                <Link style="color: var(--primary);" href="/rouge">Rouge</Link>
                <Link style="color: var(--primary);" href="/blanc">Blanc</Link>
                <Link style="color: var(--primary);" href="/rose">Rosé</Link>
            </div>
        </div>
        <div>
            <search-input v-model="search" @input="searchWine" placeholder="Rechercher un vin dans les celliers" />
            <span v-if="wines">
                {{ wines.total }} <span v-if="wines.total > 1">vins&nbsp;</span>
                <span v-else>vin&nbsp;</span>
                <span v-if="wines.total > 1">trouvés</span>
                <span v-else>trouvé</span>
            </span>
        </div>
        <div>
            <wine-list :cellarContent="wines.data" :wines="wines" />
        </div>
    </section>
</MainLayout>

    </div>
</template>

