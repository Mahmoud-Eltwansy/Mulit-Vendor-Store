# Multi-Vendor Store

## Introduction
Welcome to the Multi-Vendor Store repository! This project is designed to provide a comprehensive solution for managing a multi-vendor e-commerce platform. Below you'll find a detailed list of features and functionalities included in this project.

## Features
- **Login**: Secure user authentication system.
- **Sign Up**: New user registration with validation.
- **Breeze Package**: Utilizes Laravel Breeze for authentication scaffolding.
- **Blade Components**: Modular and reusable UI components.
- **Pagination**: Efficient data pagination for large datasets.
- **Soft Deletes**: Soft delete functionality for safe data removal.
- **Scopes**: Query scopes for cleaner and reusable query logic.
- **Relations**: 
  - One to One
  - One to Many
  - Many to Many
- **Validation**: Robust input validation to ensure data integrity.
- **Currencies**: Support for multiple currencies.
- **Repository Design Pattern**: Clean and maintainable code structure using repositories.
- **Events and Listeners**: Event-driven architecture for better decoupling.
- **Shopping Cart**: Shopping cart functionality stored in cookies.
- **Checkout**: Secure and efficient checkout process.
- **Tags**: Tagging system for categorization.
- **Real Time Notifications Using Pusher**: Instant notifications using Pusher.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/your-repo-name.git
2. Navigate to the project directory:
   ```bash
    cd yousr-repo-name
3. Install dependencies:
   ```bash
    composer install
    npm install
4. Set up your environment variables:
   ```bash
    cp .env.example .env 
    php artisan key:generate
5. Configure your database and other services in the .env file.
6. Run migrations:
   ```bash
    php artisan migrate
## Usage
1. Start the development server:
   ```bash
    php artisan serve
