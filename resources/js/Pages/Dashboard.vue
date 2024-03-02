<script setup>

import SearchInput from '@/Components/SearchInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref, computed, watchEffect } from 'vue';
import WineList from '@/Components/WineList.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { setBlockTracking } from 'vue';

const { props } = usePage();
const page = usePage();
const userCellar = usePage().props.userCellar;
const wines = ref(props.wines);
const search = ref(props.search);
const searchInput = ref(false);
const filter = ref(props.filter);
const showMessage = ref(false);
// cette fonction est appelé lorsqu'on selectionne un filtre
// et permet de recliquer sur un filtre pour le désactiver.
const changeFilter = (newFilter) => {
    if(filter.value == newFilter){
        filter.value = 'all';
    }else{
        filter.value = newFilter;
    }
    searchWines();
}

// cette fonction est appelé lorsqu'on tape dans la barre de recherche
// il faut gérer les champs vides...
const searchWines = () => {
    if(search.value == undefined){
        search.value = '';
    }
    if(search.value == '' && filter.value == '' ||
        search.value == '' && filter.value == 'all'){
        router.get('/dashboard')
    }
    if(filter.value == undefined){
        filter.value = 'all';
        router.get(`/cellar-search/${filter.value}/${search.value}`)
    }else{
        router.get(`/cellar-search/${filter.value}/${search.value}`)
    }
};

const message = computed(() => {
    if (page.props.flash.success) {
        return page.props.flash.success;
    }
});
watchEffect(() => {
    if (page.props.flash.success) {
        showMessage.value = true;
        setTimeout(() => {
            showMessage.value = false;
        }, 2500);
    }
});

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
                            <circle cx="12" cy="12" r="10" fill="var(--tertiary)"/>
                            <line x1="12" x2="12" y1="8" y2="16" />
                            <line x1="8" x2="16" y1="12" y2="12" />
                            </svg>
                        </Link>
                    </div>
                <div>
                <div class="add-wine-search">
                    <InputLabel for="search" value="Rechercher un vin">Rechercher un vin</InputLabel>
                    <p>Rechercher un vin</p>
                    <!-- Search input -->
                    <SearchInput :searchInput="searchInput" v-model="search" @input="searchWines" placeholder="Rechercher un vin dans les celliers" />
                </div>
                <span v-if="wines">
                    {{ wines.total }} <span v-if="wines.total > 1">vins&nbsp;</span>
                    <span v-else>vin&nbsp;</span>
                    <span v-if="wines.total > 1">trouvés</span>
                    <span v-else>trouvé</span>
                </span>
                </div>
                <div v-if="showMessage" class="input-success">
                    <p>{{ message }}</p>
                </div>

                <!-- Les filtres -->
                <div class="cadd-wine-filters">
                        <h3>Filtres</h3>
                        <div class="add-wine-filters-list">
                            <button
                                class="invisible"
                                @click="changeFilter('rouge')">
                                <div class="flex-row">
                                    Rouge
                                    <img v-if="filter === 'rouge'" src="/img/icons/droplet-red.svg" alt="filter-red" class="icon">
                                    <img v-else src="/img/icons/droplet-white.svg" alt="filter" class="icon">
                                </div>
                            </button>
                            <button
                                class="invisible"
                                @click="changeFilter('blanc')">
                                <div class="flex-row">
                                    Blanc
                                    <img v-if="filter === 'blanc'" src="/img/icons/droplet-yellow.svg" alt="filter-white" class="icon">
                                    <img v-else src="/img/icons/droplet-white.svg" alt="filter" class="icon">
                                </div>
                            </button>
                            <button
                                class="invisible"
                                @click="changeFilter('rose')">
                                <div class="flex-row">
                                    Rosé
                                    <img v-if="filter === 'rose'" src="/img/icons/droplet-pink.svg" alt="filter-rose" class="icon">
                                    <img v-else src="/img/icons/droplet-white.svg" alt="filter" class="icon">
                                </div>
                            </button>
                            <button
                                class="invisible"
                                @click="changeFilter('all')">
                                <div class="flex-row">
                                    Tous
                                    <img v-if="filter === 'all' || filter === undefined" src="/img/icons/droplet-black.svg" alt="filter-none" class="icon">
                                    <img v-else src="/img/icons/droplet-white.svg" alt="filter" class="icon">
                                </div>
                            </button>
                        </div>
                    </div>

                <div>
                    <!-- la liste des vins -->
                    <WineList :isUpdateVisible="true" :isDeleteVisible="true" :cellarContent="wines.data" :wines="wines" />
                </div>
            </section>
        </MainLayout>
        </div>
    </div>
</template>

