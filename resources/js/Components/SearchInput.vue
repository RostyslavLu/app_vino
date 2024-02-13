<template>
    <div>
        <input type="search" :value="modelValue" placeholder="Rechercher un vin" @input="updateValue($event)" />
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: String
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>
