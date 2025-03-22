# UI Component Theming Guide

This guide will help you update existing components and create new ones using our theming system.

## Introduction

Our application uses a semantic token-based theming system built on ShadCN and Tailwind CSS. This system ensures consistent styling and proper contrast in both light and dark modes.

## Semantic Color Tokens

Instead of using hardcoded colors like `text-gray-700` or `bg-white`, use these semantic tokens:

### Text Colors

| Token                         | Purpose                         | Example                                                                      |
| ----------------------------- | ------------------------------- | ---------------------------------------------------------------------------- |
| `text-foreground`             | Primary text                    | `<p class="text-foreground">Main text</p>`                                   |
| `text-muted-foreground`       | Secondary text                  | `<p class="text-muted-foreground">Less important text</p>`                   |
| `text-primary-foreground`     | Text on primary backgrounds     | `<button class="bg-primary text-primary-foreground">Button</button>`         |
| `text-secondary-foreground`   | Text on secondary backgrounds   | `<div class="bg-secondary text-secondary-foreground">...</div>`              |
| `text-accent-foreground`      | Text on accent backgrounds      | `<div class="bg-accent text-accent-foreground">...</div>`                    |
| `text-destructive-foreground` | Text on destructive backgrounds | `<button class="bg-destructive text-destructive-foreground">Delete</button>` |
| `text-card-foreground`        | Text in cards                   | `<div class="bg-card text-card-foreground">Card content</div>`               |
| `text-popover-foreground`     | Text in popovers/dropdowns      | `<div class="bg-popover text-popover-foreground">Menu item</div>`            |

### Background Colors

| Token            | Purpose                        | Example                                          |
| ---------------- | ------------------------------ | ------------------------------------------------ |
| `bg-background`  | Main page background           | `<div class="bg-background">Page content</div>`  |
| `bg-card`        | Card and component backgrounds | `<div class="bg-card">Card content</div>`        |
| `bg-popover`     | Popover/dropdown backgrounds   | `<div class="bg-popover">Dropdown content</div>` |
| `bg-primary`     | Primary action backgrounds     | `<button class="bg-primary">Submit</button>`     |
| `bg-secondary`   | Secondary action backgrounds   | `<button class="bg-secondary">Cancel</button>`   |
| `bg-muted`       | Subtle background highlights   | `<div class="bg-muted">Subtle section</div>`     |
| `bg-accent`      | Accent highlights              | `<div class="bg-accent">Highlighted area</div>`  |
| `bg-destructive` | Destructive action backgrounds | `<button class="bg-destructive">Delete</button>` |

### Border and Other Colors

| Token           | Purpose            | Example                                                     |
| --------------- | ------------------ | ----------------------------------------------------------- |
| `border-border` | Border color       | `<div class="border border-border">...</div>`               |
| `border-input`  | Form input borders | `<input class="border-input" />`                            |
| `ring-ring`     | Focus rings        | `<button class="focus:ring-2 focus:ring-ring">...</button>` |

## Converting Existing Components

When updating components from hardcoded colors to theme tokens, follow these patterns:

### Original Component (with hardcoded colors):

```html
<button class="border-gray-300 bg-gray-800 text-white dark:border-gray-700 dark:bg-gray-200 dark:text-gray-800">Click me</button>
```

### Updated Component (with theme tokens):

```html
<button class="bg-primary text-primary-foreground border-border">Click me</button>
```

## Common Patterns to Replace

| Original                               | Replacement                                  |
| -------------------------------------- | -------------------------------------------- |
| `text-gray-700 dark:text-gray-300`     | `text-foreground`                            |
| `text-gray-500 dark:text-gray-400`     | `text-muted-foreground`                      |
| `bg-white dark:bg-gray-800`            | `bg-card`                                    |
| `bg-gray-100 dark:bg-gray-900`         | `bg-background` or `bg-muted`                |
| `bg-red-600 text-white`                | `bg-destructive text-destructive-foreground` |
| `border-gray-300 dark:border-gray-700` | `border-border`                              |
| `focus:ring-indigo-500`                | `focus:ring-ring`                            |

## Hover, Focus and Active States

Use opacity modifiers for hover states:

```html
<button class="bg-primary hover:bg-primary/90 focus:bg-primary/90 active:bg-primary/100">Button</button>
```

## Component Variants

Prefer using ShadCN component variants when available. For example, instead of applying individual classes:

```html
<!-- Avoid this -->
<button class="bg-primary text-primary-foreground hover:bg-primary/90">Button</button>
```

Use the variant prop:

```html
<!-- Prefer this -->
<button variant="default">Button</button>
```

## Testing Your Components

Always test components in both light and dark modes to ensure proper contrast. Use the theme toggle in the navigation to switch between modes.

## Using the cn() Utility

When you need to combine classes conditionally, use the `cn()` utility:

```typescript
import { cn } from '@/lib/utils';

// In your component
const classes = cn('base-class', someCondition && 'conditional-class', props.className);
```

## Further Reading

For more details about our theme system, see [docs/theme-system.md](theme-system.md).
