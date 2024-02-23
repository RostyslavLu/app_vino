<script setup>
import { onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const closeOnOutsideClick = (e) => {
    if (e.target === e.currentTarget) {
        close();
    }
};
</script>

<template>
    <Teleport to="body">
        <div v-show="show" class="modal" scroll-region @click="closeOnOutsideClick">
            <div v-show="show" class="__container">
                <div class="__content">
                    <slot v-if="show" />
                </div>
            </div>
        </div>
    </Teleport>
</template>