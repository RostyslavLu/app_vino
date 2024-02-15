<script setup>
import FondBlancLayout from '@/Layouts/FondBlancLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

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
    <FondBlancLayout>
        <template v-slot:header>
            Mot de passe oublié?
        </template>
        <section>
            Mot de passe oublié? Pas de problème. Dites-nous simplement votre adresse e-mail 
            et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
        </section>

        <div v-if="status" class="">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                />

                <InputError class="" :message="form.errors.email" />
            </div>
            
            <!-- commentaire: J'ai enlevé une classe tailwind, 
                et ajouté une classe imaginaire, 
                qu'on peut remplacer si on utilise ce formulaire. 
                ce code évalue si form.processing est vrai, 
                et si c'est vrai, la class "myCssClass" est appliquée au bouton -->

            <div class="">
                <PrimaryButton :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </FondBlancLayout>
</template>
