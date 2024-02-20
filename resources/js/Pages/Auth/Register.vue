<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryRegisterButton from '@/Components/PrimaryRegisterButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
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
    <WhiteLayout class="white-container">
        <Head title="Inscription" />

        <template v-slot:header>
            Inscription
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputError :message="form.errors.name" />
                <InputLabel
                    for="name"
                    value="Nom"
                    required="true"
                />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="ex. Jean Legrand"
                />

            </div>

            <div>
                <InputError :message="form.errors.email" />
                <InputLabel
                    for="email"
                    value="Courriel"
                    required="true"
                />
                <TextInput
                    id="email"
                    type="text"
                    v-model="form.email"
                    autocomplete="username"
                    placeholder="ex. jean@example.com"
                />

            </div>

            <div>
                <InputError :message="form.errors.cellar_name" />
                <InputLabel for="cellar_name" value="Nom du cellier" />
                <TextInput
                    id="cellar_name"
                    type="text"
                    v-model="form.cellar_name"
                    autocomplete="nom du cellier"
                    placeholder="ex. Château de la Tour"
                />

            </div>

            <div>
                <InputError :message="form.errors.cellar_description" />
                <InputLabel
                    for="cellar_description"
                    value="Description du cellier"
                />
                <TextInput
                    id="cellar_description"
                    type="text"
                    v-model="form.cellar_description"
                    autocomplete="description"
                    placeholder="ex. Cellier de collection de vins rares."
                />

            </div>

            <div>
                <InputError :message="form.errors.password" />
                <InputLabel
                    for="password"
                    value="Mot de passe"
                    required="true"
                />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    placeholder="min. 2 caractères et max. 20 caractères."
                />

            </div>

            <div>
                <InputError class="input-error" :message="form.errors.password_confirmation" />
                <InputLabel
                    for="password_confirmation"
                    value="Confirmation du mot de passe"
                    required="true"
                />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    placeholder="confirmer le mot de passe saisi ci-dessus"
                />

            </div>
            <div>
                <p class="text-required">
                    <span class="required">&#42;</span>&nbsp;Champs obligatoires
                </p>
            </div>
            <div>
                <PrimaryRegisterButton>
                    Sauvegarder
                </PrimaryRegisterButton>
            </div>
        </form>
    </WhiteLayout>
</template>






