<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SearchVineCellar from '@/Components/SearchVineCellar.vue';
import UserCellars from '@/Components/UserCellars.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Mon compte" />

    <AuthenticatedLayout>
        <section class="user-account">
            <UserCellars />
        </section>
    </AuthenticatedLayout>
</template>
