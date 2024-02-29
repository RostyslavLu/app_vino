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
    <div v-if="isDeleteVisible">
        <button type="button" @click="deleteWine">
         Supprimer
        </button>
    </div>
</template>
