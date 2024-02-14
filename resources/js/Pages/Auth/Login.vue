<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
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
    <GuestLayout class="body-login">
        <Head title="Login" />

        <div v-if="status">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email"/>

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                    placeholder="nom d'utilisateur"
                />

                <InputError class="" :message="form.errors.email" />
            </div>
            <div class="">
                <InputLabel for="password"/>
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    autocomplete="current-password"
                    placeholder="mot de passe"
                />
                       
                <InputError :message="form.errors.password"  />
            </div>

            <div class="">
                <label class="checkbox-label">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="text-white">Sauvegarder ma connexion</span>
                    <!--text-white, c'est nous ou c'est tailwind?-->
                </label>
            </div>
            <!-- commentaire: J'ai enlevé une classe tailwind qui changeait l'opacité, 
                et ajouté une classe imaginaire, qu'on peut remplacer si on utilise 
                ce formulaire. ce code évalue si form.processing est vrai, 
                et si c'est vrai, la class "myCssClass" est appliquée au bouton -->

            <div class="inputlabel">
                <PrimaryButton :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Connexion
                </PrimaryButton>
            </div>

            <div class="div-link">
                <Link
                    :href="route('password.request')"
                    class="link"
                >
                    Mot de passe oublié?
                </Link>
            </div>


            <div class="div-link">  
                <Link
                    :href="route('register')"
                    class="link-register"
                    >
                    Creer un compte
                </Link>
            </div>  
        </form>
    </GuestLayout>
</template>
