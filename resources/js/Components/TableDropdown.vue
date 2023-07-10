<template>
    <v-menu class="p-0">
        <template v-slot:activator="{ props }">
            <v-btn v-bind="props" variant="tonal" type="button" size="small">
                <v-icon left>mdi-menu</v-icon>
            </v-btn>
        </template>
        <ul class="myList" style="list-style-type: none">
            <slot />
        </ul>
    </v-menu>
</template>
<style>
.myList {
    list-style: none;
    margin: 0;
    padding: 0;
    background-color: rgb(27, 27, 27);
    border-radius: 5px;
    box-shadow: 1px 1px 5px gray;
}
</style>
