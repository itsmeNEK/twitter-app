<script setup>
defineProps({
    icon: String,
});
</script>
<template>
    <v-textarea
        clearable
        :prepend-inner-icon="icon"
        color="blue-lighten-1"
        density="compact"
        hide-details="auto"
    >
    </v-textarea>
</template>
