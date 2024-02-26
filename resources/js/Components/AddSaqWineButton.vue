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
const initialQuantity = 1;
const validateQuantity = () => {
    if (form.quantity < 1 || isNaN(form.quantity)) {
        form.quantity = initialQuantity;
    } else {
        initialQuantity = form.quantity;
    }
};
// fonction pour soumettre le formulaire
let scrollPosition = 0;

const submit = () => {
    // sauvegarder la position de la page pour la rétablir après la soumission du formulaire
    scrollPosition = window.pageYOffset;
    form.post(route('cellar-content.store'), {
        onStart: () => {
            // sauvegarder la position de la page pour la rétablir après la soumission du formulaire
            window.scrollTo(0, scrollPosition);
        },
        onFinish: () => {
            form.quantity = 1;
            // rétablir la position de la page après la soumission du formulaire
            window.scrollTo(0, scrollPosition);
        }
    });
};

</script>
<template>
    <form @submit.prevent="submit" class="button-content">
        <div class="quantity-arrows">
            <button type="button" @click="form.quantity++" class="quantity-arrow">
                <svg width="20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path stroke="white" fill-rule="evenodd" d="M5.6 13.7A2 2 0 0 0 7 17h10a2 2 0 0 0 1.5-3.3l-4.9-5.9a2 2 0 0 0-3 0l-5 6Z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button type="button" @click="form.quantity > 1 && form.quantity--" class="quantity-arrow">
                <svg width="20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path stroke="white" fill-rule="evenodd" d="M18.4 10.3A2 2 0 0 0 17 7H7a2 2 0 0 0-1.5 3.3l4.9 5.9a2 2 0 0 0 3 0l5-6Z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <InputLabel for="quantity">
            <NumberInput v-model="form.quantity" @blur="validateQuantity" />
        </InputLabel>
        <button type="submit" class="button-add-wine">Ajouter</button>
    </form>
    <slot></slot>
</template>
