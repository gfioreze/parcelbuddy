# ParcelBuddy - Parcel Management System

## Overview

ParcelBuddy is a CRUD web application for managing delivery parcels, developed as a university assessment. Features include user authentication, role-based access control, live search, pagination, and responsive design using MVC architecture.

## 🚀 Quick Setup
1. **Clone & Database**: Clone repo and run `database.sql`
2. **Configuration**: Create `config/config.php` with:

  ```bash
  const DB_USERNAME = 'your_username';
  const DB_PASSWORD = 'your_password';
  const DB_HOST = 'localhost';
  const DB_DATABASE = 'database_name';
  ```

3. **Start Server**: Run PHP development server:
  ```bash
  php -S localhost:8000
  ```

## 🎯 Key Features
  - **CRUD Operations**: Full parcel management
  - **User Roles**: Admin (full access) and User (read-only)
  - **Pagination**: Efficient data display (10 items/page)
  - **Security**: Password hashing, session management, input validation

## 🏗️ Tech Stack
  - **Backend**: PHP
  - **Frontend**: HTML, CSS, JavaScript, Bootstrap
  - **Database**: MySQL
  - **Architecture**: MVC Pattern

## 📁 Core Structure
- **Models/**: Data operations (Database.php, DeliveryPointData.php, etc.)
- **Views/**: Templates (dashboard.phtml, delivery.phtml, etc.)
- **Controllers**: PHP files (login.php, dashboard.php, delivery.php, etc.)
- **css/**: Stylesheets
- **js/**: JavaScript files
- **config/**: Configuration files

## 👥 User Permissions

  - **Admins**: Full CRUD + user management + dashboard access
  - **Users**: Read-only parcel viewing + search functionality

## 🛡️ Security
  - Password hashing with `password_hash()`
  - SQL injection prevention
  - Session validation
  - Role-based access control
