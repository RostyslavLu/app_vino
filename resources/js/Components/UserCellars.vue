<template>
    <div class="user-cellars">
        <select v-model="selectedCellar" @change="fetchUserCellarContent($event)">
            <option v-for="cellar in userCellars" :key="cellar.id" :value="cellar.id">
                {{ cellar.name }}
            </option>
        </select>
    </div>
    <div v-if="userCellarContent" class="user-cellars">
        <ul class="cellar-content">
            <li v-for="content in userCellarContent" :key="content.id">
                <picture class="wine-image">
                    <source :srcset="content.url_image" type="image/webp" />
                    <img :src="content.url_image" alt="content.name" />
                </picture>
                <article class="wine-info">
                    <h2>{{ content.wine_name }}</h2>
                    <p>{{ content.type }}</p>
                    <p>{{ content.country }}</p>
                </article>
                <article class="wine-quantity"><div>{{ content.quantity }}</div></article>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userCellars: [],
            userCellarContent: [],
        };
    },
    created() {
        this.fetchUserCellars();
    },
    methods: {
        fetchUserCellars() {
            axios.get(route('cellars.userCellars'))
                .then(response => {
                    this.userCellars = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchUserCellarContent(event) {

            axios.get(route('cellars.userCellarContent', event.target.value))
                .then(response => {
                    this.userCellarContent = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
