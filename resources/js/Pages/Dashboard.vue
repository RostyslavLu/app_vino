<script setup>

import SearchInput from '@/Components/SearchInput.vue';
import { ref, computed } from 'vue';
import WineList from '@/Components/WineList.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const { props } = usePage();

const userCellar = usePage().props.userCellar;

const wines = ref(props.wines);
const search = ref(props.search);
const searchInput = ref(false);

//entamer la recherche sur la bd
const searchWines = () => {
    if (search.value.trim() === ''){
        router.get('/dashboard')
    }else{
        router.get(`/cellar-search/${search.value}`)
    }
};
</script>

<template>
        <Head title="Mon compte" />
        <div class="main-layout">
            <div class="__layout __dashboad-gap">
                <MainLayout>
                <section class="__main-container __dashboard-gap">
                    <div class="__cellar">
                        <h1 v-for="cellar in userCellar" :key="cellar.id">{{ cellar.name }}</h1>
                        <Link :href="route('addWineToCellar')">
                            <svg style="display: inline-block; vertical-align: middle; cursor: pointer;" width="100" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="var(--primary)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            d="M5 12h14m-7 7V5" />
                            </svg>
                        </Link>
                    </div>
                    <div class="cadd-wine-filters">
                        <h3>Filtres</h3>
                        <div class="add-wine-filters-list">
                            <Link style="color: var(--primary);" href="/rouge">Rouge</Link>
                            <Link style="color: var(--primary);" href="/blanc">Blanc</Link>
                            <Link style="color: var(--primary);" href="/rose">Rosé</Link>
                        </div>
                    </div>
                <div>
                <!-- Search input -->
                <SearchInput :searchInput="searchInput" v-model="search" @input="searchWines" placeholder="Rechercher un vin dans les celliers" />
                <span v-if="wines">
                    {{ wines.total }} <span v-if="wines.total > 1">vins&nbsp;</span>
                    <span v-else>vin&nbsp;</span>
                    <span v-if="wines.total > 1">trouvés</span>
                    <span v-else>trouvé</span>
                </span>
                </div>
                <div>
                    <WineList :isUpdateVisible="true" :cellarContent="wines.data" :wines="wines"  />
                </div>
            </section>
        </MainLayout>

            </div>
    </div>
</template>

