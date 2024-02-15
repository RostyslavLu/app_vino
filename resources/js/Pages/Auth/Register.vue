<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryRegisterButton from '@/Components/PrimaryRegisterButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    cellar_name: '',
    cellar_description: '',
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
    <WhiteLayout>
        <Head title="Inscription" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name"/>

                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="nom"
                />

                <InputError class="" :message="form.errors.name" />
            </div>

            <div class="">
                <InputLabel for="email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autocomplete="username"
                    placeholder="courriel"
                />

                <InputError class="" :message="form.errors.email" />
            </div>

            <div class="">
                <InputLabel for="cellar_name" />

                <TextInput
                    id="cellar_name"
                    type="text"
                    v-model="form.cellar_name"
                    autocomplete="nom du cellier"
                    placeholder="nom du cellier"
                />

                <InputError class="" :message="form.errors.cellar_name" />
            </div>

            <div class="">
                <InputLabel for="cellar_description" />

                <TextInput
                    id="cellar_description"
                    type="text"
                    v-model="form.cellar_description"
                    autocomplete="description"
                    placeholder="description du cellier"
                />

                <InputError class="" :message="form.errors.cellar_description" />
            </div>

            <div class="">
                <InputLabel for="password"/>

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    placeholder="mot de passe"
                />

                <InputError class="" :message="form.errors.password" />
            </div>

            <div class="">
                <InputLabel for="password_confirmation"/>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    placeholder="confirmer le mot de passe"
                />

                <InputError class="" :message="form.errors.password_confirmation" />
            </div>
                <PrimaryRegisterButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sauvegarder
                </PrimaryRegisterButton>
        </form>
    </WhiteLayout>
</template>






