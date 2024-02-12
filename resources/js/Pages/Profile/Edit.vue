<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
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
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Profile</h2>
        </template>

        <div class="">
            <div class="">
                <div class="">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class=""
                    />
                </div>

                <div class="">
                    <UpdatePasswordForm class="" />
                </div>

                <div class="">
                    <DeleteUserForm class="" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
