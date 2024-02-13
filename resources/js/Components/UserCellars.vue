<template>
    <div class="user-cellars">
        <select v-model="selectedCellar" @change="fetchUserCellarContent($event)">
            <option v-for="cellar in userCellars" :key="cellar.id" :value="cellar.id">
                {{ cellar.name }}
            </option>
        </select>
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
                <article class="wine-info">
                    <p>{{ content.wine_name }}</p>
                    <p>{{ content.country }}</p>
                </article>
                <article class="wine-quantity">
                    <span>&#8593;</span>
                    <div>{{ content.quantity }}</div>
                    <span>&#8595;</span>
                </article>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import SearchInput from './SearchInput.vue';

const userCellars = ref([]);
const userCellarContent = ref([]);
const search = ref('');

const fetchUserCellars = async () => {
    const response = await axios.get(route('cellars.userCellars'));
    userCellars.value = response.data;
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
    userCellarContent.value = response.data;
};

fetchUserCellars();
</script>
