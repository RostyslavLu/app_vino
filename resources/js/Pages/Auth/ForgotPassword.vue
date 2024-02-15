<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <WhiteLayout class="white-container">
        <template v-slot:header>
            Mot de passe
        </template>

        <section class="white-text">
            <h2>Mot de passe oublié ?</h2>
            <p>Pas de problème. Nous vous enverrons un lien de réinitialisation de votre mot de passe sur l'adresse email que vous avez saisie lors de votre première connexion.</p>
        </section>

        <form @submit.prevent="submit">
            <div>
                <InputError class="input-error" :message="form.errors.email" />

                <InputLabel for="email"/>
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    placeholder="votre adresse e-mail liée à votre compte"
                    autocomplete="username"
                />

            </div>

            <div >
                <PrimaryButton class="button red">
                    Réinitialiser
                </PrimaryButton>
            </div>
        </form>
    </WhiteLayout>
</template>
