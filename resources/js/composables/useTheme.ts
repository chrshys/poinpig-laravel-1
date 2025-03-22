import { inject, Ref } from 'vue';

export type Theme = 'light' | 'dark' | 'system';

interface ThemeContext {
  current: Ref<Theme>;
  update: (theme: Theme) => void;
}

export function useTheme() {
  const theme = inject<ThemeContext>('theme');
  
  if (!theme) {
    throw new Error('useTheme must be used within a ThemeProvider component');
  }
  
  return {
    theme: theme.current,
    setTheme: theme.update,
  };
} 