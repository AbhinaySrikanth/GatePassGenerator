# GatePassGenerator
A simple PHP-based web application for managing and recording visitors within an organization. Designed for intranet deployment, this system supports one admin account and allows easy registration and tracking of multiple visitors.

---

## Features

- Secure admin login and password management
- Add, view, and manage visitor entries
- Dashboard with quick access to core functions
- Basic contact and about pages for organizational info

---

## Prerequisites

- PHP (version 5.6 or newer recommended)
- MySQL or MariaDB server
- A web server (e.g., Apache, included with XAMPP, WAMP, etc.)

---

## Installation

1. **Download and Extract**
   - Download the project files and place them in your web server’s root directory (e.g., `htdocs` for XAMPP, `www` for WAMP).

2. **Database Setup**
   - Locate the provided database PHP file (e.g., `database.php`). This file contains the SQL structure and/or connection logic.
   - If you have an SQL file, import it into your MySQL server using phpMyAdmin or the MySQL command line.
   - If the database is created via PHP, ensure you run the script once to set up the required tables.

3. **Configure Database Connection**
   - Open the configuration file (commonly named `config.php` or `database.php`).
   - Set your database host, username, password, and database name as needed.
   - Example:
     ```php
     $conn = mysqli_connect("localhost", "root", "", "visitor_db");
     ```
   - Save the file.

4. **Start Services**
   - Ensure Apache and MySQL services are running (use XAMPP or WAMP control panel).

5. **Access the Application**
   - In your browser, go to `http://localhost/your-folder-name/`.

---

## Usage

- **Admin Registration:** Register the admin account on first use, or use the login page if already registered.
- **Add Visitors:** Use the dashboard to add new visitor entries with required details.
- **Manage Visitors:** View, update, or delete visitor records as needed.
- **Change Password:** Admin can update their password from the dashboard.

---

## Default Admin Account

- There is no default admin account; please register the admin account on first use.
- Only one admin account is supported.

---

## Notes

- All passwords are securely hashed before storage.
- This system is intended for internal/intranet use only.
- No additional PHP extensions are required beyond the default MySQLi extension[2][7].

---

## Troubleshooting

- If you see database connection errors, double-check your credentials in the config file and ensure the MySQL server is running.
- If tables are missing, ensure the database setup step is completed.
