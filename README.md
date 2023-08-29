<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project
# DIGIARCH

Welcome to the DIGIARCH repository! This project is a web application built using the Laravel framework that serves as an online platform for managing and browsing theses based on different departments. Faculty members can access the archive to search for and view relevant theses, while administrators have the ability to manage theses, departments, courses, and generate reports.

## Features

- Browse and search for theses based on departments
- Faculty members can search for theses by title, author, keywords, and more
- Admins can manage theses, including creating, updating, and deleting entries
- Admins can manage departments and courses
- Generate reports with visual graphs for thesis topics and search statistics

## Installation

1. Clone the repository to your local machine:

   ```
   git clone https://github.com/your-username/digiarch-laravel.git
   ```

2. Navigate to the project directory:

   ```
   cd digiarch-laravel
   ```

3. Install the project dependencies using Composer:

   ```
   composer install
   ```

4. Create a `.env` file by duplicating `.env.example`:

   ```
   cp .env.example .env
   ```

5. Generate an application key:

   ```
   php artisan key:generate
   ```

6. Configure your database settings in the `.env` file:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

7. Migrate the database:

   ```
   php artisan migrate
   ```

8. Serve the application locally:

   ```
   php artisan serve
   ```

9. Access the application in your browser at `http://localhost:8000`.

## Usage

- Faculty members can browse,search, and download for theses based on their departments.
- Admins can log in to the admin dashboard to manage theses, departments, and courses.
- Admins can generate reports with graphical representations of search statistics.

## Contributing

Contributions are welcome! If you find a bug or have an improvement in mind, please feel free to open an issue or submit a pull request.

## Credits

This project is based on the Laravel framework.

Thank you for checking out DIGIARCH! If you have any questions or need assistance, please don't hesitate to reach out.

**Happy archiving!**
