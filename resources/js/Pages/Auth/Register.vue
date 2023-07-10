<script setup>
import DefaultTextInput from "@/Components/DefaultTextInput.vue";
import DefaultButton from "@/Components/DefaultButton.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const error = ref(null);

const submit = () => {
    if (form.password != form.password_confirmation) {
        error.value = "Password do not match";
    } else {
        axios
            .post("/api/register", form)
            .then((response) => {
                if (response.data.error) {
                    error.value = response.data.error;
                } else {
                    window.location.href = "/";
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
};
</script>

<template>
    <Head title="Register" />
    <v-theme-provider theme="dark" with-background style="height: 100%">
        <v-form @submit.prevent="submit">
            <div
                class="d-flex align-center justify-center"
                style="height: 100vh"
            >
                <v-row class="justify-center my-auto">
                    <v-col cols="3">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQk2aKPhXATqCSjy5qWZxQrSI-lqHGJVYvU_jeoDQNsX2Ib_MK3K67Y9Aj7mH1iDUwpEEc"
                            alt=""
                            class="mx-auto"
                            style="mix-blend-mode: color"
                        />
                        <DefaultTextInput
                            id="name"
                            type="text"
                            class="mt-3"
                            label="Name"
                            v-model="form.name"
                        />
                        <DefaultTextInput
                            id="email"
                            type="email"
                            label="Email"
                            class="mt-3"
                            v-model="form.email"
                        />
                        <DefaultTextInput
                            id="password"
                            label="Password"
                            type="password"
                            class="mt-3"
                            v-model="form.password"
                        />
                        <DefaultTextInput
                            id="password_confirmation"
                            type="password"
                            label="Confirm Password"
                            class="my-3"
                            v-model="form.password_confirmation"
                        />
                        <div class="my-3 text-red" v-if="error">
                            {{ error }}
                        </div>

                        <Link
                            :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Already registered?
                        </Link>

                        <DefaultButton class="my-4" :disabled="form.processing">
                            Register
                        </DefaultButton>
                    </v-col>
                </v-row>
            </div>
        </v-form>
    </v-theme-provider>
</template>
