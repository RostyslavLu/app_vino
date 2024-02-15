<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <WhiteLayout class="white-container">
        <template v-slot:header>
            mot de passe
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputError class="" :message="form.errors.email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                />

            </div>

            <div class="">
                <InputError class="" :message="form.errors.password" />

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autofocus
                    placeholder="nouveau courriel"
                    autocomplete="new-password"
                />

            </div>

            <div class="">
                <InputError class="" :message="form.errors.password_confirmation" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    placeholder="nouveau courriel"
                    autocomplete="new-password"
                />

            </div>

            <div class="">
                <PrimaryButton>
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </WhiteLayout>
</template>
