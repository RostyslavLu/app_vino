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
            </h2>
        </header>

        <form @submit.prevent="form.patch(route('cellars.update', cellar.id))" class="">
            <div>
                <TextInput
                    id="cellar_name"
                    type="text"
                    class=""
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="nom du cellier"
                />

                <InputError class="" :message="form.errors.name" />
            </div>

            <div>
                <TextInput
                    id="cellar_description"
                    type="text"
                    class=""
                    v-model="form.description"
                    autocomplete="description"
                    placeholder="description du cellier"
                />
                <!-- must figure out the errors... and the autocomplete -->
                <InputError class="" :message="form.errors.description" />
            </div>

            <div class="">
                <PrimaryButton :disabled="form.processing">Sauvegarder</PrimaryButton>

                <Transition
                    enter-active-class=""
                    enter-from-class=""
                    leave-active-class=""
                    leave-to-class=""
                >
                    <p v-if="form.recentlySuccessful" class="">C'est enregistré.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
