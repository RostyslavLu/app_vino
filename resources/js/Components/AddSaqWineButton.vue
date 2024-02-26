<script setup>
import { Link } from '@inertiajs/vue3';
import InputLabel from './InputLabel.vue';
import NumberInput from './NumberInput.vue';
const props = defineProps({
    id: {
        type: Number,
        required: true
    }
});

const submit = () => {
    form.post(route('cellar-content.store', {cellar_content: id}), {
        onFinish: () => form.reset('quantity'),
    });
};

</script>
<template>
    <form @submit.prevent="submit" class="button-content">
        <InputLabel for="quantity">
            <NumberInput v-model="quantity" />
        </InputLabel>
        <button class="button-add-wine">Ajouter</button>
    </form>
    <slot></slot>
</template>
