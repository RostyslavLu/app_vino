<script setup>
import { ref, watchEffect } from 'vue';

const props = defineProps({
    modelValue: String,
    options: {
        type: Array,
        default: () => []
    }
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>

<template>
    <select :value="modelValue" @input="updateValue($event)">
        <option v-for="cellar in options" :value="cellar.id" :key="cellar.id">
            {{ cellar.name }}
        </option>
    </select>
</template>
