# ZUMS Student Management System (Raw Laravel CRUD)

A modern, responsive, beginner-friendly **Student Management System** developed with **Raw Laravel (MVC Architecture)** and **Bootstrap 5** for the University MID Assignment.

---

## 📌 Project Overview

- **Project Name:** ZUMS Student Management System
- **Purpose:** University MID Assignment
- **Backend Architecture:** Pure / Raw Laravel MVC (Model-View-Controller)
- **Database:** MySQL (`crud_app`)
- **Frontend:** Blade Templates, HTML5, CSS3, Bootstrap 5.3, Bootstrap Icons
- **Strict Compliance:** Built completely from scratch without Laravel Breeze, Jetstream, Livewire, Inertia.js, Filament, or any third-party admin panel scaffolding.

---

## 🚀 Key Features

### 1. Create (Student Registration)
- User-friendly registration form with client and server-side validation.
- Fields: `student_id`, `name`, `email`, `phone`, `department`, `semester`.
- Validation checks for required fields, valid email format, and unique constraints.
- Prevents duplicate Student IDs and Email addresses.
- Flash success alert notifications upon submission.

### 2. Read (Listing & Details)
- Clean, responsive Bootstrap 5 data table displaying all student records.
- Search and filter support by Name, Student ID, Email, or Department.
- Summary dashboard cards showing Total Enrolled Students and Department counts.
- Dedicated Student Profile View (`students.show`) with academic and timestamp details.
- Friendly empty-state banner when no student records exist.

### 3. Update (Edit Student Information)
- Pre-populated edit form (`students.edit`) loaded with existing student data.
- Strict validation rules that allow the student to keep their existing ID and Email without triggering duplicate validation errors (`Rule::unique()->ignore($id)`).
- Instant database update and flash message confirmation.

### 4. Delete (Remove Student)
- Delete button for each student with an interactive JavaScript confirmation dialog (`confirm()`).
- Deletion removes the specific student from MySQL and displays an alert with the student's name.

---

## 🛠️ Technology Stack & Requirements

| Layer | Technology | Details |
|---|---|---|
| **Language** | PHP | PHP 8.2 or higher |
| **Framework** | Laravel | Laravel 12 (latest stable compatible with PHP 8.2) |
| **Database** | MySQL / MariaDB | Database name: `crud_app` (XAMPP / native MySQL) |
| **ORM** | Eloquent | Laravel Eloquent ORM & Query Builder |
| **Frontend UI** | Bootstrap 5.3 & Icons | Bootstrap 5.3 CDN + Bootstrap Icons 1.11 |
| **Architecture** | MVC Pattern | Model, View, Controller, Request Validation |

---

## 🗄️ Database Schema (`students` table)

| Column Name | SQL Type | Modifiers / Constraints | Description |
|---|---|---|---|
| `id` | `BIGINT UNSIGNED` | Primary Key, Auto-Increment | Unique record identifier |
| `student_id` | `VARCHAR(20)` | Unique, Not Null | University Student ID (e.g., `ZUMS-2024-001`) |
| `name` | `VARCHAR(100)` | Not Null | Full Name of the student |
| `email` | `VARCHAR(100)` | Unique, Not Null | Valid institutional or personal email |
| `phone` | `VARCHAR(20)` | Not Null | Contact phone number |
| `department` | `VARCHAR(100)` | Not Null | Academic department |
| `semester` | `VARCHAR(20)` | Not Null | Current semester level |
| `created_at` | `TIMESTAMP` | Nullable | Record creation timestamp |
| `updated_at` | `TIMESTAMP` | Nullable | Record update timestamp |

---

## ⚙️ Installation & Setup Instructions

Follow these step-by-step instructions to set up and run the application locally:

### Step 1: Extract the Project
Extract the submitted ZIP archive, then enter the project folder:
```bash
cd student_management
```

### Step 2: Install PHP Dependencies
The ZIP intentionally excludes `vendor/`, so install the Composer dependencies once:
```bash
composer install
```
> Requires PHP 8.2+ and Composer 2.x. Internet access is needed for the first install.

### Step 3: Configure Environment Variables
Copy `.env.example` to `.env`:
```bash
copy .env.example .env
```
Generate an application encryption key:
```bash
php artisan key:generate
```

