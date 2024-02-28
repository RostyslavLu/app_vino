<script setup>
import { defineProps, ref } from 'vue';

const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    isUpdateVisible: Boolean,
    quantity: Number
});
</script>

<template>
    <form @submit.prevent="submit" v-if="isUpdateVisible">
        <div class="update-container">

            <div class="quantity-arrows">
                <button type="button" @click="form.quantity++">
                <svg id="Calque_2" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path d="m44.73,9.01l25.22,33.78c3.69,4.94.16,11.97-6,11.97H13.5c-6.16,0-9.69-7.03-6-11.97L32.72,9.01c3-4.01,9.01-4.01,12,0Z" style="fill: transparent; stroke: var(--primary); stroke-miterlimit:10; stroke-width:12px;"/>
                    </g>
                </svg>
            </button>
            <div class="update-wine-quantity">1</div>
            <button type="button" @click="form.quantity > 0 && form.quantity--">
                <svg id="Calque_2" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path d="m32.72,51.75L7.5,17.97c-3.69-4.94-.16-11.97,6-11.97h50.44c6.16,0,9.69,7.03,6,11.97l-25.22,33.78c-3,4.01-9.01,4.01-12,0Z" style="fill: transparent; stroke:var(--primary); stroke-miterlimit:10; stroke-width:12px;"/>
                    </g>
                </svg>
            </button>
            </div>
        </div>
    </form>
</template>
