<script setup>
import { computed, inject, ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    value: {
        required: true,
    },
    id: {
        type: String,
        default: null,
    },
});

// Use the injected radioGroup context
const radioGroup = inject('radioGroup');

if (!radioGroup) {
    throw new Error('RadioGroupItem must be used within a RadioGroup');
}

const randomId = ref(`radio-${Math.random().toString(36).substring(2, 10)}`);
const inputId = computed(() => props.id || randomId.value);

const isSelected = computed(() => radioGroup.modelValue.value === props.value);

function handleChange() {
    radioGroup.update(props.value);
}

onMounted(() => {
    // Provide the radioGroup context to children
    if (radioGroup === null) {
        console.warn('RadioGroupItem should be used within a RadioGroup component');
    }
});
</script>

<template>
    <div class="flex items-center">
        <input
            :id="inputId"
            name="radio-group"
            type="radio"
            :checked="isSelected"
            @change="handleChange"
            class="h-4 w-4 border-input bg-background text-primary focus:ring-ring dark:focus:ring-offset-background"
            :value="value"
        />
        <label :for="inputId" class="ml-2 block text-sm font-medium text-foreground">
            <slot />
        </label>
    </div>
</template>
