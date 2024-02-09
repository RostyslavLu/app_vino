
<template>
    <GuestLayout class="body-login">
        <Head title="Log in" />

        <div v-if="status" >
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="form-class">
            <div>
                <InputLabel for="email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="text-input"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="nom d'utilisateur"
                />

                <InputError :message="form.errors.email" />
            </div>
            <div class="inputlabel">
                <InputLabel for="password"/>
                <TextInput
                    id="password"
                    type="password"
                    class="text-input"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="mot de passe"
                />
                       
                <InputError :message="form.errors.password"  />
            </div>

            <div class="checkbox">
                <label class="checkbox-label">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="text-white">Sauvegarder ma connexion</span>
                </label>
            </div>

            <div class="inputlabel">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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

<style scoped>

@import '@/../css/styles.css';

</style>
