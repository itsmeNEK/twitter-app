<script setup>
import { ref, watchEffect } from "vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
});

const emits = defineEmits(["update:modelValue"]);

// Create a local ref and synchronize it with the prop value
const modelValue = ref(props.modelValue);
watchEffect(() => {
    modelValue.value = props.modelValue;
});

// Emit the update event when the local value changes
function closeSnackbar(newValue) {
    modelValue.value = newValue;
    emits("update:modelValue", newValue);
}
</script>
<template>
    <v-row justify="center">
        <v-dialog v-model="modelValue" persistent max-width="1000">
            <v-card>
                <v-toolbar color="blue-lighten-1">
                    <v-toolbar-title> <slot name="header" /></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn
                        prepend-icon="mdi-close-circle"
                        variant="text"
                        @click="closeSnackbar(false)"
                    >
                        Close
                    </v-btn>
                </v-toolbar>
                <v-card-title>
                    <v-row>
                        <v-col cols="8"> </v-col>
                        <v-col class="text-end"> </v-col>
                    </v-row>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <slot name="content" />
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-row>
</template>
