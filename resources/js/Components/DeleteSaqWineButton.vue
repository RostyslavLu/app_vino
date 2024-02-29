<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    isDeleteVisible: Boolean
});
const id = ref(props.id);
const deleteWine = async() => {
    router.get(`/cellar-content/${id.value}`);
};

</script>

<template>
    <button v-if="isDeleteVisible " type="button" @click="deleteWine" class="button-delete">
         Supprimer
    </button>
</template>
