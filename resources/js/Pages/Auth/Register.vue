<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class=""
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="" :message="form.errors.name" />
            </div>

            <div class="">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class=""
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="" :message="form.errors.email" />
            </div>

            <div class="">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class=""
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="" :message="form.errors.password" />
            </div>

            <div class="">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class=""
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="" :message="form.errors.password_confirmation" />
            </div>

            <div class="">
                <Link
                    :href="route('login')"
                    class=""
                >
                    Already registered?
                </Link>
                
                <!-- commentaire: J'ai enlevé une classe tailwind, et ajouté une classe imaginaire, qu'on peut remplacer si on utilise ce formulaire. ce code évalue si form.processing est vrai, et si c'est vrai, la class "myCssClass" est appliquée au bouton -->
                <PrimaryButton class="" :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
