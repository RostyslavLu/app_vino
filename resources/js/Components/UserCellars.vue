<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import SearchInput from './SearchInput.vue';
import SelectInput from './SelectInput.vue';
import WineList from './WineList.vue';

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

onMounted(() => {
  fetchUserCellarContent({ target: { value: selectedCellar.value } });
});

fetchUserCellars();
</script>

<template>
    <div class="user-cellars">
        <select-input v-model="selectedCellar" :options="userCellars" @change="fetchUserCellarContent($event)"></select-input>
    </div>
    <div>
        <search-input v-model="search" @input="searchWine" />
    </div>
    <wine-list :cellarContent="userCellarContent" v-if="userCellarContent.length > 0" />
    <div v-else-if="userCellarContent.length === 0">
        <p>aucun vin n'a été trouvé</p>
    </div>
</template>
