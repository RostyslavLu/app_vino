<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryRegisterButton from '@/Components/PrimaryRegisterButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
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
    <Head title="Réinitialisation de mot de passe" />
    <WhiteLayout class="white-container">
        <template v-slot:header>
            mot de passe
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputError class="" :message="form.errors.email" />
                <InputLabel for="email" value="Votre courriel liée à votre compte" />
                <TextInput
                    id="email"
                    type="text"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                />

            </div>

            <div>
                <InputError class="" :message="form.errors.password" />
                <InputLabel for="password" value="Nouveau mot de passe" />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autofocus
                    placeholder="min. 2 caractères et max. 20 caractères."
                    autocomplete="new-password"
                />

            </div>

            <div class="">
                <InputError class="" :message="form.errors.password_confirmation" />
                <InputLabel for="password_confirmation" value="Confirmation du mot de passe" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    placeholder="confirmer le mot de passe saisi ci-dessus"
                    autocomplete="new-password"
                />

            </div>

            <div class="">
                <PrimaryRegisterButton>
                    Réinitialiser le mot de passe
                </PrimaryRegisterButton>
            </div>
        </form>
    </WhiteLayout>
</template>