### Step 4: Configure MySQL Database
Open your `.env` file and verify your MySQL credentials (default for XAMPP is user `root` with empty password):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_app
DB_USERNAME=root
DB_PASSWORD=
```

Make sure MySQL is running in your XAMPP Control Panel.

### Step 5: Database Setup

Choose **one** of the following methods.

#### Method A: Laravel Migrations (Recommended for a fresh install)
Run the migrations to create every table Laravel needs, then seed the sample students:
```bash
php artisan migrate
php artisan db:seed
```

#### Method B: Restore the Full Database Backup (Fastest)
Import the complete backup, which includes all Laravel tables and the 6 sample students:
```bash
mysql -u root -p < database/backup/crud_app_backup_2026-11-05.sql
```
Or import `database/backup/crud_app_backup_2026-11-05.sql` through phpMyAdmin.

> **Warning:** the full backup contains `DROP DATABASE IF EXISTS crud_app` and recreates the database exactly as submitted. Back up any existing `crud_app` data first.

#### Method C: Students Table Only
If you have **already run the migrations** (Method A), you can import just the students schema and sample data:
```bash
mysql -u root -p crud_app < student_management.sql
```
`student_management.sql` contains only the `students` table. Do not use it on an empty database without running `php artisan migrate` first, because Laravel also needs its session/cache/job tables.

---

## ▶️ Running the Project

Start the local Laravel development server:
```bash
php artisan serve
```

Open your browser and navigate to:
```
http://127.0.0.1:8000
```
*(Navigating to `/` will automatically redirect you to `/students`.)*

---

## 📂 Project Folder Structure

```text
crud app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── StudentController.php      # Resource controller handling all CRUD operations
│   └── Models/
│       └── Student.php                    # Eloquent Model with $fillable attributes
├── database/
│   ├── backup/
│   │   └── crud_app_backup_2026-11-05.sql # Full MySQL backup (all tables + sample data)
│   ├── migrations/
│   │   └── 2026_11_05_145007_create_students_table.php  # Students table migration
│   └── seeders/
│       ├── DatabaseSeeder.php             # Master database seeder
│       └── StudentSeeder.php              # Sample student records seeder
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              # Master Bootstrap 5 layout, navbar, footer & alerts
│       └── students/
│           ├── index.blade.php            # Students listing table + dashboard stats + search
│           ├── create.blade.php           # Student registration form
│           ├── edit.blade.php             # Student edit form
│           └── show.blade.php             # Individual student profile view
├── routes/
│   └── web.php                            # Web routes (redirect root + Route::resource)
├── tests/
│   └── Feature/
│       └── StudentCrudTest.php            # 13 automated feature tests verifying all CRUD operations
├── .env.example                           # Sample environment configuration
├── phpunit.xml                            # Testing configuration
├── student_management.sql                 # Standalone SQL schema and sample data dump
└── README.md                              # Project documentation
```

---

## 🔍 Detailed CRUD Explanation

| Operation | HTTP Method | URL Route | Controller Action | Description |
|---|---|---|---|---|
| **Read (List)** | `GET` | `/students` | `StudentController@index` | Lists all students, calculates statistics, and handles search queries. |
| **Create (Form)** | `GET` | `/students/create` | `StudentController@create` | Displays the registration form. |
| **Create (Store)** | `POST` | `/students` | `StudentController@store` | Validates required fields, checks uniqueness, inserts into MySQL, and redirects. |
| **Read (Detail)** | `GET` | `/students/{id}` | `StudentController@show` | Shows complete profile for the specified student. |
| **Update (Form)** | `GET` | `/students/{id}/edit` | `StudentController@edit` | Loads existing student data into the edit form. |
| **Update (Save)** | `PUT` | `/students/{id}` | `StudentController@update` | Validates edits (ignoring self for unique checks) and updates record. |
| **Delete** | `DELETE` | `/students/{id}` | `StudentController@destroy` | Prompts JavaScript confirmation and deletes record from MySQL. |

---

## 🧪 Testing & Verification

A comprehensive automated test suite is included in `tests/Feature/StudentCrudTest.php`.
Run all tests using:
```bash
php artisan test --filter=StudentCrudTest
```

**Test Coverage:**
- [x] Root `/` redirects to `/students`
- [x] Render students list page
- [x] Render student creation page
- [x] Store new student with valid data
- [x] Validation error handling for missing fields
- [x] Validation error handling for duplicate Student ID and Email
- [x] Render student profile details (`show`)
- [x] Render student edit form (`edit`)
- [x] Update student details successfully
- [x] Prevent duplicate collision with other students on update
- [x] Allow maintaining own Student ID and Email on update
- [x] Delete student from database
- [x] Filter / Search query functionality

---
