<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
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
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class=""
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="" :message="form.errors.email" />
            </div>
            
            <!-- commentaire: J'ai enlevé une classe tailwind, et ajouté une classe imaginaire, qu'on peut remplacer si on utilise ce formulaire. ce code évalue si form.processing est vrai, et si c'est vrai, la class "myCssClass" est appliquée au bouton -->

            <div class="">
                <PrimaryButton :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
