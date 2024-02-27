<script setup>
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import { Link } from '@inertiajs/vue3';
import { useAttrs } from 'vue';

const attrs = useAttrs();
</script>

<template>
    <!-- binder pour ajouter une classe parent diférente dans chaque page vue -->
    <div v-bind="attrs">
        <header>

                <Link href="/">
                    <ApplicationLogoWhite class="logo"/>
                </Link>
                
            <!-- un slot pour l'entête de la page -->
            <h1 v-if="$slots.header">
                <slot name="header" />
            </h1>
        </header>
        <!-- le slot principale, pour la page -->
        <main class="__main-container">
                <slot /> 
        </main>
    </div>
</template>