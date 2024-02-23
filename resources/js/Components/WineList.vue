<script setup>
import { Link, usePage } from '@inertiajs/vue3';

import { defineProps } from 'vue';
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
/* //les vins 
const  wines = usePage().props.wines;

//les infos pour la pagination
const cellarContent = usePage().props.wines.data; */

// fonction pour marquer la couleur du type de vin
const getBackgroundColor = (wineColor) => {
    switch (wineColor) {
        case 'rouge':
            return 'var(--wine-red)';
        case 'blanc':
            return 'var(--wine-white)';
        case 'rosé':
            return 'var(--wine-rose)';
        default:
            return 'transparent';
    }
};
</script>

<template v-if="cellarContent">
    <ul class="cellar-content">
        <li v-if="!cellarContent.length">
            Chargement...
        </li>
        <li v-for="content in cellarContent" :key="content.id">
            <picture class="wine-image">
                <source :srcset="content.url_image" type="image/webp" />
                <img :src="content.url_image" :alt="content.name" />
                <div class="wine-type" :style="{ backgroundColor: getBackgroundColor(content.type) }"></div>
            </picture>
            <div class="content-info">
                <h3>{{ content.name }}</h3>
                <div class="wine-details">
                    <div class="wine-info">
                        <p>{{ content.country }}</p>
                        <p>{{ content.region }}</p>
                    </div>
                    <div class="wine-quantity">
                        <div>{{ content.quantity }}</div>
                    </div>
                </div>
                <span v-if="content.cellar_name">Cellier:&nbsp;<strong>{{ content.cellar_name }}</strong></span>
            </div>
        </li>
    </ul>
    <!-- Pagination -->
    <div>
        <Link v-if="wines.prev_page_url" :href="wines.prev_page_url">Previous</Link>
        page {{ wines.current_page }} of {{ wines.last_page }} pages 
        <Link v-if="wines.next_page_url" :href="wines.next_page_url">Next</Link>
        <!-- nombre de pages -->
    </div>
</template>
