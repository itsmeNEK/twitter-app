<script setup>
defineProps({
    color: String,
    prepend: String,
});
</script>
<template>
    <li class="text-center" style="list-style-type: none">
        <v-btn
            :prepend-icon="prepend"
            variant="plain"
            :color="color"
            size="small"
            class="w-100"
        >
            <slot />
        </v-btn>
    </li>
</template>
