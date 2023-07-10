<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";

const showingNavigationDropdown = ref(false);

const logout = async () => {
    await axios
        .post("/api/logout")
        .then((response) => {
            window.location.href = "/login";
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <v-app>
        <v-theme-provider theme="dark" with-background style="height: 100%">
            <v-layout>
                <v-app-bar>
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQk2aKPhXATqCSjy5qWZxQrSI-lqHGJVYvU_jeoDQNsX2Ib_MK3K67Y9Aj7mH1iDUwpEEc"
                        alt=""
                        style="width: 50px; mix-blend-mode: color"
                    />
                    <v-app-bar-title> Twitter </v-app-bar-title>
                    <v-spacer></v-spacer>
                    <div class="text-end">
                        <v-btn icon id="APPleftDropButton" variant="plain">
                            <v-icon left>mdi-dots-vertical</v-icon>
                        </v-btn>
                        <v-menu activator="#APPleftDropButton">
                            <v-list>
                                <v-list-item>
                                    <v-btn
                                        @click="logout"
                                        variant="plain"
                                        type="button"
                                        ><v-icon>mdi-logout-variant</v-icon>
                                        logout</v-btn
                                    >
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </div>
                </v-app-bar>

                <v-main>
                    <!-- Page Content -->
                    <main>
                        <v-container>
                            <slot />
                        </v-container>
                    </main>
                </v-main>
            </v-layout>
        </v-theme-provider>
    </v-app>
</template>
