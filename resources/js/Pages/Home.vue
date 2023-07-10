<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TableDropdown from "@/components/TableDropdown.vue";
import TableDropdownItem from "@/components/TableDropdownItem.vue";
import Dialog from "@/Components/Dialog.vue";
import EditTweet from "@/Pages/Forms/EditTweet.vue";
import AddTweet from "@/Pages/Forms/AddTweet.vue";
import SuggestedUsers from "@/Pages/Users/SuggestedUsers.vue";
import { getCurrentInstance, ref } from "vue";
import { onMounted } from "vue";
import axios from "axios";

let suggestedComponent;
const suggested_ref = ref(null);
const showEditDialog = ref(false);
const editData = ref([]);
const tweets = ref([]);
const user = usePage().props.auth.user;

const fetchTweet = async () => {
    await axios
        .get("/api/tweet")
        .then((response) => {
            tweets.value = response.data.all_tweets;
        })
        .catch((error) => {
            console.log(error);
        });
};
const deleteTweet = async (id) => {
    await axios
        .delete("/api/tweet/" + id)
        .then((response) => {
            fetchTweet();
        })
        .catch((error) => {
            console.log(error);
        });
};
const unFollowUser = async (id) => {
    await axios
        .delete("/api/follow/" + id)
        .then((response) => {
            fetchTweet();
            suggested_ref.value.$refs.suggested_ref.fetchSuggested();
            suggestedComponent.childFunction();
        })
        .catch((error) => {
            console.log(error);
        });
};

const showEdit = (item) => {
    showEditDialog.value = !showEditDialog.value;
    editData.value = item;
};
const TweetEdited = () => {
    showEditDialog.value = !showEditDialog.value;
    fetchTweet();
};

onMounted(() => {
    suggested_ref.value = suggested_ref.value.$refs.suggested_ref;
    suggestedComponent = getCurrentInstance().proxy.$refs.suggested_ref;
    fetchTweet();
});
</script>

<template>
    <Head title="Twitter" />
    <AuthenticatedLayout>
        <Dialog v-model="showEditDialog">
            <template #header> Edit Tweet </template>
            <template #content>
                <EditTweet :editData="editData" @TweetEdited="TweetEdited">
                </EditTweet
            ></template>
        </Dialog>

        <v-row class="justify-center">
            <v-col cols="9" class="p-4">
                <div
                    class="pa-5 rounded-lg"
                    style="background-color: rgb(27, 27, 27)"
                >
                    <AddTweet
                        @TweetAdded="fetchTweet()"
                        class="mb-10"
                    ></AddTweet>
                    <span class="text-h5">Tweets</span>
                    <v-card
                        v-for="tweet in tweets"
                        :key="tweet.id"
                        class="my-3"
                    >
                        <v-card-title class="mb-5">
                            <v-row class="justify-between">
                                <v-col>
                                    <v-icon>mdi-account-circle</v-icon>
                                    {{ tweet.users.name }}
                                </v-col>
                                <v-col cols="auto">
                                    <TableDropdown
                                        v-if="tweet.user_id === user.id"
                                    >
                                        <TableDropdownItem
                                            prepend="mdi-file-edit"
                                            color="orange"
                                            @click="showEdit(tweet)"
                                        >
                                            Edit
                                        </TableDropdownItem>
                                        <TableDropdownItem
                                            color="error"
                                            prepend="mdi-trash-can"
                                            @click="deleteTweet(tweet.id)"
                                        >
                                            Delete
                                        </TableDropdownItem>
                                    </TableDropdown>
                                    <v-btn
                                        v-else
                                        variant="plain"
                                        color="error"
                                        @click="unFollowUser(tweet.user_id)"
                                    >
                                        Unfollow
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-title>
                        <v-card-text>{{ tweet.tweet_body }}</v-card-text>
                        <v-img
                            v-if="tweet.file"
                            :src="tweet.file"
                            height="200"
                            class="mb-5"
                        ></v-img>
                    </v-card>
                </div>
            </v-col>
            <v-col>
                <div
                    class="pa-5 rounded-lg"
                    style="background-color: rgb(27, 27, 27)"
                >
                    <span class="text-h5">Suggested Users</span>
                    <SuggestedUsers
                        ref="suggested_ref"
                        @userFollowed="fetchTweet"
                    ></SuggestedUsers>
                </div>
            </v-col>
        </v-row>
    </AuthenticatedLayout>
</template>
