<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

// "defineProps call" enlevé car il n'est pas nécessaire ici

const user = usePage().props.auth.user; // Récupère l'utilisateur authentifié

const form = useForm({ // Crée un formulaire réactif
    name: user.name,
    email: user.email,
});

const editingName = ref(false); // Crée une variable réactive qui indique si le nom est en cours d'édition
const oldName = ref(user.name); // Crée un référence pour stocker l'ancien nom
const editingEmail = ref(false);
const oldEmail = ref(user.email); // Crée un référence pour stocker l'ancien courriel

const startEditingName = () => { // Active le mode édition
    oldName.value = form.name; // Stocke l'ancien nom
    editingName.value = true;
};

const startEditingEmail = () => {
    oldEmail.value = form.email; // Stocke l'ancien courriel
    editingEmail.value = true; // Active le mode édition
};

const stopEditing = () => {
    editingName.value = false;
    editingEmail.value = false;
};

const cancelEditing = () => {
    form.name = oldName.value; // Restaure l'ancien nom
    form.email = oldEmail.value; // Restaure l'ancien courriel
    form.clearErrors(); // Efface tous les messages d'erreur du formulaire
    stopEditing(); // Désactive le mode édition
}

const save = () => {
    form.patch(route('profile.update'), { // Envoie une requête PATCH à la route profile.update
        preserveScroll: true, // Préserve la position de la page après la soumission du formulaire
        onSuccess: () => {
            oldEmail.value = form.email; // Met à jour l'ancien courriel
            stopEditing(); // Désactive le mode édition
        },
    });
};
</script>

<template>
    <form @submit.prevent="save" class="profile">
            <h2>Mes informations</h2>     
        <div>
            <InputError :message="form.errors.name" />
            <div v-if="!editingName" class="__inline">
                <div class="flex-row">
                    <img src="/img/icons/user.svg" class="icon">
                <span>{{ form.name }}</span>

                </div>
                <img src="/img/icons/edit-3.svg" alt="Edit" @click="startEditingName">
            </div>
            <div v-else>
                <div class="flex-row">     
                    <img src="/img/icons/user.svg" class="icon">
       
                    <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    />
                    
                    <img src="/img/icons/check.svg" alt="Accept" @click="save">
                    <img src="/img/icons/x.svg" alt="Cancel" @click="cancelEditing">
                </div>
                
            </div>
        </div>
        <div>
            <InputError :message="form.errors.email" />
            <div v-if="!editingEmail" class="__inline">
                <div class="flex-row">
                    <img src="/img/icons/at-sign.svg" class="icon">
                    <span>{{ form.email }}</span>
                </div>
                <img src="/img/icons/edit-3.svg" alt="Edit" @click="startEditingEmail">
            </div>
            <div v-else>
                <div class="flex-row">
                    <img src="/img/icons/mail.svg" class="icon">
                    <TextInput 
                    id="email"
                    v-model="form.email"
                    autofocus
                    autocomplete="username"
                    />
                    <img src="/img/icons/check.svg" alt="Accept" @click="save">
                    <img src="/img/icons/x.svg" alt="Cancel" @click="cancelEditing">
                </div>
            </div>
        </div>
    </form>
</template>