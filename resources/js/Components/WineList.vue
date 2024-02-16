<script setup>
import { ref } from 'vue';

const cellarContent = ref([]);

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
</script>

<template>
    <ul class="cellar-content">
        <li v-for="content in cellarContent" :key="content.id">
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
                <span v-if="content.cellar_name">Cellier:&nbsp;{{ content.cellar_name }}</span>
            </div>
        </li>
    </ul>
</template>

