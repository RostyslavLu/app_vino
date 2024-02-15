<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import SearchInput from './SearchInput.vue';
import SelectInput from './SelectInput.vue';

const userCellars = ref([]);
const userCellarContent = ref([]);
const search = ref('');
const selectedCellar = ref(1);

const fetchUserCellars = async () => {
    const response = await axios.get(route('cellars.userCellars'));
    userCellars.value = response.data;
    console.log(userCellars.value);
};

const fetchUserCellarContent = async (event) => {
    const response = await axios.get(route('cellars.userCellarContent', event.target.value));
    userCellarContent.value = response.data;
};

const getBackgroundColor = (wineColor) => {
    switch (wineColor) {
        case 'rouge':
            return '#ff0000';
        case 'blanc':
            return '#ffffff';
        case 'rosé':
            return '#ff69b4';
        default:
            return 'transparent';
    }
};

const searchWine = async () => {
    if (search.value === '') {
        userCellarContent.value = [];
        return;
    }
    const response = await axios.get(route('cellars.searchWineInUserCellars', search.value));
    //console.log(response);
    userCellarContent.value = response.data;
    //console.log(userCellarContent.value);
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
    <div v-if="userCellarContent" >
        <ul class="cellar-content">
            <li v-for="content in userCellarContent" :key="content.id">
                <picture class="wine-image" >
                    <source :srcset="content.url_image" type="image/webp" />
                    <img :src="content.url_image" alt="content.name" />
                    <div class="wine-type" :style="{backgroundColor: getBackgroundColor(content.type)}"></div>
                </picture>
                <div class="content-info">
                    <h3>{{ content.wine_name }}</h3>
                    <div class="wine-details">
                        <div class="wine-info">
                            <p>{{ content.country }}</p>
                            <p>{{ content.region }}</p>
                        </div>
                        <div class="wine-quantity">
                            <span>&#8593;</span>
                            <div>{{ content.quantity }}</div>
                            <span>&#8595;</span>
                        </div>
                    </div>
                    <span>{{ content.cellar_name }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
