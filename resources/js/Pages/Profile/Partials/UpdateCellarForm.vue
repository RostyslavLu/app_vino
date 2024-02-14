<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const cellar = usePage().props.cellar;

const form = useForm({
    name: cellar.name,
    description: cellar.description
});
</script>

<template>
    <section>
        <header>
            <h2 class="namereg">
                votre cellier
                <i data-feather="flag"></i>
            </h2>
        </header>

        <form @submit.prevent="form.patch(route('cellars.update', cellar.id))" class="">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class=""
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    type="text"
                    class=""
                    v-model="form.description"
                    autocomplete="description"
                />
                <!-- must figure out the errors... and the autocomplete -->
                <InputError class="" :message="form.errors.description" />
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
