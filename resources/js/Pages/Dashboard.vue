<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SearchVineCellar from '@/Components/SearchVineCellar.vue';
import UserCellars from '@/Components/UserCellars.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Mon compte" />

    <MainLayout>
        <section class="user-account">
            <UserCellars />
        </section>
    </MainLayout>
</template>
