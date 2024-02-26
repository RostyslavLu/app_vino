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

const submit = () => {
    if (form.quantity <= 0) {
        return form.quantity = 1;
    }
    form.post(route('cellar-content.store'), {
        onFinish: () => form.reset('quantity'),
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
            <NumberInput v-model="form.quantity" />
        </InputLabel>
        <button type="submit" class="button-add-wine">Ajouter</button>
    </form>
    <slot></slot>
</template>
