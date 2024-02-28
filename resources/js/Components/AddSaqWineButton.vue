<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import InputLabel from './InputLabel.vue';
import NumberInput from './NumberInput.vue';
import { defineProps, toRefs } from 'vue';

const props = defineProps({
    id: {
        type: Number,
        required: true
    }
});

const { id } = toRefs(props);

const form = useForm({
    'quantity': 1,
    'vintage': '',
    'notes': '',
    'saq_wines_id': id,
});
// fonction pour valider la quantité ou cas ou l'utilisateur entre une quantité négative ou un 0

const validateQuantity = () => {
    if (form.quantity < 1 || isNaN(form.quantity)) {
        form.quantity = initialQuantity;
    } else {
        initialQuantity = form.quantity;
    }
};
// fonction pour soumettre le formulaire

const submit = () => {
    form.post(route('cellar-content.store'), {
        onFinish: () => {
            form.quantity = 1;
        }
    });
};

</script>
<template>
    <form @submit.prevent="submit" class="button-content">
        <div class="quantity-arrows">
            <button type="button" @click="form.quantity++">
                <svg id="Calque_2" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path d="m44.73,9.01l25.22,33.78c3.69,4.94.16,11.97-6,11.97H13.5c-6.16,0-9.69-7.03-6-11.97L32.72,9.01c3-4.01,9.01-4.01,12,0Z" style="fill:#1d1d1b; stroke:#fff; stroke-miterlimit:10; stroke-width:12px;"/>
                    </g>
                </svg>
            </button>
            <button type="button" @click="form.quantity > 1 && form.quantity--">
                <svg id="Calque_2" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.45 60.76">
                    <g id="Calque_1-2">
                        <path d="m32.72,51.75L7.5,17.97c-3.69-4.94-.16-11.97,6-11.97h50.44c6.16,0,9.69,7.03,6,11.97l-25.22,33.78c-3,4.01-9.01,4.01-12,0Z" style="fill:#1d1d1b; stroke:#fff; stroke-miterlimit:10; stroke-width:12px;"/>
                    </g>
                </svg>
            </button>
        </div>
        <InputLabel for="quantity">
            <NumberInput v-model="form.quantity" @blur="validateQuantity" @keydown.up.prevent="form.quantity++" @keydown.down.prevent="form.quantity > 1 && form.quantity--"/>
        </InputLabel>
        <button type="submit" :disabled="form.processing" class="button-add-wine">Ajouter</button>
    </form>
    <slot></slot>
</template>
