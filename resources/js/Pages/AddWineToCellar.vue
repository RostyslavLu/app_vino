<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AddWineCellar from '@/Layouts/AddWineCellar.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SearchInput from '@/Components/SearchInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import WineList from '@/Components/WineList.vue';

const search = ref('');
const winesListSaq = ref([]);


const searchWineSaq = () => {
    console.log(search.value);
};

const fetchWinesListSaq = async () => {
    const response = await axios.get(route('cellars.searchWineInSaq'));
    winesListSaq.value = response.data;
};
</script>

<template>
    <Head title="Ajouter un vin à mon cellier" />
        <AddWineCellar class="black-container add-wine">
            <template #header>
                <!-- Entete -->
                <div class="add-wine-header">
                    <div class="add-wine-controls">
                        <ApplicationLogo class="logo white" width="48" heigth="48" />
                        <Link :href="route('dashboard')">
                            <svg style="cursor: pointer;"
                                height="48" width="48" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6m0 12L6 6"/>
                            </svg>
                        </Link>
                    </div>
                    <h2>Ajouter un vin</h2>
                </div>
            </template>

            <template #main>
                <div class="add-wine-search">
                    <!-- Contenue -->
                    <InputLabel for="search" value="Rechercher un vin" />
                    <SearchInput v-model="search" @input="searchWineSaq" placeholder="ex. chateau"/>
                </div>
                <div class="add-wine-filters">
                    <h3>Filtres</h3>
                    <div class="add-wine-filters-list">
                        <Link >Dates</Link>
                        <Link >Pays</Link>
                        <Link >Millésime</Link>
                        <Link >Rouge</Link>
                        <Link >Blanc</Link>
                        <Link >Rosé</Link>
                    </div>
                </div>
                <div class="add-wine-list">
                    <WineList :cellarContent="winesListSaq" />
                </div>
            </template>

        </AddWineCellar>
</template>
