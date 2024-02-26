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
    <!-- Pagination -->
    <div>
        <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">Précédente</Link>
        <!-- nombre de pages -->
        page {{ wines.current_page }} de {{ wines.last_page }} pages
        <Link v-if="wines.next_page_url" :href="wines.next_page_url">Prochaine</Link>
    </div>
    <ul class="cellar-content">
        <li v-if="!cellarContent.length">
            Aucun résultat
        </li>
        <WineListItem v-for="content in cellarContent" :key="content.id" :content="content" />
    </ul>
    <!-- Pagination -->
    <div>
        <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">Précédente</Link>
        <!-- nombre de pages -->
        page {{ wines.current_page }} de {{ wines.last_page }} pages
        <Link v-if="wines.next_page_url" :href="wines.next_page_url">Prochaine</Link>
    </div>
</template>
