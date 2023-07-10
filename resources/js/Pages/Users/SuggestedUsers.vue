<template>
    <div class="my-3" v-for="user in suggested">
        <v-row class="justify-between">
            <v-col> <v-icon class="mr-2">mdi-account-circle</v-icon>{{ user.name }}</v-col>
            <v-col cols="auto">
                <v-btn
                    size="x-small"
                    variant="plain"
                    color="blue"
                    @click="followUser(user.id)"
                >
                    Follow
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import { ref } from "vue";
import axios from "axios";

const suggested = ref([]);
const emits = defineEmits(["userFollowed"]);
const fetchSuggested = async () => {
    await axios
        .get("/api/suggested")
        .then((response) => {
            suggested.value = response.data.suggested_users;
        })
        .catch((error) => {
            console.log(error);
        });
};

const followUser = async (id) => {
    await axios
        .post("/api/follow/" + id)
        .then((response) => {
            fetchSuggested();
            emits("userFollowed");
        })
        .catch((error) => {
            console.log(error); // handle error here
        });
};

onMounted(() => {
    fetchSuggested();
});
</script>
