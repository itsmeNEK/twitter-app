<script setup>
import DefaultTextInput from "@/Components/DefaultTextInput.vue";
import DefaultButton from "@/Components/DefaultButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const form = useForm({
    email: "",
    password: "",
});

const error = ref(null);
const submit = async () => {
    axios
        .post("/api/login", form)
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
};
</script>

<template>
    <Head title="Log in" />

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
                            style="mix-blend-mode: color;"
                        />
                        <DefaultTextInput
                            id="email"
                            type="email"
                            class="mt-3"
                            v-model="form.email"
                            required
                            autofocus
                            label="Email"
                        ></DefaultTextInput>

                        <DefaultTextInput
                            id="password"
                            type="password"
                            class="my-3"
                            v-model="form.password"
                            required
                            label="Password"
                        ></DefaultTextInput>

                        <div class="my-3 text-red" v-if="error">
                            {{ error }}
                        </div>
                        <Link :href="route('register')" class="mt-3">
                            Not yer registered?
                        </Link>
                        <div class="mt-5">
                            <DefaultButton :disabled="form.processing">
                                Log in
                            </DefaultButton>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-form>
    </v-theme-provider>
</template>
