<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
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

    <WhiteLayout class="white-container">
        <template #header>
            <h2>mon profil</h2>
        </template>
                <section>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
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
