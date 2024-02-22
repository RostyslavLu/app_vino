<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import SearchInput from '@/Components/SearchInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WineList from '@/Components/WineList.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';


const userCellars = ref([]);
const userCellarContent = ref([]);
const search = ref('');
const selectedCellar = ref(1);
// fonction pour récupérer les celliers de l'utilisateur
const fetchUserCellars = async () => {
    const response = await axios.get(route('cellars.userCellars'));
    userCellars.value = response.data;
};
// fonction pour récupérer le contenu du cellier de l'utilisateur
const fetchUserCellarContent = async (event) => {
    const response = await axios.get(route('cellars.userCellarContent', event.target.value));
    userCellarContent.value = response.data;
};
// fonction pour rechercher des vins dans les celliers de l'utilisateur
const searchWine = async () => {
    if (search.value === '') {
        userCellarContent.value = [];
        // si le champ de recherche est vide, on récupère le contenu du cellier sélectionné
        return fetchUserCellarContent({ target: { value: selectedCellar.value } });
    }
    const response = await axios.get(route('cellars.searchWineInUserCellars', search.value));
    userCellarContent.value = response.data;
    console.log(response.data);
};
// fonction pour effacer la champ de recherche
const clearSearch = () => {
    search.value = '';
};

onMounted(() => {
    fetchUserCellarContent({ target: { value: selectedCellar.value } });
});

fetchUserCellars();
</script>

<template >
    <Head title="Mon compte" />
    <MainLayout>
        <section class="user-account">
            <div class="user-cellars">
                <select-input v-model="selectedCellar" :options="userCellars"
                    @change="fetchUserCellarContent($event); clearSearch()"></select-input>
                            <Link :href="route('addWineToCellar')">
                                <svg
                                    style="display: inline-block; vertical-align: middle; cursor: pointer;"
                                width="24" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                </svg>
                            </Link>
            </div>
            <div>
                <search-input v-model="search" @input="searchWine" placeholder="Rechercher un vin dans les celliers"/>
            </div>
            <wine-list :cellarContent="userCellarContent" v-if="userCellarContent.length > 0" />
            <div v-else-if="userCellarContent.length === 0">
                <p>aucun vin n'a été trouvé</p>
            </div>
        </section>
    </MainLayout>
</template>

