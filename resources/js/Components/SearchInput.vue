<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: String,
    searchInput: Boolean,
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};

// garder le focus sur l'input
const vFocus = {
  mounted: (el) => el.focus()
}
</script>

<template>
    <input
    v-focus
    type="search"
    :value="modelValue"
    placeholder="Rechercher un vin"
    @input="updateValue($event)"
    />
</template>
