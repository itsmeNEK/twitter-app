<script setup>
defineProps({
    icon: String,
});
</script>
<template>
    <v-text-field
        clearable
        :prepend-inner-icon="icon"
        color="blue-lighten-1"
        density="compact"
        hide-details="auto"
    >
    </v-text-field>
</template>
