# 🎓 Student Management System

> A full-stack web application for managing student records, academic data, and administrative workflows through a secure and scalable backend system.

---

## 🚀 Features
✔ Authentication & role-based access control  
✔ Student profile management (CRUD)  
✔ Admin dashboard with filters & statistics  
✔ Secure form validation  
✔ Responsive UI  

---

## 🛠 Tech Stack
- ⚙️ Backend: Laravel (PHP)
- 🎨 Frontend: Blade, JavaScript, Bootstrap
- 🗄 Database: MariaDB / MySQL
- 🧰 Tools: Git, Linux

---

## 🧱 Architecture
- MVC design pattern
- REST-style controllers
- Modular business logic
- Relational database schema

---

## ⚡ Setup
```bash
git clone https://github.com/AsmaeAliti/Gestion_des_etudiants.git
cd Gestion_des_etudiants
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
