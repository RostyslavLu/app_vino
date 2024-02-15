<script setup>
import { computed } from 'vue';
import WhiteLayout from '@/Layouts/WhiteLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <WhiteLayout>
        <Head title="Email Verification" />

        <div class="">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
            we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div class="" v-if="verificationLinkSent">
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div class="">
                <!-- commentaire: J'ai enlevé une classe tailwind, et ajouté une classe imaginaire, qu'on peut remplacer si on utilise ce formulaire. ce code évalue si form.processing est vrai, et si c'est vrai, la class "myCssClass" est appliquée au bouton -->
                <PrimaryButton :class="{ 'myCssClass': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class=""
                    >Log Out</Link
                >
            </div>
        </form>
    </WhiteLayout>
</template>
