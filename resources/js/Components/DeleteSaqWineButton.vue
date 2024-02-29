<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    isDeleteVisible: Boolean
});

const deleteWine = () => {
    console.log('delete wine');
};

</script>

<template>
    <button v-if="isDeleteVisible" type="button" @click="deleteWine" class="button-delete">
         Supprimer
    </button>
</template>
