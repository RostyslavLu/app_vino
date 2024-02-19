<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import SearchInput from '@/Components/SearchInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WineList from '@/Components/WineList.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const userCellars = ref([]);
const userCellarContent = ref([]);
const search = ref('');
const selectedCellar = ref(1);

const fetchUserCellars = async () => {
    const response = await axios.get(route('cellars.userCellars'));
    userCellars.value = response.data;
};

const fetchUserCellarContent = async (event) => {
    const response = await axios.get(route('cellars.userCellarContent', event.target.value));
    userCellarContent.value = response.data;
};

const searchWine = async () => {
    if (search.value === '') {
        userCellarContent.value = [];
        return;
    }
    const response = await axios.get(route('cellars.searchWineInUserCellars', search.value));
    userCellarContent.value = response.data;
    console.log(response.data);
};

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
                <application-logo height="24" />
                <select-input v-model="selectedCellar" :options="userCellars"
                    @change="fetchUserCellarContent($event); clearSearch()"></select-input>
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="24" height="24">
                    <path
                        d="M24,3c0,.55-.45,1-1,1H1c-.55,0-1-.45-1-1s.45-1,1-1H23c.55,0,1,.45,1,1ZM15,20h-6c-.55,0-1,.45-1,1s.45,1,1,1h6c.55,0,1-.45,1-1s-.45-1-1-1Zm4-9H5c-.55,0-1,.45-1,1s.45,1,1,1h14c.55,0,1-.45,1-1s-.45-1-1-1Z" />
                </svg>
            </div>
            <div>
                <search-input v-model="search" @input="searchWine" />
            </div>
            <wine-list :cellarContent="userCellarContent" v-if="userCellarContent.length > 0" />
            <div v-else-if="userCellarContent.length === 0">
                <p>aucun vin n'a été trouvé</p>
            </div>
        </section>
    </MainLayout>
</template>

