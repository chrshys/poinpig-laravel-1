# Coinpig Theme System

This document provides an overview of the theme system implemented in the Coinpig application.

## Overview

The Coinpig application uses a fully-featured theming system based on ShadCN Vue and Tailwind CSS. The system provides:

1. Light and dark mode support
2. Consistent semantic color tokens
3. High-contrast, accessible color combinations
4. Theme toggling capability

## Theme Structure

### CSS Variables

The theme is implemented using CSS variables defined in `resources/css/app.css`. These variables define colors for light and dark modes using HSL values, making it easy to derive new shades:

```css
:root {
    --background: 0 0% 100%;
    --foreground: 240 10% 3.9%;
    /* other variables... */
}

.dark {
    --background: 240 10% 3.9%;
    --foreground: 0 0% 98%;
    /* other variables... */
}
```

### Semantic Color Tokens

The system uses semantic color tokens that describe the purpose of the color rather than its visual appearance:

- `background` / `foreground`: Base page colors
- `card` / `card-foreground`: Card component colors
- `popover` / `popover-foreground`: Popover and dropdown colors
- `primary` / `primary-foreground`: Primary action colors
- `secondary` / `secondary-foreground`: Secondary action colors
- `muted` / `muted-foreground`: Subdued UI elements
- `accent` / `accent-foreground`: Accent UI elements
- `destructive` / `destructive-foreground`: Destructive actions
- `border`: Border color
- `input`: Form input borders
- `ring`: Focus rings

### Theme Management

The theme is managed using a Vue composition pattern:

1. `ThemeProvider.vue`: Provides theme context to the application
2. `useTheme.ts`: Composable for accessing theme functionality
3. `ThemeToggle.vue`: UI component for toggling between themes

## Usage

### Setting Text Colors

```html
<p class="text-foreground">High-contrast primary text</p>
<p class="text-muted-foreground">Lower-contrast secondary text</p>
```

### Setting Background Colors

```html
<div class="bg-background">Page background</div>
<div class="bg-card">Card background</div>
```

### Using Component Variants

Components like Button have variants that automatically use the correct theme colors:

```html
<button variant="default">Primary Button</button>
<button variant="destructive">Danger Button</button>
<button variant="outline">Outline Button</button>
<button variant="ghost">Ghost Button</button>
```

## Extending the Theme

To extend or modify the theme:

1. Add new color variables in `resources/css/app.css`
2. Reference these variables in `tailwind.config.js`
3. Use the new colors with semantic class names

## Best Practices

1. Always use semantic color tokens rather than hardcoded color classes
2. Test UI components in both light and dark modes
3. Ensure sufficient contrast for accessibility
4. Use the `cn()` utility to compose class names dynamically

## Theme Toggle

The application includes a `ThemeToggle` component that allows users to switch between light, dark, and system themes. This component can be placed in navigation bars or settings pages.

```html
<ThemeToggle />
```
