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
    <WhiteLayout class="white-container">
        <template v-slot:header>
            Inscription
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name"/>
                <InputError :message="form.errors.name" />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="nom"
                />

            </div>

            <div>
                <InputLabel for="email" />
                <InputError :message="form.errors.email" />
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autocomplete="username"
                    placeholder="courriel"
                />

            </div>

            <div>
                <InputLabel for="cellar_name" />
                <InputError class="" :message="form.errors.cellar_name" />
                <TextInput
                    id="cellar_name"
                    type="text"
                    v-model="form.cellar_name"
                    autocomplete="nom du cellier"
                    placeholder="nom du cellier"
                />

            </div>

            <div>
                <InputLabel for="cellar_description" />
                <InputError :message="form.errors.cellar_description" />
                <TextInput
                    id="cellar_description"
                    type="text"
                    v-model="form.cellar_description"
                    autocomplete="description"
                    placeholder="description du cellier"
                />

            </div>

            <div>
                <InputLabel for="password"/>
                <InputError :message="form.errors.password" />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    placeholder="mot de passe"
                />

            </div>

            <div>
                <InputLabel for="password_confirmation"/>
                <InputError class="input-error" :message="form.errors.password_confirmation" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    placeholder="confirmer le mot de passe"
                />

            </div>
                <PrimaryRegisterButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sauvegarder
                </PrimaryRegisterButton>
        </form>
    </WhiteLayout>
</template>






