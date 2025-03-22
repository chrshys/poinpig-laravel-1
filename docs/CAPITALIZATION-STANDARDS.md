# CoinPig Vue Application Capitalization and Naming Standards

This document outlines the capitalization and naming conventions for the CoinPig Vue application to ensure consistency across the codebase and prevent path resolution issues.

## Directory Structure

### Laravel Standard Directories

- Follow Laravel conventions for standard directories:
    - `app/`
    - `resources/`
    - `routes/`
    - `config/`
    - `database/`
    - etc.

### JavaScript/Vue Directories

- All directories in `resources/js/` should use **PascalCase** for organization:
    - `resources/js/Pages/` ✓
    - `resources/js/Layouts/` ✓
    - `resources/js/Components/` ✓
    - Exceptions:
        - `resources/js/composables/` (camelCase)
        - `resources/js/lib/` (lowercase)
        - `resources/js/types/` (lowercase)

## File Naming Conventions

### Vue Files

- All Vue component files should use **PascalCase** with `.vue` extension:
    - `Dashboard.vue` ✓
    - `AppLayout.vue` ✓
    - `CreateTeamForm.vue` ✓
    - `dashboard.vue` ✗ (incorrect)

### JavaScript/TypeScript Files

- Utility files should use **camelCase** with appropriate extension:
    - `useAppearance.ts` ✓
    - `formatCurrency.js` ✓

### PHP Files

- Controllers: **PascalCase** + `Controller` suffix:
    - `UserController.php` ✓
- Models: **PascalCase** in singular form:
    - `User.php` ✓
    - `Transaction.php` ✓
- Middleware: **PascalCase**:
    - `AuthenticateSession.php` ✓

## Import and Require Paths

### Critical Path Resolution Rules

- All imports MUST respect the exact case of the actual file/directory:
    - `import AppLayout from '@/Layouts/AppLayout.vue';` ✓
    - `import AppLayout from '@/layouts/AppLayout.vue';` ✗ (incorrect)

### Alias Usage

- Use the `@/` alias for imports from the `resources/js` directory:
    - `import Component from '@/Components/Button.vue';` ✓
    - `import Component from '../../Components/Button.vue';` ✗ (avoid relative paths)

## Inertia Page References

### In PHP Controllers/Routes

- When using `Inertia::render()`, use the exact case matching the file name without `.vue` extension:
    - `return Inertia::render('Dashboard');` ✓
    - `return Inertia::render('dashboard');` ✗ (incorrect)

### Nested Page References

- For nested pages, use directory separators:
    - `return Inertia::render('Family/Dashboard');` ✓

## Configuration Files

### app.ts and ssr.ts

- Always use correct capitalization in the Inertia resolvers:

    ```typescript
    // CORRECT
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),

    // INCORRECT
    resolve: (name) => resolvePageComponent(`./pages/${name.toLowerCase()}.vue`, import.meta.glob('./pages/**/*.vue')),
    ```

### Blade Templates

- Use correct capitalization in Vite directives:
    ```blade
    @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
    ```

## Best Practices

1. **Never** use string manipulation functions like `toLowerCase()` in path resolutions
2. **Always** check the actual filesystem case before writing import paths
3. **Maintain** consistent naming conventions throughout the project
4. **Review** capitalization in configuration files after updates
5. **Use** IDE tools to help with proper case-sensitive path completion

## Common Issues and Fixes

### Page Not Found Errors

If you encounter `Page not found` errors, check:

1. The actual case of the file in the filesystem
2. The case used in the route/controller
3. Path resolution in `app.ts` and `ssr.ts`
4. Vite configuration in blade templates

### Import Errors

If you encounter import errors, check:

1. The actual case of the imported file
2. The case used in the import path
3. Ensure the file exists at the exact location specified

## Tools for Enforcement

Consider using tools to enforce these standards:

- ESLint rules for import paths
- CI/CD checks for capitalization consistency
- IDE settings to enforce case sensitivity
