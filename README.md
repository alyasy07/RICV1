# Cre8tivation Lab (RIC V3)

**Cre8tivation Lab** (formerly Research Ideation Canvas) is a comprehensive web application designed to facilitate research ideation, canvas creation, and management for students and researchers. Built with modern web technologies, it offers a seamless, aesthetically pleasing, and responsive user experience.

![Cre8tivation Lab Banner](public/images/logo.png)

## 🚀 Key Features

*   **Modern UI/UX**: Fully responsive design with glassmorphism effects, animated backgrounds, and dark mode support.
*   **Dual Authentication System**:
    *   **Legacy Auth**: Standard Laravel authentication for administrators.
    *   **New Auth**: Custom isolated authentication system for researchers/students.
*   **Research Canvas**: Tools to create, edit, and manage research ideation canvases.
*   **Admin Dashboard**: Comprehensive dashboard for managing references and monitoring system activity.
*   **Secure Password Recovery**: Fully functional password reset system for all user types.
*   **PDF Viewer**: Integrated PDF viewing capabilities for research references.

## 🛠 Technology Stack

*   **Backend**: [Laravel 12](https://laravel.com) (PHP 8.2+)
*   **Frontend**: 
    *   [Blade Templates](https://laravel.com/docs/blade)
    *   [TailwindCSS](https://tailwindcss.com) (v3.4)
    *   [Alpine.js](https://alpinejs.dev) (v3.14)
*   **Database**: MySQL
*   **Testing**: PHPUnit

## 💻 Local Installation Guide

Follow these steps to set up the project locally:

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/alyasy07/RICV1.git
    cd RICV1
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    # Build assets
    npm run build
    ```

4.  **Environment Setup**
    *   Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    *   Update your database credentials in `.env`:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=root
        DB_PASSWORD=
        ```

5.  **Generate App Key & Migrate**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

6.  **Run the Server**
    ```bash
    php artisan serve
    ```

## 🌍 Deployment Instructions

This project is **Deployment Ready**. The codebase has been scrubbed of sensitive development scripts and verified with a custom deployment test suite.

**On your production server:**

1.  **Dependencies**:
    ```bash
    composer install --optimize-autoloader --no-dev
    npm ci
    npm run build
    ```

2.  **Environment**:
    *   Ensure `APP_ENV=production` and `APP_DEBUG=false` in your `.env` file.
    *   Set your production database credentials.

3.  **Optimization**:
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    ```

4.  **Permissions**:
    *   Ensure `storage/` and `bootstrap/cache/` directories are writable by the web server.

## ✅ Verification

You can verify the system integrity using the included deployment test:

```bash
php artisan test --filter=DeploymentTest
```

This checks:
*   Application Uptime
*   Database Connection
*   Admin User Existence
*   Login Page Availability

## 📧 Support

For issues or inquiries, please contact the development team at Cre8tivation Lab.
