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
            <h2 class="">Profile Information</h2>

            <p class="">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class=""
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class=""
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class=""
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class=""
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class=""
                    enter-from-class=""
                    leave-active-class=""
                    leave-to-class=""
                >
                    <p v-if="form.recentlySuccessful" class="">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
