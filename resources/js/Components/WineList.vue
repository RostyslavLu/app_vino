<script setup>
const props = defineProps({
    cellarContent: {
        type: Array,
        required: true
    }
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
    <div v-if="cellarContent" >
        <ul class="cellar-content">
            <li v-for="content in cellarContent" :key="content.id">
                <picture class="wine-image" >
                    <source :srcset="content.url_image" type="image/webp" />
                    <img :src="content.url_image" :alt="content.name" />
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
                            <div>{{ content.quantity }}</div>
                        </div>
                    </div>
                    <span v-if="content.cellar_name">Cellier:&nbsp;<strong>{{ content.cellar_name }}</strong></span>
                </div>
            </li>
        </ul>
    </div>
</template>
