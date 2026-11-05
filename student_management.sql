-- ============================================================
-- Database: crud_app
-- Project: ZUMS Student Management System (Raw Laravel CRUD)
-- University MID Assignment
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB, phpMyAdmin
-- ============================================================

-- 1. Create Database if not exists
CREATE DATABASE IF NOT EXISTS `crud_app` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `crud_app`;

-- ------------------------------------------------------------
-- 2. Table structure for `students`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  `semester` VARCHAR(20) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_student_id_unique` (`student_id`),
  UNIQUE KEY `students_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3. Sample student records for demonstration and grading
-- ------------------------------------------------------------
INSERT INTO `students` (`id`, `student_id`, `name`, `email`, `phone`, `department`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'ZUMS-2022-001', 'Abdullah Al Mamun', 'mamun.cse@zums.edu', '+880 1711-234567', 'Computer Science & Engineering', '7th Semester', NOW(), NOW()),
(2, 'ZUMS-2022-045', 'Fatima Zahra', 'fatima.se@zums.edu', '+880 1819-876543', 'Software Engineering', '6th Semester', NOW(), NOW()),
(3, 'ZUMS-2023-012', 'Tanvir Hasan', 'tanvir.bba@zums.edu', '+880 1622-334455', 'Business Administration (BBA)', '4th Semester', NOW(), NOW()),
(4, 'ZUMS-2023-088', 'Nusrat Jahan', 'nusrat.eee@zums.edu', '+880 1913-445566', 'Electrical & Electronic Engineering', '3rd Semester', NOW(), NOW()),
(5, 'ZUMS-2024-005', 'Rahat Chowdhury', 'rahat.cse@zums.edu', '+880 1521-778899', 'Computer Science & Engineering', '2nd Semester', NOW(), NOW()),
(6, 'ZUMS-2024-034', 'Sabrina Rahman', 'sabrina.eng@zums.edu', '+880 1733-112233', 'English Language & Literature', '1st Semester', NOW(), NOW());

-- ------------------------------------------------------------
-- End of SQL Export
-- ------------------------------------------------------------
