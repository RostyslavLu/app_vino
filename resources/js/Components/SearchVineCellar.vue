<template>
    <div class="search">
        <input type="search" v-model="searchText" placeholder="Search..." @input="fetchData" />
        <ul>
            <li v-for="item in items" :key="item.id">
                {{ item.name }}
            </li>
        </ul>
    </div>
</template>

<script >
import axios from 'axios';
export default {
    data() {
        return {
            searchText: '',
            items: [],
        };
    },
    methods: {
        fetchData() {
            if (this.searchText === '') {
                this.items = [];
                return;
            }
            axios.get(route('search.index'), {
                params: {
                    query: this.searchText
                }
            })
                .then(response => {
                    this.items = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
