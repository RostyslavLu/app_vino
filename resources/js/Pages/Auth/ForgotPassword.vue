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
    <WhiteLayout class="body-forgot-password">
        <Head title="Mot de passe oublié" />

        <div v-if="status">
            {{ status }}
        </div>

        <div class="text-forgot-password">
            <h2>Mot de passe oublié ?</h2>
            <p>Pas de problème. Nous vous enverrons un lien de réinitialisation de votre mot de passe sur l'adresse email que vous avez saisie lors de votre première connexion.</p>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email"/>
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    placeholder="votre adresse e-mail liée à votre compte"
                    autocomplete="username"
                />

                <InputError class="" :message="form.errors.email" />
            </div>

            <!-- commentaire: J'ai enlevé une classe tailwind,
                et ajouté une classe imaginaire,
                qu'on peut remplacer si on utilise ce formulaire.
                ce code évalue si form.processing est vrai,
                et si c'est vrai, la class "myCssClass" est appliquée au bouton -->

            <div >
                <PrimaryButton class="button red">
                    Réinitialiser
                </PrimaryButton>
            </div>
        </form>
    </WhiteLayout>
</template>
