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
    form.post(route('cellar-content.store'), {
        onFinish: () => form.reset('quantity'),
    });
};

</script>
<template>
    <form @submit.prevent="submit" class="button-content">
        <InputLabel for="quantity">
            <NumberInput v-model="form.quantity" />
        </InputLabel>
        <button type="submit" class="button-add-wine">Ajouter</button>
    </form>
    <slot></slot>
</template>
