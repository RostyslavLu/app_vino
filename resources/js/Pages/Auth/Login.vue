<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import BlackLayout from '@/Layouts/BlackLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
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
    <Head title="Login" />
    <BlackLayout>

        <article class="__content">
            <div v-if="status" class="input-success">
            {{ status }}
            </div>

            <form @submit.prevent="submit" class="__login-form-width">
                <div>
                    <InputError :message="form.errors.email" />
                    <InputLabel for="email" value="Courriel" />
                    <TextInput
                        id="email"
                        type="text"
                        v-model="form.email"
                        autofocus
                        autocomplete="username"
                        placeholder="nom@example.com"
                    />

                </div>
                <div>
                    <InputError :message="form.errors.password"  />
                    <InputLabel for="password" value="Mot de passe" />
                        <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        autocomplete="current-password"
                        placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;"
                    />  
                </div>

                <div class="flex-row">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <p>Sauvegarder ma connexion</p>
                </div>

                <button class="button __beige">
                    Connexion
                </button>
                <Link
                    :href="route('password.request')"
                    >Mot de passe oublié?</Link
                    >
                <Link
                    :href="route('register')"
                    >Créer un compte</Link
                >
            </form>
        </article>
        
    </BlackLayout>
</template>
