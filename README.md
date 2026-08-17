# DriveRent - Vehicle Rental Management System

A production-ready Vehicle Rental Management System built with Laravel, MySQL, and Tailwind CSS. 

## Features

*   **Authentication & Authorization:** Secure login/registration with role-based access control (Admin & Customer).
*   **Vehicle Catalog:** Browse vehicles by category, search by name/brand, and filter by price range.
*   **Booking System:** 
    *   Customers can select dates and book vehicles.
    *   Real-time cost estimation based on dates.
    *   Overlap prevention: Ensures vehicles cannot be double-booked.
*   **Admin Dashboard:**
    *   Manage vehicle categories (CRUD).
    *   Manage vehicles (CRUD) with image upload support.
    *   Manage all customer bookings (Approve, Reject, Complete, Cancel).
    *   High-level statistics and recent booking insights.
*   **Customer Dashboard:**
    *   View personal booking history.
    *   Cancel pending bookings.
    *   Update profile information (Name, Email, Phone, Address).
*   **Responsive UI:** Clean, mobile-friendly interface built with Tailwind CSS.

## Requirements

*   PHP >= 8.2
*   Composer
*   MySQL or equivalent
*   Node.js & NPM (for frontend assets)

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/drive-rent.git
    cd drive-rent
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Configure your database credentials in the `.env` file.

4.  **Database Migration & Seeding:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    *Note: The seeder creates an admin account (`admin@admin.com` / `password`), a customer account (`customer@test.com` / `password`), and sample vehicles.*

5.  **Storage Link (for vehicle images):**
    ```bash
    php artisan storage:link
    ```

6.  **Run the application:**
    ```bash
    php artisan serve
    ```
    Visit `http://localhost:8000` in your browser.

## Built With

*   [Laravel](https://laravel.com/)
*   [Tailwind CSS](https://tailwindcss.com/)
*   [Alpine.js](https://alpinejs.dev/)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
