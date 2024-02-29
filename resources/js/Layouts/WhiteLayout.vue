<script setup>
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useAttrs } from 'vue';

const page = usePage();
const cellar = page.props.cellar;
const attrs = useAttrs();

defineProps({
    showNavigation: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <div v-bind="attrs" class="white-layout">
        <div class="__layout">
            <header >
                <Link 
                    href="/"
                    ><ApplicationLogoWhite class="logo"/></Link
                >
                <h1><slot name="header"></slot></h1>
            </header>
            
            <!-- le slot principale, pour la page -->
            <main class="__main-container">
                <slot /> 
            </main>
        </div>
    </div>
</template>