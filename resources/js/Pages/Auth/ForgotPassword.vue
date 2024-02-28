<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryRegisterButton from '@/Components/PrimaryRegisterButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';

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
    <Head title="Mot de passe oublié" />
    <WhiteLayout class="white-layout">

        <template #header>
            Mot de passe
        </template>

        <section class="__text">
            <div v-if="status" class="input-success">
            {{ status }}
            </div>
            <h2>Mot de passe oublié ?</h2>
            <p>Pas de problème. Nous vous enverrons un lien de réinitialisation de votre mot de passe sur l'adresse email que vous avez saisie lors de votre première connexion.</p>
        </section>

        <form @submit.prevent="submit">
            <div>
                <InputError :message="form.errors.email" />
                <InputLabel for="email" value="Votre courriel liée à votre compte" required="true"/>
                <TextInput
                    id="email"
                    type="text"
                    v-model="form.email"
                    autofocus
                    placeholder="nom@example.com"
                    autocomplete="username"
                />

            </div>

            <div >
                <PrimaryRegisterButton>
                    Réinitialiser
                </PrimaryRegisterButton>
            </div>
        </form>
    </WhiteLayout>
</template>
