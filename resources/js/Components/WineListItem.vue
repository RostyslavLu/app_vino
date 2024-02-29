<script setup>
import { defineProps } from 'vue';
import AddSaqWineButton from '@/Components/AddSaqWineButton.vue';
import UpdateSaqWineButton from '@/Components/UpdateSaqWineButton.vue';
import DeleteSaqWineButton from '@/Components/DeleteSaqWineButton.vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    },
    isAddVisible: Boolean,
    isUpdateVisible: Boolean,
    quantity: Number,
    isDeleteVisible: Boolean
});

// fonction pour marquer la couleur du type de vin
const getBackgroundColor = (wineColor) => {
    switch (wineColor) {
        case 'rouge':
            return 'var(--red)';
        case 'blanc':
            return 'var(--yellow)';
        case 'rosé':
            return 'var(--pink)';
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
                    <UpdateSaqWineButton :isUpdateVisible="isUpdateVisible" :wineQuantity="quantity" :id="content.id"/>
                    <DeleteSaqWineButton :isDeleteVisible="isDeleteVisible" :id="content.id"/>
                </div>
            </div>
        </div>
</template>
