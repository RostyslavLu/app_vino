<script setup>
import { defineProps } from 'vue';
import AddSaqWineButton from '@/Components/AddSaqWineButton.vue';
import UpdateSaqWineButton from './UpdateSaqWineButton.vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    },
    isAddVisible: Boolean,
    isUpdateVisible: Boolean
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
        <picture class="wine-image">
            <div class="wine-type" :style="{ backgroundColor: getBackgroundColor(content.type) }"></div>
            <source :srcset="content.url_image" type="image/webp" />
            <img :src="content.url_image" :alt="content.name" />
        </picture>
        <div class="content-info">
            <h3>{{ content.name }}</h3>
            <div class="wine-details">
                <div class="wine-info">
                    <p>{{ content.country }}</p>
                </div>
                <div class="wine-quantity">
                    <AddSaqWineButton :isAddVisible="isAddVisible" :id="content.id"/>
                    <UpdateSaqWineButton :isUpdateVisible="isUpdateVisible" :quantity="quantity" :id="content.id"/>
                </div>
            </div>
        </div>
</template>
