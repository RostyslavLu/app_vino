<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        /* valeur temporaire */
        default: '80vw',
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


const maxWidthClass = '80vw';

/* const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
    }[props.maxWidth];
}); */
</script>

<template>
    <Teleport to="body">
        <Transition leave-active-class="">
            <div v-show="show" class="modal-overlay" scroll-region>
                <Transition
                    enter-active-class=""
                    enter-from-class=""
                    enter-to-class=""
                    leave-active-class=""
                    leave-from-class=""
                    leave-to-class=""
                >
                    <div v-show="show" class="modal-overlay" @click="close">
                        <div class="" />
                    </div>
                </Transition>

                <Transition
                    enter-active-class=""
                    enter-from-class=""
                    enter-to-class=""
                    leave-active-class=""
                    leave-from-class=""
                    leave-to-class=""
                >
                    <div
                        v-show="show"
                        class="modal-container"
                    >
                        <div class="modal">
                            <slot v-if="show" />
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
