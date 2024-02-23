<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

// pour afficher le texte
const showText = ref(false); // controle l'affichage du texte
const toggleText = () => {
    showText.value = !showText.value; // Change la valeur de showText chaque fois que l'icône est cliquée
};


// pour supprimer un compte dans la modale
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
    form.errors.password = null; // Réinitialise les erreurs de mot de passe
};
</script>

<template>
        <header class="profile-line">
            <h2>Supprimer mon compte</h2>
            <img src="/img/icons/plus-square.svg" alt="Voir plus" @click="toggleText" />
        </header>
        <article v-show="showText" class="profil-delete ">
            <p>
                Une fois votre compte supprimé, vous n'aurez plus accès à votre cellier ni à vos vins. Assurez-vous de bien vouloir tout supprimer.
            </p>
            <DangerButton @click="confirmUserDeletion">Supprimer votre compte</DangerButton>
        </article>
            

        <Modal :show="confirmingUserDeletion" @close="closeModal">
                <ApplicationLogo class="logo white" @click="closeModal"/>
                <h1>Êtes-vous sûr?</h1>
                <p>Votre compte, votre cellier et vos vins seront effacés de façon permanente. 
                <br>Cette action est irréversible.</p>
                <p>Veuillez entrer votre mot de passe pour confirmer.</p>
                <div>
                    <InputError :message="form.errors.password" />
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="mot de passe"
                        @keyup.enter="deleteUser"
                    />
                </div>

                <div class="modal-buttons">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>

                    <DangerButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Supprimer
                    </DangerButton>
                </div>
        </Modal>
</template>
