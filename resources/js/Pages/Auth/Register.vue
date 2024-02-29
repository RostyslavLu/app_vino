<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
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
<WhiteLayout class="">
        <Head title="Inscription" />
            <template #header>
                Inscription
            </template>

            <form @submit.prevent="submit" >
                <div v-if="status" class="input-success">
                {{ status }}
                </div>
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
                        placeholder="Mon nom"
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
                        placeholder="nom@example.com"
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
                        placeholder="ex. chalet (optionnel)"
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
                        placeholder="min. 8 caractères"
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
                        placeholder="confirmer le mot de passe"
                    />
                </div>
                <div>
                    <p class="text-required">
                        <span class="required">&#42;</span>&nbsp;Champs obligatoires
                    </p>
                </div>
                <div>
                    <button class="button register">
                        Sauvegarder
                    </button>
                </div>
            </form>
    </WhiteLayout>
</template>