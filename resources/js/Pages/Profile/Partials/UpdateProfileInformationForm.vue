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
    form.patch(route('profile.update'));
    stopEditing();
};
</script>

<template>
    <form @submit.prevent="save">
        <h2>Mes informations</h2>
        <div>
            <InputError :message="form.errors.name" />
            <div v-if="!editingName">
            <span>{{ form.name }}</span>
            <img src="/img/icons/edit-3.svg" alt="Edit" @click="startEditingName">
        </div>
            <TextInput
                v-else
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
            <div v-if="!editingEmail">
                <span>{{ form.email }}</span>
                <button @click="startEditingEmail">
                    <img src="/path-to-pencil-icon.png" alt="Edit">
                </button>
            </div>
            <TextInput
                v-else
                id="email"
                type="email"
                v-model="form.email"
                autocomplete="username"
                placeholder="courriel"
            />
        </div>

        <!-- Rest of the form... -->
    </form>
</template>