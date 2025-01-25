# Laravel Payment Import and Email System

This is a Laravel-based application that allows users to import payment data from an Excel file, validate the data, and send payment confirmation emails with PDF invoices.

## Features

- Import Excel files with payment data (name, email, amount).
- Validate the imported data.
- Send payment confirmation emails with PDF invoices.
- Use queues for efficient email delivery.

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.0
- Composer
- MySQL or another supported database
- Laravel CLI

## Installation

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd <project-directory>

2- composer install

3- cp .env.example .env

4- Update the .env file with your database credentials and other settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

5- Generate a new application key:
php artisan key:generate

6- Run database migrations to create the necessary tables:
php artisan migrate

7- Run the AdminUserSeeder for Make a user for you  
php artisan db:seed

8- for using queues, configure the queue driver in .env:
QUEUE_CONNECTION=database

9- Run the queue worker:
php artisan queue:work

10- Run the Application:
Start the Laravel development server:
php artisan serve


## Endpoints

### Public Endpoints
1. **Login**
   - URL: `/login`
   - Method: `POST`
   - Headers:
   - `Accept` : Application/Json
   - Request Body:
     ```json
     {
       "email": "admin@example.com",
       "password": "password"
     }
     ```
   - Response:
     ```json
    {
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.com",
        "email_verified_at": null,
        "created_at": "2025-01-23T15:11:26.000000Z",
        "updated_at": "2025-01-23T15:11:26.000000Z"
    },
    "token": "auth-token"}
     ```

2. **Register**
   - URL: `/register`
   - Method: `POST`
   - Headers:
   - `Accept` : Application/Json
   - Request Body:
     ```json
     {
       "name": "John Doe",
       "email": "user@example.com",
       "password": "password",
       "password_confirmation": "password"
     }
     ```
   - Response:
     ```json
    {
        "message": "User registered successfully!",
        "user": {
            "name": "Johny Doe",
            "email": "john2@example.com",
            "updated_at": "2025-01-25T11:26:19.000000Z",
            "created_at": "2025-01-25T11:26:19.000000Z",
            "id": 3
        }
    }
     ```

### Protected Endpoints (Authentication Required)
1. **Logout**
   - URL: `/logout`
   - Method: `POST`
   - Headers:
     - `Accept` : Application/Json
     - `Authorization: Bearer {auth-token}`

   - Response:
     ```json
     {
       "message": "Logged out successfully"
     }
     ```

2. **Import**
   - URL: `/import`
   - Method: `POST`
   - Headers:
     - `Accept: Application/json` 
     - `Authorization: Bearer {auth-token}`
   - Request Body:
     - File upload (e.g., `payments.xls`)

   - Response:
     ```json
     {
       "message": "Data imported successfully"
     }
     ```

