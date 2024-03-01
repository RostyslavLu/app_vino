<script setup>
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';
import AddWineCellar from '@/Layouts/AddWineCellar.vue';
import SearchInput from '@/Components/SearchInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import WineList from '@/Components/WineList.vue';
import ApplicationLogoBlack from '@/Components/ApplicationLogoBlack.vue';

const { props } = usePage();
//
const page = usePage();
const showMessage = ref(false);
//
const wines = ref(props.wines);
const search = ref(props.search);
const searchInput = ref(false);

const filter = ref(props.filter);

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
        router.get(`/saq-search/${filter.value}/${search.value}`)
    }else{
        router.get(`/saq-search/${filter.value}/${search.value}`)
    }
};

// message de succès après l'ajout d'un vin apparaît pendant 2.5 secondes
watchEffect(() => {
  if (page.props.success) {
    showMessage.value = true;
    setTimeout(() => {
      showMessage.value = false;
    }, 2500);
  }
});

</script>

<template>
    <Head title="Ajouter un vin à mon cellier" />
        <AddWineCellar >
            <template #header>
                <!-- Entete -->
                <div>
                    <div class="flex-between">
                        <ApplicationLogoBlack class="logo"  />
                        <Link
                            :href="route('dashboard')"
                            ><svg class="icon" style="cursor: pointer;"
                                height="48" width="48" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6m0 12L6 6"/>
                            </svg>
                        </Link>
                    </div>
                    <h1>Ajouter un vin</h1>
                </div>
            </template>

            <template #main>
                <!-- Contenu principal -->
                <div class="add-wine-search">
                    <InputLabel for="search" value="Rechercher un vin" />
                    <!-- Search input -->
                    <SearchInput :searchInput="searchInput" v-model="search" @input="searchWines" placeholder="ex. chateau" />
                    <p>vins trouvés: {{ wines.total }}</p>
                </div>
                
                <!-- Message de succès après l'ajout d'un vin -->
                <div v-if="showMessage" class="add-wine-message">
                    <p class="black-layout input-error">{{ page.props.success }}</p>
                </div>
                <!-- Les filtres -->
                <div class="cadd-wine-filters">
                    <h3>Filtres</h3>
                    <div class="add-wine-filters-list">
                        <button 
                            class="invisible" 
                            @click="changeFilter('rouge')">
                            <div class="flex-row white">
                                Rouge
                                <img v-if="filter === 'rouge'" src="/img/icons/droplet-red.svg" alt="filter-red" class="icon">
                                <img v-else src="/img/icons/droplet-black.svg" alt="filter" class="icon">
                            </div>
                        </button>
                        <button  
                            class="invisible" 
                            @click="changeFilter('blanc')">
                            <div class="flex-row  white">
                                Blanc
                                <img v-if="filter === 'blanc'" src="/img/icons/droplet-yellow.svg" alt="filter-white" class="icon">
                                <img v-else src="/img/icons/droplet-black.svg" alt="filter" class="icon">
                            </div>
                        </button>
                        <button  
                            class="invisible  white" 
                            @click="changeFilter('rose')">
                            <div class="flex-row">
                                Rosé
                                <img v-if="filter === 'rose'" src="/img/icons/droplet-pink.svg" alt="filter-rose" class="icon">
                                <img v-else src="/img/icons/droplet-black.svg" alt="filter" class="icon">
                            </div>
                        </button>
                        <button  
                            class="invisible  white" 
                            @click="changeFilter('all')">
                            <div class="flex-row">
                                Tous
                                <img v-if="filter === 'all'" src="/img/icons/droplet-white.svg" alt="filter-none" class="icon">
                                <img v-else src="/img/icons/droplet-black.svg" alt="filter" class="icon">
                            </div>
                        </button>     
                    </div>
                </div>
                <div class="add-wine-list">
                    <!--dans la variable wines, on recoit tout, incluant les infos pour la pagination, tandisque wines.data, c'est les infos pour les vins-->
                    <WineList :isAddVisible="true" :cellarContent="wines.data" :wines="wines" />
                </div>
            </template>
        </AddWineCellar>
</template>
