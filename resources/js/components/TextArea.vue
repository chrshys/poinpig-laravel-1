<script setup>
defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);
</script>

<template>
    <textarea
        class="border-input bg-background text-foreground rounded-md shadow-sm focus:border-ring focus:ring-ring w-full"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
</template>
