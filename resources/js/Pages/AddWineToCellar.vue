<script setup>
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AddWineCellar from '@/Layouts/AddWineCellar.vue';
import SearchInput from '@/Components/SearchInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import WineList from '@/Components/WineList.vue';
import AppLogoFondNoir from '@/Components/AppLogoFondNoir.vue';

const { props } = usePage();
const wines = ref(props.wines);
const search = ref(props.search);
const searchInput = ref(false);

//entamer la recherche sur la bd
const searchWines = () => {  
    if (search.value.trim() === ''){
        router.get('/saq-empty-search')
    }else{
        router.get(`/saq-search/${search.value}`)
    }
};

</script>

<template>
    <Head title="Ajouter un vin à mon cellier" />
        <AddWineCellar class="black-container add-wine">
            <template #header>
                <!-- Entete -->
                <div class="add-wine-header">
                    <div class="add-wine-controls">
                        <AppLogoFondNoir width="48" heigth="48" />
                        <Link :href="route('dashboard')">
                            <svg style="cursor: pointer;"
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
                    <SearchInput :searchInput="searchInput" v-model="search" @input="searchWines" placeholder="ex. chateau"/>
                    <p>vins trouvés: {{ wines.total }}</p>
                </div>
                <div class="add-wine-filters">
                    <h3>Filtres</h3>
                    <div class="add-wine-filters-list">
                        <Link href="/dates">Dates</Link>
                        <Link href="/pays">Pays</Link>
                        <Link href="/millesime">Millésime</Link>
                        <Link href="/rouge">Rouge</Link>
                        <Link href="/blanc">Blanc</Link>
                        <Link href="/rose">Rosé</Link>
                    </div>
                </div>
                <div class="add-wine-list">
                    <!--dans la variable wines, on recoit tout, incluant les infos pour la pagination, tandisque wines.data, c'est les infos pour les vins-->
                    <WineList :cellarContent="wines.data" :wines="wines"/>
                </div>
            </template>
        </AddWineCellar>
</template>
