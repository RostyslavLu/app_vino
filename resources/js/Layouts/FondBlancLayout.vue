<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link,  } from '@inertiajs/vue3';
</script>

<template>
    <header class="logo">
        <Link href="/">
            <ApplicationLogo/>
        </Link>
        <!-- un slot pour l'entête de la page -->
        <h1 v-if="$slots.header">
            <slot name="header" />
        </h1>
    </header>
    
    <main class="auth-container">

        <!-- le slot principale, pour la page -->
        <div
        >
            <slot /> 
        </div>

    </main>
</template>
