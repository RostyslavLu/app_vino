<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const cellar = usePage().props.cellar;

const form = useForm({
    name: cellar.name,
});

const editingName = ref(false);

const startEditingName = () => {
    editingName.value = true;
};

const stopEditing = () => {
    editingName.value = false;
};

const save = () => {
    form.patch(route('cellars.update', cellar.id), {
        preserveScroll: true,
        onSuccess: () => {
            stopEditing();
        },
        onError: () => {
        },
    });
};
</script>

<template>
    <form @submit.prevent="save">
        <h2>Mes celliers</h2>
        <div>
            <InputError :message="form.errors.name" />
            <div v-if="!editingName" class="flex-row">
                <img src="/img/cellar-blanc.png" class="icon">

                <span>{{ form.name }}</span>
                <img src="/img/icons/edit-3.svg" alt="Edit" @click="startEditingName">
            </div>
            <div v-else>
                <div class="flex-row">
                    <TextInput
                    id="cellar_name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    autocomplete="nom du cellier"
                    />
                    <img src="/img/icons/check.svg" alt="Accept" @click="save">
                    <img src="/img/icons/x.svg" alt="Cancel" @click="stopEditing">
                </div>
            </div>
        </div>
    </form>
</template>