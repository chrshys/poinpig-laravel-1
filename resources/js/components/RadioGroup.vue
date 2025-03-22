<script setup>
import { computed, provide } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number, Boolean],
        default: '',
    },
});

const emit = defineEmits(['update:modelValue']);

const update = (value) => {
    emit('update:modelValue', value);
};

// Provide the radioGroup context to children
provide('radioGroup', {
    modelValue: computed(() => props.modelValue),
    update,
});

defineExpose({ update });
</script>

<template>
    <div>
        <slot></slot>
    </div>
</template>
