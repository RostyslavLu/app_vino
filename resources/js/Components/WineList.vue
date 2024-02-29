<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import WineListItem from '@/Components/WineListItem.vue'
import WineDetail from '@/Components/WineDetail.vue';

const props = defineProps({
    cellarContent: {
        type: Array,
        required: true
    },
    wines:{
        type: Object,
        required: true
    },
    isAddVisible: Boolean,
    isUpdateVisible: Boolean,
    quantity: Number,
    isDeleteVisible: Boolean
});

const showDetailStates = ref({});

const toggleDetail = (id) => {
    showDetailStates.value[id] = !showDetailStates.value[id];
}

</script>

<template v-if="cellarContent">
    <ul class="cellar-content">
        <!-- s'il n'y a rien dans la liste de vins -->
        <li v-if="!cellarContent.length">
            Aucun résultat
        </li>
        <!-- la liste des vins -->
        <li v-for="content in cellarContent">
            <WineListItem :isAddVisible="isAddVisible" :isUpdateVisible="isUpdateVisible" :isDeleteVisible="isDeleteVisible" :wines="wines" :content="content" :quantity="content.quantity" v-if="!showDetailStates[content.id]" />
            <WineDetail :isAddVisible="isAddVisible" :isUpdateVisible="isUpdateVisible" :isDeleteVisible="isDeleteVisible"  :quantity="content.quantity" :content="content" v-else />
            <!-- Le toggle -->
            <div class="flex-row">
                <button class="invisible" @click="toggleDetail(content.id)" v-if="!showDetailStates[content.id]">
                    <!-- plus square -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                </button>
                <button class="invisible" @click="toggleDetail(content.id)" v-else>
                    <!-- minus square -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                </button>
                <div class="line"></div>
            </div>
        </li>
    </ul>

    <!-- Pagination -->
    <div class="pagination">
        <!-- reculer d'une page -->
        <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">
            <!-- https://feathericons.dev/?search=chevron-left&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50"  class="main-grid-item-icon" fill="none" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <polyline points="15 18 9 12 15 6" :fill="isAddVisible ? 'var(--accent-light)' : 'var(--primary)'"/>
            </svg>
        </Link>

        <!-- nombre de pages -->
        page {{ wines.current_page }} de {{ wines.last_page }} pages

        <!-- avancer d'une page -->
        <Link v-if="wines.next_page_url" :href="wines.next_page_url">
            <!-- https://feathericons.dev/?search=chevron-right&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50" class="main-grid-item-icon" fill="none" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <polyline points="9 18 15 12 9 6" :fill="isAddVisible ? 'var(--accent-light)' : 'var(--primary)'"/>
            </svg>
        </Link>
    </div>
</template>
