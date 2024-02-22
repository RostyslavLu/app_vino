<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AddWineCellar from '@/Layouts/AddWineCellar.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SearchInput from '@/Components/SearchInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const search = ref('');

const searchWineSaq = () => {
    console.log(search.value);
};
</script>

<template>
    <Head title="Ajouter un vin à mon cellier" />
        <AddWineCellar class="black-container add-wine">
            <template #header>
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

                </div>
            </template>

        </AddWineCellar>
</template>
