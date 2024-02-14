<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="">
        <header>
            <h2 class="namereg">supprimer</h2>

            <p class="">
                Une fois votre compte supprimé, vous n'aurez plus accès à votre cellier ni à vos vins. Assurez-vous de bien vouloir tout supprimer.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Supprimer votre compte</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="">
                <h2 class="">
                    Êtes vous certain du vouloir supprimer votre compte?
                </h2>

                <p class="">
                    Une fois votre compte supprimé, votre cellier et vos vins seront effacés de façon permanente. Veuillez entrer votre mot de passe pour confirmer.
                </p>

                <div class="">
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class=""
                        placeholder="mot de passe"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="" />
                </div>

                <div class="">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>

                    <DangerButton
                        class=""
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Supprimer votre compte
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
