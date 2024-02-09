<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
/* il y a variables ici qui rassemblent des groupes de classes,  qui sont affichées de façon dynamique. Ce sont des classes tailwind. Je les gardes seulement pour qu'on ait une example de comment c'est fait*/
const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: String,
        default: 'py-1 bg-white',
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
    return {
        48: 'w-48',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';
    } else if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';
    } else {
        return 'origin-top';
    }
});

const open = ref(false);
</script>

<template>
    <div class="">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="" @click="open = false"></div>

        <Transition
            enter-active-class=""
            enter-from-class=""
            enter-to-class=""
            leave-active-class=""
            leave-from-class=""
            leave-to-class=""
        >
            <div
                v-show="open"
                class=""
                :class="[widthClass, alignmentClasses]"
                style="display: none"
                @click="open = false"
            >
                <div class="" :class="contentClasses">
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>
