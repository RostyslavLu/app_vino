<template>
    <div v-show="message">
        <p class="input-error">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<style scoped>

@import '@/../css/styles.css';   

</style>
