<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import UpdateCellarForm from './Partials/UpdateCellarForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profil" />
<div class="dashboard">
    <MainLayout class="" :showNavigation="true" :userCellar="cellar">
        <template #header>
            <h1>Profil</h1>
        </template>
        <article class="__layout">
            <section>
            <UpdateProfileInformationForm />
        </section>
        <section>
            <UpdateCellarForm />
        </section>
        <section>
            <UpdatePasswordForm />
        </section>
        <section>
            <DeleteUserForm />
        </section>

        </article>

    </MainLayout>


</div>
    
</template>
