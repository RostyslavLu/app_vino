<template>
    <GuestRegisterLayout class="body-register">
        <Head title="Register" />

        <form @submit.prevent="submit" class="formreg-class">
            <div>
                <InputLabel for="name"/>

                <TextInput
                    id="name"
                    type="text"
                    class="textreg-input"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="nom"
                />

                <InputError :message="form.errors.name" />
            </div>

            <div class="inputlabel">
                <InputLabel for="email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="textreg-input"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="courriel"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="cellier" />

                <TextInput
                    id="cellier"
                    type="text"
                    class="textreg-input"
                    v-model="form.cellier"
                    required
                    autocomplete="nom du cellier"
                    placeholder="nom du cellier"
                />

                <InputError class="mt-2" :message="form.errors.cellier" />
            </div>

            <div class="mt-4">
                <InputLabel for="description" />

                <Textarea
                    id="description"
                    type="text"
                    class="textreg-input"
                    v-model="form.description"
                    required
                    autocomplete="description"
                    placeholder="description du cellier"
                ></textarea>

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="mt-4">
                <InputLabel for="password"/>

                <TextInput
                    id="password"
                    type="password"
                    class="textreg-input"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="mot de passe"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation"/>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="textreg-input"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="confirmer le mot de passe"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
                <PrimaryRegisterButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sauvegarder
                </PrimaryRegisterButton>  
        </form>
    </GuestRegisterLayout>
</template>

<script setup>
import GuestRegisterLayout from '@/Layouts/GuestRegisterLayout.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryRegisterButton from '@/Components/PrimaryRegisterButton.vue';
import Textarea from '@/Components/Textarea.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    cellier: '',
    description: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>




