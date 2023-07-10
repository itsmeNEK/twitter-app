<script setup>
defineProps({
    type: String,
    prepend: String,
    append: String,
});
</script>
<template>
    <v-btn
        :prepend-icon="prepend"
        :append-icon="append"
        :type="type"
        color="blue-lighten-1"
        class="w-100"
    >
        <slot />
    </v-btn>
</template>
