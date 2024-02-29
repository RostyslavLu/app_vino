<script setup>

import SearchInput from '@/Components/SearchInput.vue';
import { ref, computed, watchEffect } from 'vue';
import WineList from '@/Components/WineList.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const { props } = usePage();

const userCellar = usePage().props.userCellar;
const wines = ref(props.wines);
const search = ref(props.search);
const searchInput = ref(false);
const filter = ref(props.filter);

// cette fonction est appelé lorsqu'on selectionne un filtre
const changeFilter = (newFilter) => {
    if(filter.value == newFilter){
        filter.value = 'all';
    }else{
        filter.value = newFilter;
    }
    searchWines();
}

// cette fonction est appelé lorsqu'on tape dans la barre de recherche
const searchWines = () => {
    if (search.value == undefined){
        search.value = '';
    }
    if (search.value == '' && filter.value == '' || search.value == '' && filter.value == 'all'){
        router.get('/dashboard')
    }
    if(filter.value == undefined){
        filter.value = 'all';
        router.get(`/cellar-search/${filter.value}/${search.value}`)
    }else{
        router.get(`/cellar-search/${filter.value}/${search.value}`)
    }
};


const message = computed(() => props.success);


</script>

<template>
        <Head title="Mon compte" />
        <div class="main-layout">
            <div class="__layout __dashboad-gap">
                <MainLayout>
                <section class="__main-container __dashboard-gap dashboard">
                    <div class="__cellar">
                        <h1 v-for="cellar in userCellar" :key="cellar.id">{{ cellar.name }}</h1>
                        <Link :href="route('addWineToCellar')">
                            <!-- https://feathericons.dev/?search=plus-circle&iconset=feather -->
                            <svg style="display: inline-block; vertical-align: middle; cursor: pointer;"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" class="main-grid-item-icon" fill="none" stroke="var(--primary)" stroke-linecap="round" stroke-linejoin="round" stroke-width=".8">
                            <circle cx="12" cy="12" r="10" fill="var(--success)"/>
                            <line x1="12" x2="12" y1="8" y2="16" />
                            <line x1="8" x2="16" y1="12" y2="12" />
                            </svg>
                        </Link>
                    </div>
                    <div class="cadd-wine-filters">
                        <h3>Filtres</h3>
                        <div class="add-wine-filters-list">
                            <button  style="background-color: var(--wine-red);" @click="changeFilter('rouge')">Rouge</button>
                            <button  style="background-color: var(--wine-white);" @click="changeFilter('blanc')">Blanc</button>
                            <button  style="background-color: var(--wine-rose);" @click="changeFilter('rose')">Rosé</button>
                            <button  style="background-color: var(--accent-light);" @click="changeFilter('all')">Tous</button>
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
                <div v-if="message" class="success-message">
                    <p>{{ message }}</p>
                </div>
                <div>

                    <WineList :isUpdateVisible="true" :isDeleteVisible="true" :cellarContent="wines.data" :wines="wines" :saqPage="saqPage"  />


                </div>
            </section>
        </MainLayout>
        </div>
    </div>
</template>

