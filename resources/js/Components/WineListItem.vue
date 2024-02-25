<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    },
});

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

<template>
    <li>
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
        </div>
    </li>
</template>
