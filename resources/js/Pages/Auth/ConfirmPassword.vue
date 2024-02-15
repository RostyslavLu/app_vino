<script setup>
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <WhiteLayout>
        <Head title="Confirm Password" />

        <div class="">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class=""
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="" :message="form.errors.password" />
            </div>
            <!-- commentaire: J'ai enlevé une classe tailwind, et ajouté une classe imaginaire, qu'on peut remplacer si on utilise ce formulaire. ce code évalue si form.processing est vrai, et si c'est vrai, la class "myCssClass" est appliquée au bouton -->

            <div class="">
                <PrimaryButton class="" :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Confirm
                </PrimaryButton>
            </div>
        </form>
    </WhiteLayout>
</template>
