<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

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

const editingName = ref(false);
const editingEmail = ref(false);

const startEditingName = () => {
    editingName.value = true;
};

const startEditingEmail = () => {
    editingEmail.value = true;
};

const stopEditing = () => {
    editingName.value = false;
    editingEmail.value = false;
};

const save = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            stopEditing();
        },
        onError: () => {
            // If there are validation errors, don't stop editing
        },
    });
};</script>

<template>
    <form @submit.prevent="save">
            <h2>Mes informations</h2>     
        <div>
            <InputError :message="form.errors.name" />
            <div v-if="!editingName" class="profile-line">
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
                    <img src="/img/icons/x.svg" alt="Cancel" @click="stopEditing">
                </div>
                
            </div>
        </div>
        <div>
            <InputError :message="form.errors.email" />
            <div v-if="!editingEmail" class="profile-line">
                <div class="flex-row">
                    <img src="/img/icons/mail.svg" class="icon">
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
                    autocomplete="username"
                    />
                    <img src="/img/icons/check.svg" alt="Accept" @click="save">
                    <img src="/img/icons/x.svg" alt="Cancel" @click="stopEditing">
                </div>
                

            </div>
        </div>
    </form>
</template>