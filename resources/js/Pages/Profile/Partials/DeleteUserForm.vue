<script setup>
import ApplicationLogoBlack from '@/Components/ApplicationLogoBlack.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
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
        <div class="profile">
            <header class="__inline">
                <h2>Supprimer mon compte</h2>
                <img src="/img/icons/plus-square.svg" alt="Voir plus" @click="toggleText" class="icon" />
            </header>
            <article v-show="showText">
                <p class="__delete-text">
                    Une fois votre compte supprimé, vous n'aurez plus accès à votre cellier ni à vos vins. Assurez-vous de bien vouloir tout supprimer.
                </p>
                <button class="danger" @click="confirmUserDeletion">Supprimer votre compte</button>
            </article>
        </div>

            

        <Modal :show="confirmingUserDeletion" @close="closeModal">
                <ApplicationLogoBlack class="logo" @click="closeModal"/>
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
                    <button @click="closeModal"> Annuler </button>

                    <button class="danger"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Supprimer
                    </button>
                </div>
        </Modal>
</template>
