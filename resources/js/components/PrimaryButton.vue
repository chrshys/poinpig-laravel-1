<script setup lang="ts">
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-primary-foreground uppercase tracking-widest hover:bg-primary/90 focus:bg-primary/90 active:bg-primary/100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 dark:focus:ring-offset-background disabled:opacity-50 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
