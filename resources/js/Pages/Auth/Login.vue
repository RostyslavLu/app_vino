<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import BlackLayout from '@/Layouts/BlackLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BlackLayout class="black-container">
        <Head title="Login" />

        <div v-if="status" class="input-success">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputError class="" :message="form.errors.email" />
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                    placeholder="nom d'utilisateur"
                />

            </div>
            <div>
                <InputError :message="form.errors.password"  />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autocomplete="current-password"
                    placeholder="mot de passe"
                />
            </div>

            <label class="flex-row">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <p>Sauvegarder ma connexion</p>
            </label>

                    <PrimaryButton>
                    Connexion
                    </PrimaryButton>
                
                

                <Link
                    :href="route('password.request')"
                >
                    Mot de passe oublié?
                </Link>
                <Link
                    :href="route('register')"
                    >
                    Créer un compte
                </Link>
            </form>
    </BlackLayout>
</template>
