<script setup>
import FondBlancLayout from '@/Layouts/FondBlancLayout.vue';
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

    <FondBlancLayout>
        <template #header>
            <h2 class="namereg">vos informations</h2>
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
    </FondBlancLayout>
</template>
