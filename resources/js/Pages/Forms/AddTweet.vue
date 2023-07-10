<script setup>
import DefaultTextArea from "@/Components/DefaultTextArea.vue";
import DefaultButton from "@/Components/DefaultButton.vue";
import Dialog from "@/Components/Dialog.vue";
import axios from "axios";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const emits = defineEmits();
const props = defineProps({
    showAddDialog: Boolean,
});
const tweet = ref({
    tweet_body: null,
    file: null,
});

const addTweet = async () => {
    await axios({
        headers: { "Content-Type": "multipart/form-data" },
        method: "post",
        url: "/api/tweet",
        data: tweet.value,
    })
        .then((response) => {
            tweet.value.tweet_body = null;
            tweet.value.file = null;
            emits("TweetAdded");
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <v-form @submit.prevent="addTweet">
        <DefaultTextArea
            label="Tweet"
            placeholder="Write Something..."
            v-model="tweet.tweet_body"
            class="mb-3"
        ></DefaultTextArea>
        <v-file-input
            id="file"
            clearable
            v-model="tweet.file"
            density="compact"
            color="blue-lighten-1"
            hide-details
            label="Upload Attachments"
        ></v-file-input>
        <DefaultButton class="mt-5" type="submit" prepend="mdi-plus"
            >Add</DefaultButton
        >
    </v-form>
</template>
