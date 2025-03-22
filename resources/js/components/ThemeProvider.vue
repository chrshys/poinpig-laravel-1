<script setup lang="ts">
import { onMounted, provide, ref } from 'vue';

type Theme = 'light' | 'dark' | 'system';

const theme = ref<Theme>('system');

const resolveTheme = (theme: Theme): 'light' | 'dark' => {
    if (theme === 'system') {
        if (typeof window === 'undefined') return 'light';
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }
    return theme;
};

const updateTheme = (newTheme: Theme) => {
    theme.value = newTheme;
    
    // Save theme preference
    if (typeof window !== 'undefined') {
        localStorage.setItem('theme', newTheme);
        
        // Set cookie for SSR
        const maxAge = 365 * 24 * 60 * 60;
        document.cookie = `theme=${newTheme};path=/;max-age=${maxAge};SameSite=Lax`;
    }
    
    // Update class on document element
    const resolvedTheme = resolveTheme(newTheme);
    document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
};

const handleSystemThemeChange = () => {
    if (theme.value === 'system') {
        updateTheme('system');
    }
};

onMounted(() => {
    // Initialize from saved preference or default to system
    const savedTheme = localStorage.getItem('theme') as Theme | null;
    theme.value = savedTheme || 'system';
    
    // Apply the theme
    updateTheme(theme.value);
    
    // Listen for system theme changes
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    mediaQuery.addEventListener('change', handleSystemThemeChange);
});

// Provide theme context to descendants
provide('theme', {
    current: theme,
    update: updateTheme
});
</script>

<template>
    <slot></slot>
</template> 