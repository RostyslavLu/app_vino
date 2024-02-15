<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { useAttrs } from 'vue';

const attrs = useAttrs();
</script>

<template>
    <div v-bind="attrs">
        <header class="white-header">
            <div class="logo">
                <Link href="/">
                    <ApplicationLogo/>
                </Link>
            </div>
            
            <!-- un slot pour l'entête de la page -->
            <h1 v-if="$slots.header">
                <slot name="header" />
            </h1>
        </header>
        <!-- le slot principale, pour la page -->
        <main class="white-main-container">
                <slot /> 
        </main>
    </div>
</template>