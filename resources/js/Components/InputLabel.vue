<script setup>
defineProps({
    value: {
        type: String,
    },
    required: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <label>
        <span v-if="value">{{ value }}<span v-if="required">&nbsp;&#42;</span></span>
        <span v-else><slot /></span>
    </label>
</template>
