<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="namereg">mot de passe</h2>
        </header>

        <form @submit.prevent="updatePassword" class="">
            <div>

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class=""
                    autocomplete="current-password"
                    placeholder="votre mot de passe"
                />

                <InputError :message="form.errors.current_password" class="" />
            </div>

            <div>
                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class=""
                    autocomplete="new-password"
                    placeholder="nouveau mot de passe"
                />
                <InputError :message="form.errors.password" class="" />
            </div>

            <div>
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class=""
                    autocomplete="new-password"
                    placeholder="confirmez le nouveau mot de passe"
                />
                <InputError :message="form.errors.password_confirmation" class="" />
            </div>

            <div class="">
                <PrimaryButton :disabled="form.processing">Sauvegarder</PrimaryButton>

                <Transition
                    enter-active-class=""
                    enter-from-class=""
                    leave-active-class=""
                    leave-to-class=""
                >
                    <p v-if="form.recentlySuccessful" class="">c'est enregistré.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
