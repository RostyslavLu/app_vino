<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import UpdateCellarForm from './Partials/UpdateCellarForm.vue';
import NavigationMenu from '@/Components/NavigationMenu.vue'; // Add this line
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

    <WhiteLayout class="white-layout" :showNavigation="true" :userCellar="cellar">
        <template #header>
            <h1>Profil</h1>
        </template>
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
    </WhiteLayout>
</template>
