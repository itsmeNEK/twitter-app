<script setup>
import DefaultTextArea from "@/Components/DefaultTextArea.vue";
import DefaultButton from "@/Components/DefaultButton.vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const emits = defineEmits();
const props = defineProps({
    editData: Object,
});

const tweet = ref({
    tweet_body: props.editData.tweet_body,
});

const updateTweet = async () => {
    await axios
        .put("/api/tweet/" + props.editData.id, tweet.value)
        .then((response) => {
            emits("TweetEdited");
        })
        .catch((error) => {
            console.log(error); // handle error here
        });
};
</script>

<template>
    <v-form @submit.prevent="updateTweet">
        <DefaultTextArea
            label="Tweet Body"
            v-model="tweet.tweet_body"
            class="mb-3"
        ></DefaultTextArea>

        <DefaultButton class="mt-5" type="submit" prepend="mdi-check"
            >Save</DefaultButton
        >
    </v-form>
</template>
