<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const editingPassword = ref(false);

const startEditingPassword = () => {
    editingPassword.value = true;
};

const stopEditing = () => {
    editingPassword.value = false;
};

const showSuccessMessage = ref(false); // message de succès
const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            stopEditing();
            form.reset();
            showSuccessMessage.value = true;  
        },
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
    <form @submit.prevent="updatePassword" class="profile">
        <h2>Mot de passe</h2>
        <div>
            <InputError :message="form.errors.current_password" />
            <p class="input-success" v-show="showSuccessMessage">Votre mot de passe a été modifié avec succès!</p>
            <div v-if="!editingPassword" class="__inline">
                <div class="flex-row">
                    <img src="/img/icons/lock-black.svg" class="icon">
                    <span>********</span>
                </div>
                <img src="/img/icons/edit-3-black.svg" alt="Edit" class="icon-small" @click="startEditingPassword">
            </div>
            <div v-else class="flex-gap">
                <div class="flex-row">
                    <img src="/img/icons/lock-black.svg" class="icon">
                    <TextInput
                        id="current_password"
                        type="password"
                        v-model="form.current_password"
                        ref="currentPasswordInput"
                        autofocus
                        autocomplete="current-password"
                        placeholder="Mot de passe actuel"
                    />
                </div>
                <InputError :message="form.errors.password" />
                <div class="flex-row">
                    <img src="/img/icons/key-black.svg" class="icon">
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        ref="passwordInput"
                        autocomplete="new-password"
                        placeholder="Nouveau mot de passe"
                    />
                </div>
                <InputError :message="form.errors.password_confirmation" />
                <div class="flex-row">
                    <img src="/img/icons/key-black.svg" class="icon">
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        autocomplete="new-password"
                        placeholder="Confirmer le mot de passe"
                    />
                    <img src="/img/icons/check-black.svg" alt="Accept" class="icon" @click="updatePassword">
                    <img src="/img/icons/x-black.svg" alt="Cancel" class="icon" @click="stopEditing">
                </div>  
            </div>
        </div>
    </form>
</template>