<script setup>
import { Link } from '@inertiajs/vue3';
import InputLabel from './InputLabel.vue';
import NumberInput from './NumberInput.vue';

</script>
<template>
    <form class="button-content">
        <InputLabel for="quantity">
            <NumberInput v-model="quantity" />
        </InputLabel>
        <Link :href="route('cellar-content.store', {cellar_content: 1})" class="button-add-wine">Ajouter</Link>
    </form>
    <slot></slot>
</template>
