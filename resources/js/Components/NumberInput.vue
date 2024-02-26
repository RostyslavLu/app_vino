<script setup>
import { ref } from 'vue';

const model = defineModel({
    type: Number,
    required: true,
    default: 1
});
</script>

<template>
    <input type="number" v-model="model" min="1" />
</template>
