# PHP Expense Tracker

A simple expense management system built with PHP and MySQL. This project is ideal for students or beginners learning PHP web development. It allows users to manage personal income and expenses using a web-based dashboard.

---

## 📋 Features

- User session-based authentication
- Add, edit, delete income and expenses
- Basic reporting and data views
- Clean UI (ready for customization by your team)

---

## ⚙️ Requirements

- PHP 7.4 or PHP 8.x
- MySQL (MariaDB)
- Apache server
- [XAMPP](https://www.apachefriends.org/) (recommended — includes all the above)

---

## 🧑‍💻 Getting Started

Follow these steps to install, set up, and run the project on your local machine.

---

### ✅ Step 1: Install XAMPP

1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install using default settings
3. Open the **XAMPP Control Panel**
4. Start both **Apache** and **MySQL** services

---

### ✅ Step 2: Clone the Project

Open Command Prompt or Terminal and run:

```bash
cd C:\xampp\htdocs
git clone https://github.com/<your-username>/php-expense-tracker.git
Replace <your-username> with your actual GitHub username.

This creates the folder:

C:\xampp\htdocs\php-expense-tracker

✅ Step 3: Set Up the Database

Open your browser and go to:
http://localhost/phpmyadmin

Click the "Databases" tab

Create a new database named:

my_expenses

Click the new my_expenses database from the sidebar

Click Import, then:

Choose the database.sql file located inside the project folder

Click Go

You should see a success message like:

“Import has been successfully finished, X queries executed.”

✅ Step 4: Fix for PHP 8+ (If needed)

If you see this error when loading the app:

Fatal error: Cannot redeclare str_contains()
Open helpers/Functions.php and replace this function:


function str_contains($needle, $haystack) {
    return strpos($haystack, $needle) !== false;
}
With this version:

if (!function_exists('str_contains')) {
    function str_contains($needle, $haystack) {
        return strpos($haystack, $needle) !== false;
    }
}
This makes the project compatible with PHP 8+.

✅ Step 5: Launch the App
Visit the app in your browser:

http://localhost/php-expense-tracker

You should dashboard.

🧾 File Structure Overview
perl
Copy
Edit
php-expense-tracker/
│
├── config.php             # Configuration settings (paths, constants)
├── database.sql           # MySQL database dump
├── helpers/               # Custom utility functions
├── models/                # Database model logic
├── controllers/           # Application route logic
├── system/                # Core framework components (Router, BaseView, etc.)
├── vendor/                # Composer dependencies (if used)
├── index.php              # Entry point
🧑‍🤝‍🧑 Team Collaboration

To work on the UI or add features:

Clone the repo

Create a new branch:

git checkout -b feature/new-ui

Make changes locally

Commit and push:

git add .
git commit -m "Improve UI styling"
git push origin feature/new-ui
Open a Pull Request on GitHub

🤝 Contributing
Fork the repository

Create a feature branch

Push changes and submit a Pull Request

Follow clean coding and commenting practices
