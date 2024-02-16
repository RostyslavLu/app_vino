<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
<!--        <p class="">
                Update your account's profile information and email address.
            </p> -->
            <!-- <vue-feather type="feather"></vue-feather> -->
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))">
            <div>
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
                <InputError :message="form.errors.email" />
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    autocomplete="username"
                    placeholder="courriel"
                />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="">
                    Votre adresse courriel n'est pas vérifiée.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                    >
                        Cliquer ici pour renvoyer le courriel de vérification.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                >
                    Nouveau lien de vérification envoyé à votre adresse courriel.
                </div>
            </div>

            <div>
                <PrimaryButton :disabled="form.processing">Sauvegarder</PrimaryButton>

                <Transition name="button-save"
                >
                    <p v-if="form.recentlySuccessful" class="text-success">C'est enregistré.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
