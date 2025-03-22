<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
    id: {
        type: String,
        default: () => `checkbox-${Math.random().toString(36).substring(2, 10)}`
    }
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <input
        :id="id"
        type="checkbox"
        v-model="proxyChecked"
        :value="value"
        class="rounded bg-background border-input text-primary shadow-sm focus:ring-ring focus:ring-primary/20 dark:focus:ring-offset-background"
    />
</template>
