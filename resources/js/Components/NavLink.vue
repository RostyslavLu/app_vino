<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});
/* j'ai mis "customClass" et otherCustomClass pour indiquer que j'ai enlevé des classes tailwind ici, et qu'on pourait y mettre nos propres classes */
const classes = computed(() =>
    props.active
        ? 'customClass'
        : 'otherCustomClass'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
