<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import WineListItem from '@/Components/WineListItem.vue'

const props = defineProps({
    cellarContent: {
        type: Array,
        required: true
    },
    wines:{
        type: Object,
        required: true
    }
});
</script>

<template v-if="cellarContent">
    <ul class="cellar-content">
        <li v-if="!cellarContent.length">
            Aucun résultat
        </li>
        <WineListItem v-for="content in cellarContent" :key="content.id" :content="content" />
    </ul>

    <!-- Pagination -->
    <div class="pagination">

        <!-- reculer d'une page -->
        <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">
            <!-- https://feathericons.dev/?search=chevron-left&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"  class="main-grid-item-icon" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <polyline points="15 18 9 12 15 6" />
            </svg>
        </Link>

        <!-- nombre de pages -->
        page {{ wines.current_page }} de {{ wines.last_page }} pages

        <!-- avancer d'une page -->
        <Link v-if="wines.next_page_url" :href="wines.next_page_url">
            <!-- https://feathericons.dev/?search=chevron-right&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <polyline points="9 18 15 12 9 6" />
            </svg>
        </Link>
    </div>
</template>
