<script setup>
import { defineProps, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    quantity: Number,
    isUpdateVisible: Boolean,
    wineQuantity: Number,
});
const id = ref(props.id);
const wineQuantity = ref(props.wineQuantity);

const quantity_plus = async() => {
    wineQuantity.value++;
    try {
        const response = await axios.put(`/cellar-content`, {
            saq_wines_id: id.value,
            quantity: wineQuantity.value
        });
        console.log(response);
    } catch (error) {
        console.error(error);
    }


};

const quantity_minus = () => {
    if (wineQuantity.value > 0) {
        wineQuantity.value--;
    }
    try {
        const response = axios.put(`/cellar-content`, {
            saq_wines_id: id.value,
            quantity: wineQuantity.value
        });
        console.log(response);
    } catch (error) {
        console.error(error);
    }
};

</script>

<template>
    <div class="update-container" v-if="isUpdateVisible">

        <div class="quantity-arrows">
            <button type="button" @click="quantity_plus">
                <svg id="Calque_2" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path
                            d="m44.73,9.01l25.22,33.78c3.69,4.94.16,11.97-6,11.97H13.5c-6.16,0-9.69-7.03-6-11.97L32.72,9.01c3-4.01,9.01-4.01,12,0Z"
                            style="fill: transparent; stroke: var(--primary); stroke-miterlimit:10; stroke-width:12px;" />
                    </g>
                </svg>
            </button>
            <div v-if="wineQuantity" class="update-wine-quantity">{{ wineQuantity }}</div>
            <button type="button" @click="quantity_minus">
                <svg id="Calque_2" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path
                            d="m32.72,51.75L7.5,17.97c-3.69-4.94-.16-11.97,6-11.97h50.44c6.16,0,9.69,7.03,6,11.97l-25.22,33.78c-3,4.01-9.01,4.01-12,0Z"
                            style="fill: transparent; stroke:var(--primary); stroke-miterlimit:10; stroke-width:12px;" />
                    </g>
                </svg>
            </button>
        </div>
</div></template>
