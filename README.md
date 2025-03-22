# Coinpig

Coinpig is a modern financial management application built with Laravel, Vue.js, and Inertia.js.

## Features

- Secure user authentication and authorization
- Team collaboration capabilities
- Financial transaction management
- Modern, responsive UI with dark mode support

## Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Vue.js 3.x with Inertia.js
- **UI**: ShadCN Vue components with Tailwind CSS
- **Database**: PostgreSQL
- **Authentication**: Laravel Jetstream

## UI System

Coinpig uses a comprehensive theming system based on ShadCN Vue and Tailwind CSS. The system features:

- Light and dark mode support
- Semantic color tokens for consistent UI
- High-contrast, accessible color combinations
- Themeable components

For detailed information about the theming system, see [docs/theme-system.md](docs/theme-system.md).

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 20+
- npm or yarn
- PostgreSQL

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-organization/coinpig-vue.git
    cd coinpig-vue
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Create an environment file:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database in the `.env` file.

7. Run database migrations:

    ```bash
    php artisan migrate
    ```

8. Start the development server:

    ```bash
    npm run dev
    ```

9. Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Usage

After logging in, you'll have access to the dashboard where you can manage your financial transactions and account settings.

### Theme Switching

The application supports light and dark mode:

1. Click on the theme toggle icon in the navigation bar
2. Select your preferred theme (Light, Dark, or System)

## Development

### Build for Production

```bash
npm run build
```

### Run Tests

```bash
php artisan test
```

## License

[MIT License](LICENSE)
